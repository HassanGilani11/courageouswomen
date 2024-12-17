<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Utils;

use Directorist\Directorist_Single_Listing;
use Directorist\Helper as CoreHelper;
use Directorist\Multi_Directory\Builder_Data;

class DirectoristHelper {
	public static function get_template( $template_file, $args = [] ) {
		if ( is_array( $args ) ) {
			extract( $args );
		}

		$file = $template_file . '.php';
		if ( file_exists( $file ) ) {
			include $file;
		}
	}

	public static function get_listing_checked_items( $data ) {
		$options = [];
		foreach ( $data['options'] as $value ) {
			$options[] = $value['option_label'];
		}
		echo join( ', ', $options );
	}

	public static function get_preset_fields( $directory_type ) {
		$contents = get_term_meta( $directory_type, 'submission_form_fields', true );

		$data = [];
		foreach ( $contents['groups'] as $content ) {
			$data[] = $content['fields'];
		}

		$all_data = array_merge( ...$data );

		$except_data = [
			'description',
			'category',
			'hide_contact_owner',
			'image_upload',
			'listing-type',
			'location',
			'map',
			'social_info',
			'tag',
			'title',
			'video',
			'view_count',
			'color_picker',
		];

		$filteredArray = array_diff( $all_data, $except_data );

		$final_data = [];
		foreach ( $filteredArray as $data ) {
			$final_data[] = [$data => $contents['fields'][$data]['label']];
		}
		$final_data = array_merge( ...$final_data );

		return $final_data;
	}

	public static function get_custom_fields( $directory_type ) {
		$contents = get_term_meta( $directory_type, 'submission_form_fields', true );

		$data = [];
		foreach ( $contents['groups'] as $content ) {
			$data[] = $content['fields'];
		}

		$all_data = array_merge( ...$data );

		$except_data = [
			'file',
			'url',
			'video',
		];

		$filteredArray = array_intersect( $all_data, $except_data );

		$final_data = [];
		foreach ( $filteredArray as $data ) {
			$final_data[] = [$data => $contents['fields'][$data]['label']];
		}
		$final_data = array_merge( ...$final_data );

		return $final_data;
	}

	public static function get_custom_color_field( $directory_type ) {
		$contents = get_term_meta( $directory_type, 'submission_form_fields', true );

		$data = [];
		foreach ( $contents['groups'] as $content ) {
			$data[] = $content['fields'];
		}

		$all_data = array_merge( ...$data );

		$except_data = [
			'color_picker',
		];

		$filteredArray = array_intersect( $all_data, $except_data );

		$final_data = [];
		foreach ( $filteredArray as $data ) {
			$final_data[] = [$data => $contents['fields'][$data]['label']];
		}
		$final_data = array_merge( ...$final_data );

		return $final_data;
	}

	public static function get_group_fields() {
		$fieldGroups = [];

		if ( directorist_is_multi_directory_enabled() ) {
			$directoryTypes = directory_types();

			foreach ( $directoryTypes as $directoryType ) {
				$id   = $directoryType->term_id;
				$name = $directoryType->name;

				$fieldGroups[] = [
					'label'   => $name,
					'options' => self::get_preset_fields( $id ),
				];
			}
		} else {
			$fieldGroups = self::get_preset_fields( default_directory_type() );
		}

		return $fieldGroups;
	}

	public static function get_custom_group_fields() {
		$fieldGroups = [];

		if ( directorist_is_multi_directory_enabled() ) {
			$directoryTypes = directory_types();

			foreach ( $directoryTypes as $directoryType ) {
				$id   = $directoryType->term_id;
				$name = $directoryType->name;

				$fieldGroups[] = [
					'label'   => $name,
					'options' => self::get_custom_fields( $id ),
				];
			}
		} else {
			$fieldGroups = self::get_custom_fields( default_directory_type() );
		}

		return $fieldGroups;
	}

	public static function get_custom_color_group_fields() {
		$fieldGroups = [];

		if ( directorist_is_multi_directory_enabled() ) {
			$directoryTypes = directory_types();

			foreach ( $directoryTypes as $directoryType ) {
				$id   = $directoryType->term_id;
				$name = $directoryType->name;

				$fieldGroups[] = [
					'label'   => $name,
					'options' => self::get_custom_color_field( $id ),
				];
			}
		} else {
			$fieldGroups = self::get_custom_color_field( default_directory_type() );
		}

		return $fieldGroups;
	}

	public static function get_builder_data() {
		$builder = new Builder_Data;

		return $builder->get_fields();
	}

	public static function get_single_listing_fields( $widget_name = '' ) {

		if ( empty( $widget_name ) ) {
			return;
		}

		$contents = get_term_meta( default_directory_type(), 'submission_form_fields', true );

		if ( ! isset( $contents['fields'][$widget_name] ) ) {
			return;
		}

		$single = Directorist_Single_Listing::instance( get_the_ID() );
		$data   = $contents['fields'][$widget_name];

		switch ( $data['widget_key'] ) {

			case 'map':
				$single->field_template( $data );
				break;

			case 'social_info':
				$data['label'] = '';
				$single->field_template( $data );
				break;

			case 'pricing':
				CoreHelper::listing_price( $single->id );
				break;

			case 'checkbox':
				self::get_listing_checked_items( $data );
				break;

			default:
				echo $single->get_field_value( $data );
				break;
		}
	}

	public static function get_single_listing_other_fields( $args = '' ) {

		if ( empty( $args ) ) {
			return;
		}

		$single = Directorist_Single_Listing::instance( get_the_ID() );

		echo '<div class="directorist-single-wrapper">';
		$single->section_template( $args );
		echo '</div>';
	}

	public static function get_single_listing_info( $widget_name = '' ) {

		if ( empty( $widget_name ) ) {
			return;
		}

		$single  = Directorist_Single_Listing::instance( get_the_ID() );
		$widgets = self::get_builder_data()['single_listing_header']['widgets'];
		$args    = [];

		foreach ( $widgets as $key => $data ) {
			if ( $widget_name === $key ) {
				$args                = $data;
				$args['widget_name'] = $key;
				$args['widget_key']  = $key;

				if ( isset( $data['options'] ) && ! empty( $data['options']['fields'] ) ) {
					foreach ( $data['options']['fields'] as $key => $value ) {
						$args[$key] = $value['value'];
					}
				}
			}
		}
		unset( $args['options'] );
		echo $single->field_template( $args );
	}

	public static function get_header_quick_info_fields( $placeholderKey ) {

		$fields      = [];
		$data        = self::get_builder_data()['single_listing_header']['layout'];
		$except_data = ['price', 'category', 'location'];

		foreach ( $data as $args ) {
			if ( $placeholderKey === $args['placeholderKey'] ) {
				$accepted_fields = $args['acceptedWidgets'];
				$fields          = array_diff( $accepted_fields, $except_data );
			}
		}

		$action_items = array_combine( $fields, array_map( 'ucwords', str_replace( '_', ' ', $fields ) ) );

		return $action_items;
	}

	public static function get_header_quick_action_fields( $placeholderKey ) {

		$fields = [];
		$data   = self::get_builder_data()['single_listing_header']['layout'];

		foreach ( $data as $args ) {
			if ( $placeholderKey === $args['placeholderKey'] ) {
				$fields = $args['placeholders'][1]['acceptedWidgets'];
			}
		}

		$action_items = array_combine( $fields, array_map( 'ucwords', str_replace( '_', ' ', $fields ) ) );

		return $action_items;
	}

	public static function directorist_multi_directory() {
		$types = count( \directory_types() );

		return \directorist_multi_directory() && ( 1 < $types ) ? true : false;
	}

}
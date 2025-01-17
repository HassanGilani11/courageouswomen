<?php

	/**
	 * ====================================================
	 * Process table data for table body
	 * ====================================================
	 */

	if( !function_exists( 'pvtfw_process_table_data' ) ){

		function pvtfw_process_table_data($product_id){
			/**
			 * Initialization Start
			 */
			
			$handle = new WC_Product_Variable($product_id);
			$variations = $handle->get_children();

			$default_columns = PVTFW_COMMON::get_default_columns();
			$columns_labels = PVTFW_COMMON::get_columns_labels();
			$columns = get_option('pvtfw_variant_table_columns', $default_columns);

			/**
			 * Initialization End
			 */

			$options = array();
			$cart_url = home_url();
			$product_url = get_permalink( $product_id );

			$qty_layout = PVTFW_COMMON::pvtfw_get_options()->qty_layout;

			//Getting Cart Text
			$btn_text =  PVTFW_COMMON::pvtfw_get_options()->cart_btn_text;

			/**
			 * { Return user input text if exist or hard string }
			 *
			 * @var        <string>
			 */
			$text = !$btn_text ? esc_html__('Add To Cart', 'product-variant-table-for-woocommerce') : $btn_text;

			foreach ($variations as $value) {

				$single_variation = new WC_Product_Variation($value);

				// Not collect some variation data
				if( apply_filters( 'pvt_skip_some_variation', false, $single_variation ) ){
					continue;
				}

				if( $single_variation->variation_is_visible() ):

					$variant_id = $single_variation->get_id();

					// Variation Thumbnail
					$thumbnail = "<figure class='item'><img class='pvtfw_variant_table_img_size' src='".wp_get_attachment_url( $single_variation->get_image_id() )."' /></figure>";

					$options['image_link'][] = apply_filters('pvtfw_table_thumbnail', wp_kses_post( $thumbnail ), $single_variation);
					$options['sku'][] = apply_filters('pvtfw_table_sku', esc_attr( $single_variation->get_sku() ), $single_variation);
					$options['variation_description'][] = apply_filters('pvtfw_table_variation_description', wp_kses_post( $single_variation->get_description() ), $single_variation);
					$options['attributes'][] = apply_filters('pvtfw_table_attributes', $single_variation->get_variation_attributes(false) , $single_variation);
					$options['dimensions_html'][] = apply_filters('pvtfw_table_dimensions_html', wc_format_dimensions($single_variation->get_dimensions(false)), $single_variation);
					$options['weight_html'][] = apply_filters('pvtfw_table_weight_html', wc_format_weight($single_variation->get_weight(false)), $single_variation);
					$options['availability_html'][] = apply_filters('pvtfw_table_availability_html', wc_get_stock_html( $single_variation ), $single_variation);
;

					// Applying filter for price

					// Keeping this part for backward compatibility
					if($single_variation->is_on_sale()):
						$price_html = wc_price($single_variation->get_sale_price())." <del>". wc_price($single_variation->get_regular_price())."</del>"."<input type='hidden' name='hidden_price' class='hidden_price' value='".$single_variation->get_sale_price()."'>";
					else:
						$price_html = wc_price($single_variation->get_regular_price())."<input type='hidden' name='hidden_price' class='hidden_price' value='".$single_variation->get_regular_price()."'>";
					endif;

					$options['price_html'][] = apply_filters('pvtfw_price_html', $price_html, $single_variation);
					
					$defaults = array(
						'input_id'     => uniqid( 'quantity_' ),
						'input_name'   => 'quantity',
						'input_value'  => '1',
						'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $single_variation ),
						'max_value'    => apply_filters( 'woocommerce_quantity_input_max', -1, $single_variation ),
						'min_value'    => apply_filters( 'woocommerce_quantity_input_min', 0, $single_variation ),
						'step'         => apply_filters( 'woocommerce_quantity_input_step', 1, $single_variation ),
						'pattern'      => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
						'inputmode'    => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
						'product_name' => $single_variation ? $single_variation->get_title() : '',
						'placeholder'  => apply_filters( 'woocommerce_quantity_input_placeholder', '', $single_variation ),
						// When autocomplete is enabled in firefox, it will overwrite actual value with what user entered last. So we default to off.
						// See @link https://github.com/woocommerce/woocommerce/issues/30733.
						'autocomplete' => apply_filters( 'woocommerce_quantity_input_autocomplete', 'off', $single_variation ),
						'readonly'     => false,
					);
					$qtyargs = array(
						'min_value'    => apply_filters( 'pvtfw_qtyargs_min_value', $single_variation->get_min_purchase_quantity(), $single_variation ),
						'max_value'    => apply_filters( 'pvtfw_qtyargs_max_value', $single_variation->get_max_purchase_quantity(), $single_variation ),
						'input_value'  => apply_filters( 'pvtfw_qtyargs_input_value', $single_variation->get_min_purchase_quantity(), $single_variation ),
						'input_id'     => $variant_id,
						'price'        => PVTFW_COMMON::check_price_availability($single_variation)['price'], // Custom parameter for hidden price display
						'availability' => PVTFW_COMMON::check_price_availability($single_variation)['variation_availability'], // Custom parameter for hidden availability,
						'layout'       => $qty_layout
					);
					$options_qty_layout = wp_parse_args( $qtyargs, $defaults );

					/**
					 *
					 * @note: woocommerce_quantity_input_args changed to pvt_woocommerce_quantity_input_args
					 * 
					 * $options['quantity'] called outside of the condition and replaced with $options_qty_layout
					 * 
					 * @since version 1.4.13 
					 * 
					 **/
					$options['quantity'][] = apply_filters( 'pvt_woocommerce_quantity_input_args', $options_qty_layout, $qty_layout, $single_variation );
					/**
					 *
					 * @note: Passed data as array to work with them later
					 * 
					 * 
					 * @since version 1.6.0 
					 * 
					 **/
					$options['action'][] = array(
						'product_id' 	=> $product_id, 
						'cart_url'		=> $cart_url, 
						'product_url'	=> $product_url, 
						'variant_id'	=> $variant_id, 
						'stock_status'	=> $single_variation->is_in_stock(),
						'text'			=> $text
					);
				endif;
			}
			// Removing values if value is off in column array
			foreach($columns as $key=>$value){
				if(is_null($value) || $value == 'off')
				unset($columns[$key]);
			}

			// Creating new column to show only on columns by user OR predefined as on
			$latest = array();
			foreach ($columns as $key => $value){
				if(!is_null($value) || $value != 'off'){
					// Checking if variation data `$options[$key]` is not returning an empty value 
					if( !empty( $options[$key] ) ){
						$latest[$key] = $options[$key];
					}
					else{
						break; //@note: Stop this process if the above condition is skipped
					}
				}
			}

			$latest = apply_filters( 'pvtfw_options_array', $latest, $columns, $variations, $qty_layout, $product_id, $cart_url, $product_url, $text );
			$mapped = [];

			foreach ($latest as $key1 => $each_key_data ) {

				foreach ($each_key_data as $key2 => $value2 ) {

						switch ($key1) {
							case 'image_link':

								$key1_title = __('Thumbnail', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_image_link_title', $key1_title );

								break;
							
							case 'sku':

								$key1_title = __('SKU', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_sku_title', $key1_title );

								break;

							case 'price_html':

								$key1_title = __('Price', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_price_html_title', $key1_title );

								break;

							case 'variation_description':

								$key1_title = __('Description', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_variation_description_title', $key1_title );

								break;

							case 'dimensions_html':

								$key1_title = __('Dimensions', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_dimensions_html_title', $key1_title );

								break;

							case 'weight_html':

								$key1_title = __('Weight', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_weight_html_title', $key1_title );

								break;

							case 'availability_html':

								$key1_title = __('Stock', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_availability_html_title', $key1_title );

								break;

							case 'quantity':

								$key1_title = __('quantity', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_quantity_title', $key1_title );

								break;

							case 'action':

								$key1_title = __('Action', 'product-variant-table-for-woocommerce');

								$key1 = apply_filters( 'pvtfw_action_title', $key1_title );

								break;
							
							default:
								$key1 = $key1;
								break;
						}

						$mapped[$key2][$key1] = $value2;
				}
			}

			return $mapped;
		}
	}




	/**
	 * ====================================================
	 * Print table data for table body
	 * ====================================================
	 */

	if( !function_exists( 'pvtfw_print_table_data' ) ){

		function pvtfw_print_table_data( $atts ){

			// Getting product id for unique td id
			$product_id = $atts['id'];

			// Getting Table Data
			$mapped = pvtfw_process_table_data($product_id);

			// QTY layout
			$qty_layout = get_option('pvtfw_variant_table_qty_layout', 'plus/minus');

			// @note: Initialize increment to give an unique id for each table data <td>.
			$i = 0;

			foreach ($mapped as $key1 => $values) { $i++;

				// Preparing key for $values array to get only key name
				$prepare_key = array_keys($values);

				echo wp_kses_post( "<tr class='pvt-tr pvt-tr-{$product_id}-{$i}' id='pvt-tr-{$product_id}-{$i}'>" );

				/**
				 * Hook: pvtfw_pro_tbody_td.
				 *
				 * @hooked
				 */
				do_action('pvtfw_pro_tbody_td', $key1);

				foreach ($values as $key2 => $value) {

					if($key2 == "attributes"){

						foreach($value as $key3 => $val){

							/**
							 * Sanitize taxonomy names. Slug format (no spaces, lowercase). 
							 * Urldecode is used to reverse munging of UTF8 characters.
							 * 
							 * Function name: `wc_sanitize_taxonomy_name`
							 *	
							 * @since 1.4.21
							 * 
							 */ 
							$taxonomy_name = wc_attribute_label( wc_sanitize_taxonomy_name( stripslashes($key3) ) );
							// Getting attribute name (with full arrray) using get_term by passing slug
							$term = get_term_by( 'slug', $val, wc_sanitize_taxonomy_name( stripslashes($key3) ) );
							// If term is not empty then print attribute label else product page inputted vairation name
							if(!empty($term)){
								echo wp_kses_post( apply_filters( "pvt_global_attribute_terms", "<td data-title='{$taxonomy_name}'>{$term->name}</td>", $term, $taxonomy_name ) );
								// Structure of id is {column title}-{product id}-{generated id}-{another generated id}
							}
							else{
								echo wp_kses_post( apply_filters( "pvt_custom_attribute_terms", "<td data-title='{$taxonomy_name}'>{$val}</td>", $val, $taxonomy_name ) );
								// Structure of id is {column title}-{product id}-{generated id}-{another generated id}
							}
							
						}
					}
					elseif($key2 == __("quantity", "product-variant-table-for-woocommerce") ){
						echo wp_kses_post( "<td data-title='{$key2}'>" );
							/**
							 *
							 * @note: Check the $value is an array or string
							 * 
							 * @since version 1.4.13 
							 * 
							 **/
							if( is_array( $value ) ){
								/**
								 * Check compatibility.php file to edit +/- button code. 
								 * 
								 * Function name: `pvt_display_qty_field`
								 * 
								 * New Hook name: `pvt_print_qty_field`
								 *	
								 * @since 1.4.14
								 * 
								 * @modified in 1.5.0
								 * 
								 * @modified in 1.6.0
								 * 
								 */ 

								// print_r($value);

								apply_filters( 'pvt_print_qty_field', $value );

								// woocommerce_quantity_input($value);
							}
							else{
								// To display `out of stock message` if `Remove Quantity Field` option enabled
								echo wp_kses_post( $value );
							}
						echo "</td>";
					}
					elseif( strtolower( $key2 ) == __("action", "product-variant-table-for-woocommerce") ){
						echo wp_kses_post( "<td data-title='{$key2}'>" );
							/**
							 *
							 * @note: Check the $value is an array or string
							 * 
							 * @since version 1.4.13 
							 * 
							 **/
							if( is_array( $value ) ){
								/**
								 * Check compatibility.php file. 
								 * 
								 * Hooked Function: `pvt_display_cart_button`
								 * 
								 * Hook name: `pvt_print_cart_btn`
								 *	
								 * @since 1.6.0
								 * 
								 * 
								 */ 

								apply_filters( 'pvt_print_cart_btn', $value );

								// woocommerce_quantity_input($value);
							}
						echo "</td>";
					}
					else{
						echo wp_kses_post( "<td data-title='{$key2}'>{$value}</td>" );
					}
				}

				/**
				 * ================================
				 * Subtotal code here
				 * ================================
				 */
				$showSubTotal = PVTFW_COMMON::pvtfw_get_options()->showSubTotal;
				if($showSubTotal != ''):
					$price_span = "<span class='pvtfw_subtotal'></span>";
					echo wp_kses_post( apply_filters( 'pvtfw_subtotal_with_currency_symbol', sprintf(
						"<td><p class='pvt-subtotal-wrapper'>%s %s</p></td>",
						get_woocommerce_currency_symbol(),
						$price_span
					), get_woocommerce_currency_symbol(), $price_span ) );
				endif;

				echo "</tr>";
			}
		}

		add_action('pvtfw_table_body', 'pvtfw_print_table_data', 99, 1);
	}

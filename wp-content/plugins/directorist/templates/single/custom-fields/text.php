<?php
/**
 * @author  wpWax
 * @since   6.7
 * @version 7.0.5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="directorist-single-info directorist-single-info-text">

	<div class="directorist-single-info__label">
		<span class="directorist-single-info__label-icon"><?php directorist_icon( $icon );?></span>
		<span class="directorist-single-info__label__text"><?php echo esc_html( $data['label'] ); ?></span>
	</div>

	<div class="directorist-single-info__value"><?php echo esc_html( $value ); ?></div>

</div>
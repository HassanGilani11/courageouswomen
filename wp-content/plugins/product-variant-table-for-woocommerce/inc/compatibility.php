<?php


/**
 * ==============================================
 * Rey Theme and Rey Core Plugin Support
 * ==============================================
 */
if ( class_exists('ReyCore') && PVTFW_COMMON::pvtfw_get_options()->cart_redirect == '' ):
    if( !function_exists('reycore_support') ):
        function reycore_support(){
            return false;
        }
        add_filter( 'pvtfw_added_cart_filter', 'reycore_support' );
    endif;
endif;


/**
 * ==============================================
 * Divi Theme Support
 * ==============================================
 */

if( !function_exists( 'pvtfw_divi_mini_cart_fragment' ) ):

    function pvtfw_divi_mini_cart_fragment( $fragments ) {

        $theme = wp_get_theme();

        if( WC()->cart->get_cart_contents_count() == 1 ){
            $item_text = __( 'Item', 'product-variant-table-for-woocommerce' );
        }
        else{
            $item_text = __( 'Items', 'product-variant-table-for-woocommerce' );
        }

        if ( 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ) {
            $fragments['.et-cart-info span'] = "<span>" . WC()->cart->get_cart_contents_count() . " $item_text</span>";
            return $fragments; 
        }

        return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'pvtfw_divi_mini_cart_fragment', 10, 1 ); 

endif;


/**
 * =============================================================================
 * Whols plugin by Woolentor support 
 * =============================================================================
 */


if ( !function_exists( 'pvt_whols_plugin_support' ) && PVTFW_COMMON::check_plugin_state('whols') ){

    

    function pvt_whols_plugin_support( $price_html, $single_variation ){

        $whols_plugin_options = (array) get_option( 'whols_options' );

        if( $whols_plugin_options['price_type_1_properties']['enable_this_pricing'] == 0  ){
            return $single_variation->get_price_html();
        }

        $wholesale_status    = whols_is_on_wholesale( $single_variation );
        $enable_this_pricing = $wholesale_status['enable_this_pricing'];
        $price_type          = $wholesale_status['price_type'];
        $price_value         = $wholesale_status['price_value'];
        $minimum_quantity    = $wholesale_status['minimum_quantity'];

        if( $enable_this_pricing ){
            if($price_type == 'flat_rate'){
                $price_per_unit = $price_value;
            } elseif($price_type == 'percent'){
                $price_per_unit = whols_get_percent_of( $single_variation->get_regular_price(), $price_value );
            }

            $whols_price = '<span class="price">' .  wc_price( $price_per_unit ) . '</span>';
        }
        
        return $whols_price;

    }
    add_filter( 'pvtfw_price_html', 'pvt_whols_plugin_support', 20, 2 );

}


/**
 * =============================================================================
 * Applying `get_price_html` by adding filter for backward compatibility
 * =============================================================================
 */


if ( !function_exists( 'pvt_get_price_html' ) ){

    function pvt_get_price_html( $price_html, $single_variation ){

        /**
         * =============================================================================
         * Condition removed and added to PVTFW_COMMON line number: 193
         * @since 1.4.15
         * =============================================================================
         */

        return $single_variation->get_price_html();

    }
    add_filter( 'pvtfw_price_html', 'pvt_get_price_html', 10, 2 );

}

/**
 * =============================================================================
 * Initialize quantity field by PVT
 * @since 1.4.14
 * Updated it in version 1.4.15
 * Updated it in version 1.5.0
 * Updated it in version 1.6.0 [Removed ob_start & ob_get_clean]
 * =============================================================================
 */

if( !function_exists( 'pvt_display_qty_field' ) ){

    function pvt_display_qty_field( $args ){

        if( is_array( $args ) && $args['layout'] === 'plus/minus' ){

            echo '<div class="pvt-qty-input">';
                echo '<button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>';

                /**
                 * =============================================================================
                 * woocommerce_quantity_input($args) removed added pvtfw_plus_minus_qty_input hook
                 * @since 1.4.15
                 * =============================================================================
                 */
                do_action('pvtfw_plus_minus_qty_input', $args);

                echo '<button class="qty-count qty-count--add" data-action="add" type="button">+</button>';
            echo '</div>';

            /**
             * =============================================================================
             * Hook to add anything after the quantity field markup
             * @since 1.6.0
             * =============================================================================
             */

            do_action( 'pvt_after_quantity_field_markup', $args );

        }
        if( is_array( $args ) && $args['layout'] === 'basic' ){

            echo '<div class="pvtfw-quantity">';
                /**
                 * =============================================================================
                 * woocommerce_quantity_input($args) removed added pvtfw_basic_input hook
                 * @since 1.5.0
                 * =============================================================================
                 */
                do_action('pvtfw_basic_qty_input', $args);
            echo '</div>';

            /**
             * =============================================================================
             * Hook to add anything after the quantity field markup
             * @since 1.6.0
             * =============================================================================
             */

            do_action( 'pvt_after_quantity_field_markup', $args );

        }

    }

    add_filter( 'pvt_print_qty_field', 'pvt_display_qty_field', 10, 1 );

}


/**
 * =============================================================================
 * PVT self plus minus quantity markup
 * @since 1.4.15
 * @updated in 1.5.0
 * =============================================================================
 */

if( !function_exists( 'pvt_plus_minus_qty_input_markup' ) ){

    function pvt_plus_minus_qty_input_markup( $args ){ 

        // print_r($args);

        /* translators: %s is replaced with the product name or quantity text */
        $label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'product-variant-table-for-woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'product-variant-table-for-woocommerce' );

        /**
         * The input type attribute will generally be 'number'. An exception is made for non-hidden readonly inputs: in this case we set the
         * type to 'text' (this prevents most browsers from rendering increment/decrement arrows, which are useless
         * and/or confusing in this context).
         */
        $type = 'number';
        $type = $args['readonly'] ? 'text' : $type;

        echo sprintf( '
            <div class="pvtfw-quantity">
                <label class="screen-reader-text" for="%3$s">%7$s</label>
                <input
                    type="%1$s"
                    %2$s
                    id="%3$s"
                    class="%4$s"
                    name="%5$s"
                    value="%6$s"
                    aria-label="%8$s"
                    size="4"
                    min="%9$s"
                    max="%10$s"
                    %11$s
                />
            </div>',
           esc_attr($type),
           $args['readonly'] ? 'readonly="readonly"' : '',
           esc_attr( $args['input_id'] ),
           esc_attr( join( ' ', (array) $args['classes'] ) ),
           esc_attr( $args['input_name'] ),
           esc_attr( $args['input_value'] ),
           esc_attr( $label ),
           esc_html__( 'Product quantity', 'product-variant-table-for-woocommerce' ),
           esc_attr( $args['min_value'] ),
           esc_attr( 0 < $args['max_value'] ? $args['max_value'] : '' ),
           ( ! $args['readonly'] ) ? sprintf('
                step="%1$s"
                placeholder="%2$s"
                inputmode="%3$s"
                autocomplete="%4$s" ',
                // Values of sprintf
                esc_attr( $args['step'] ),
                esc_attr( $args['placeholder'] ),
                esc_attr( $args['inputmode'] ),
                esc_attr( isset( $args['autocomplete'] ) ? $args['autocomplete'] : 'on' )
            ) : ''
        )."<input type='hidden' name='hidden_price' class='hidden_price' value='".esc_attr( $args['price'] )."'> <input type='hidden' name='pvt_variation_availability' value='".esc_attr( $args['availability'] )."'>"; // Additional hidden field to control the price and availability
    }

    add_action( 'pvtfw_plus_minus_qty_input', 'pvt_plus_minus_qty_input_markup', 10, 1 );

}


/**
 * =============================================================================
 * PVT self basic quantity markup
 * @since 1.5.0
 * =============================================================================
 */

if( !function_exists( 'pvt_basic_qty_input_markup' ) ){

    function pvt_basic_qty_input_markup( $args ){

        /* translators: %s is replaced with the product name or quantity text */
        $label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'product-variant-table-for-woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'product-variant-table-for-woocommerce' );

        /**
         * The input type attribute will generally be 'number'. An exception is made for non-hidden readonly inputs: in this case we set the
         * type to 'text' (this prevents most browsers from rendering increment/decrement arrows, which are useless
         * and/or confusing in this context).
         */
        $type = 'number';
        $type = $args['readonly'] ? 'text' : $type;

        echo sprintf( '
                <input
                    type="%1$s"
                    %2$s
                    id="%3$s"
                    class="%4$s"
                    name="%5$s"
                    value="%6$s"
                    aria-label="%8$s"
                    size="4"
                    min="%9$s"
                    max="%10$s"
                    %11$s
                />',
           esc_attr($type),
           $args['readonly'] ? 'readonly="readonly"' : '',
           esc_attr( $args['input_id'] ),
           esc_attr( join( ' ', (array) $args['classes'] ) ),
           esc_attr( $args['input_name'] ),
           esc_attr( $args['input_value'] ),
           esc_attr( $label ),
           esc_html__( 'Product quantity', 'product-variant-table-for-woocommerce' ),
           esc_attr( $args['min_value'] ),
           esc_attr( 0 < $args['max_value'] ? $args['max_value'] : '' ),
           ( ! $args['readonly'] ) ? sprintf('
                step="%1$s"
                placeholder="%2$s"
                inputmode="%3$s"
                autocomplete="%4$s" ',
                // Values of sprintf
                esc_attr( $args['step'] ),
                esc_attr( $args['placeholder'] ),
                esc_attr( $args['inputmode'] ),
                esc_attr( isset( $args['autocomplete'] ) ? $args['autocomplete'] : 'on' )
            ) : ''
        )."<input type='hidden' name='hidden_price' class='hidden_price' value='".esc_attr( $args['price'] )."'> <input type='hidden' name='pvt_variation_availability' value='".esc_attr( $args['availability'] )."'>"; // Additional hidden field to control the price and availability
    }

    add_action( 'pvtfw_basic_qty_input', 'pvt_basic_qty_input_markup', 10, 1 );

}

/**
 * =============================================================================
 * PVT push `In Stock` Text to `woocommerce_get_availability_text`
 * @since 1.5.1
 * =============================================================================
 */

if( !function_exists( 'pvt_push_in_stock_text' ) ){

    function pvt_push_in_stock_text( $availability, $product ){

        if ( $product->is_in_stock() && $product->get_stock_quantity() === null ) {

            $availability = esc_html__( 'In Stock', 'product-variant-table-for-woocommerce' );

        }

        return $availability;

    }

    add_filter( 'woocommerce_get_availability_text', 'pvt_push_in_stock_text', 99, 2 );

}


/**
 * =============================================================================
 * PVT Display Cart Button
 * @since 1.6.0
 * =============================================================================
 */

if( !function_exists( 'pvt_display_cart_button' ) ){

    function pvt_display_cart_button( $args ){

        $stock_info = esc_html__('Out of Stock', 'product-variant-table-for-woocommerce');

        $cart_button = pvt_cart_button_condition( $args, $stock_info ); //callback function

        if( $args['stock_status'] ){
            apply_filters( 'pvtfw_row_cart_btn_is', 
                $cart_button, 
                $args['product_id'], 
                $args['cart_url'], 
                $args['product_url'], 
                $args['variant_id'], 
                $args['text']
            );
        }
        else{
            apply_filters( 'pvtfw_row_cart_btn_oos', 
                $cart_button, 
                $args['product_id'], 
                $args['cart_url'], 
                $args['product_url'], 
                $args['variant_id'], 
                $stock_info
            );
        }
        

    }

    add_filter( 'pvt_print_cart_btn', 'pvt_display_cart_button', 99, 1 );

}

/**
 * =============================================================================
 * Callback function for `pvt_display_cart_button`
 * @since 1.6.0
 * =============================================================================
 */
if( !function_exists( 'pvt_cart_button_condition' ) ){

    function pvt_cart_button_condition( $args, $stock_info ){

            if( $args['stock_status'] ){
                /**
                 *
                 * Hook: pvtfw_disable_add_to_cart_button
                 * Disable the add-to-cart button inside table data
                 * 
                 * @since version 1.6.0 
                 * 
                 **/
                if( apply_filters( 'pvtfw_disable_add_to_cart_button', false ) ){
                    return;
                }

                echo wp_kses_post( 
                    sprintf('<button data-product-id="%s" data-url="%s" data-product="%s" data-variant="%s" class="%s">
                        <span class="pvtfw-btn-text">%s</span> 
                        <div class="spinner-wrap"><span class="pvt-icon-spinner"></span></div>
                        </button>', $args['product_id'], $args['cart_url'], $args['product_url'], $args['variant_id'], 
                        /**
                         *
                         * Hook: pvtfw_add_to_cart_btn_classes
                         * Hook: pvtfw_cart_btn_text
                         * 
                         * @since version 1.4.16 
                         * 
                         **/
                        apply_filters( 'pvtfw_add_to_cart_btn_classes', 
                            wp_is_block_theme() ? 'wp-block-button__link wp-element-button wc-block-components-product-button__button pvtfw_variant_table_cart_btn' : 'pvtfw_variant_table_cart_btn button alt' 
                        ),
                        apply_filters( 'pvtfw_cart_btn_text', 
                            
                            /* 
                             * @note: If it is coming from plugin settings it will not translate. Because, dynamic text
                             * is not translatable.
                             * 
                             * @recommendation: Contact through our support forum
                             * 
                             * @link: https://localise.biz/wordpress/plugin/intro#content
                             */
                            $args['text']

                        ) 
                    ) 
                );
            }
            else{
                /**
                 *
                 * Hook: pvtfw_disable_out_of_stock_button
                 * Disable the out-of-stock button inside table data
                 * 
                 * @since version 1.6.0 
                 * 
                 **/
                if( apply_filters( 'pvtfw_disable_out_of_stock_button', false ) ){
                    return;
                }
                echo wp_kses_post( 
                    sprintf('<button class="%s" disabled>
                            <span class="pvtfw-btn-text">%s</span> 
                            <div class="spinner-wrap"><span class="pvt-icon-spinner"></span></div>
                            </button>', 
                            /**
                             *
                             * Hook: pvtfw_add_to_cart_btn_classes
                             * Hook: pvtfw_stock_btn_text
                             * 
                             * @since version 1.4.16 
                             * 
                             * @version 1.4.18 { hook renamed to `pvtfw_stock_btn_text` from `pvtfw_cart_btn_text` }
                             * 
                             **/
                            apply_filters( 'pvtfw_add_to_cart_btn_classes', 
                                wp_is_block_theme() ? 'wp-block-button__link wp-element-button wc-block-components-product-button__button pvtfw_variant_table_cart_btn' : 'pvtfw_variant_table_cart_btn button alt' 
                            ),
                            apply_filters( 'pvtfw_stock_btn_text', $stock_info ) 
                    ) 
                );
            }


    }
}




<?
add_action( 'woocommerce_variable_add_to_cart', 'update_price_with_variation_price_msr' );

function update_price_with_variation_price_msr() {
   global $product;
   $price = $product->get_price_html();
   wc_enqueue_js( "     
      $(document).on('found_variation', 'form.cart', function( event, variation ) {   
         if(variation.price_html) $('.summary > p.price').html(variation.price_html);
         $('.woocommerce-variation-price').hide();
      });
      $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
         $('.summary > p.price').html('" . $price . "');
      });
   " );
}
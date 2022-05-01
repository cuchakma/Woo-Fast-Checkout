;(function($){

  woo_add_to_cart();

  function woo_add_to_cart() {
    $('body').on( 'added_to_cart', function(event, fragments, cart_hash, button){
        console.log(fragments);
        console.log(cart_hash);
        console.log(button);
    });
  }
}(jQuery));
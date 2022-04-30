;(function($){
  $('.woo-checkout').on('submit', function(e){
      e.preventDefault();
      let currentForm = this;
      let xml_request = new XMLHttpRequest();
      let formData = new FormData(currentForm);
      if(formData.get('coupon_code')) {
          formData.set('apply_coupon', 'Apply coupon');
      }
      xml_request.open( "POST", wfc_datas.wfc_cart_url );
      xml_request.send(formData);
  })
}(jQuery));
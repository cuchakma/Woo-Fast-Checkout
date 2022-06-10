jQuery(document).ready(
    (function ($) {
        woo_open_coupon();
        woo_update_cart();
        woo_remove_product();

        function woo_remove_product() {
            $(document).on("click", "a.js-remove-item.remove", function (e) {
                e.preventDefault();
                e.stopPropagation();
                var cart_item_key = $(this).attr("data-cart_item_key");
                data = {
                    cart_item_key: cart_item_key
                };
                $.ajax({
                    type: "POST",
                    url: wfc_datas.wc_ajax_url.toString().replace("%%endpoint%%", "wfc_remove_product"),
                    data: data,
                    beforeSend: function () {
                        initializeLoader();
                    },
                    success: function (response) {
                        jQuery(document.body).trigger("wc_fragment_refresh");
                        removeLoader();
                    },
                });
            });
        }

        function woo_update_cart() {
            $(document).on("click", ".sc_btn_update button", function (e) {
                initializeLoader();
                setTimeout(function (e) {
                    removeLoader();
                }, 1000);
            });
        }

        function initializeLoader() {
            $("svg.wfc-loader").css("display", "block");
            $(".wfc-offcanvas-body").addClass("blur");
        }

        function removeLoader() {
            $("svg.wfc-loader").css("display", "none");
            $(".wfc-offcanvas-body").removeClass("blur");
        }

        function woo_open_coupon() {
            $(".wfc_applyCouponCode").on('click', function(e) {
                var $this = $(this);    
                $this.toggleClass("text_change");
                if ($this.hasClass("text_change")) {
            
                    $this.html("Have any Coupon?");
                    $this.removeClass("btn btn-primary").addClass("wfc_applyCouponCodeBtnStyle");
                    $( "input.wfc_applyCouponCodeField" ).hide();
            
                } else {
            
                    $this.html("Coupon");
                    $this.addClass("btn btn-primary").removeClass("wfc_applyCouponCodeBtnStyle");
                    $( "input.wfc_applyCouponCodeField" ).show( "slow", "linear" );
            
                }
            });
        }
    })(jQuery)
);
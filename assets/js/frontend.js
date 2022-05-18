jQuery(document).ready(
    (function ($) {
        woo_update_cart();
        woo_remove_product();
        add_to_cart();

        function add_to_cart() {
            $(document).on('added_to_cart', function (button, fragments, cart_hash) {
                if ($('.wfc-no-products').length) {
                    $('.wfc-no-products').remove();
                }

                if ($('.wfc-table').length) {
                    $('.wfc-table').remove();
                    $('.shopping_cart_title').after('<table class="wfc-table table table-bordered table-responsive"></table>');
                    $('.wfc-table').append(fragments['thead.wfc-headers']);
                } else {
                    $('.shopping_cart_title').after('<table class="wfc-table table table-bordered table-responsive"></table>');
                    $('.wfc-table').append(fragments['thead.wfc-headers']);
                }

                if ($('.wfc-products-main').length) {
                    $('.wfc-products-main').remove();
                    $('.wfc-headers').after(fragments['tbody.wfc-products-main']);
                } else {
                    $('.wfc-headers').after(fragments['tbody.wfc-products-main']);
                }

                if ($('.wfc-continue-update').length) {
                    $('.wfc-continue-update').remove();
                    $('.wfc-table').after(fragments['div.wfc-continue-update']);
                } else {
                    $('.wfc-table').after(fragments['div.wfc-continue-update']);
                }

                if ($('.wfc-coupon').length) {
                    $('.wfc-coupon').remove();
                    $('.row').after(fragments['div.wfc-coupon']);
                } else {
                    $('.row').after(fragments['div.wfc-coupon']);
                }

                if ($('.wfc-total-subtotal').length) {
                    $('.wfc-total-subtotal').remove();
                    $('.wfc-coupon').after(fragments['div.wfc-total-subtotal']);
                } else {
                    $('.wfc-coupon').after(fragments['div.wfc-total-subtotal']);
                }
            })
        }

        function woo_remove_product() {
            $(document).on("click", "a.wfc_remove_product", function (e) {
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
                        if ($(".mbh-information.mbh-notification-box").length) {
                            $(".mbh-information.mbh-notification-box").remove();
                            $(".shopping_cart_title").after(response.fragments.product_removed_notice);
                        } else {
                            $(".shopping_cart_title").after(response.fragments.product_removed_notice);
                        }
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
            $("section.wfc_shopping_cart_content").addClass("wfc_meta");
        }

        function removeLoader() {
            $("svg.wfc-loader").css("display", "none");
            $("section.wfc_shopping_cart_content").removeClass("wfc_meta");
        }
    })(jQuery)
);
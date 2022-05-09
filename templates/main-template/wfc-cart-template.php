<?php

?>

<button class="wfc btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>
	
<div class="wfc offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="wfc offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="wfc-offcanvas-body">
        <?php
        if ( defined( 'WC_TEMPLATE_PATH' ) ) {
            wfc_load_template('wfc-cart-body.php', array(), 'woocommerce-fast-checkout/templates/cart', WFC_TEMPLATES . 'cart/');
        }
        ?>
    </div>
</div>

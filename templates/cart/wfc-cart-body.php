<?php

$cart_products = WC()->cart->get_cart();

?>
	<!-- Cart Content start -->
	<section class="wfc_shopping_cart_content">

		<div class="container">

			<div class="row">

				<div class="col-12">

					<h4 class="shopping_cart_title pt-2 pb-3">Cart Info</h4>

					<div class="shopping_cart_table">

						<table class="table table-bordered table-responsive">

							<thead>

								<tr>
									<th scope="col" class="product-removal">Remove</th>
									<th scope="col" class="product-image">Image</th>
									<th scope="col" class="product-details">Product</th>
									<th scope="col" class="product-price">Price</th>
									<th scope="col" class="product-quantity">Quantity</th>
									<th scope="col" class="product-line-price">Total</th>
								</tr>

							</thead>
							
							<tbody>

								<?php

								foreach ( $cart_products as $cart_key => $cart_item ) {

									$product_id = $cart_item['product_id'];

									$product_data = $cart_item['data'];

									if ( empty( $product_data ) || ! $product_data->exists() || $cart_item['quantity'] < 0 ) {
										continue;
									}

									$product_permalink = get_permalink( $product_id );

									$product_name = $product_data->get_name();

									$product_price = $product_data->get_price();

									$product_qty = $cart_item['quantity'];

									$product_thumbnail = $product_data->get_image();

									$product_subtotal = WC()->cart->get_product_subtotal( $product_data, $product_qty );

									?>
											<tr>
												<td>
													<?php printf( '<a href="%s" class="sc_remove_icon btn btn-dange" data-product-id="%d" data-product-sku="%d"><i class="fa-solid fa-trash"></i>%s</a>', esc_url( wc_get_cart_remove_url( $cart_key ) ), filter_var( $product_id, FILTER_SANITIZE_NUMBER_INT ), filter_var( $product_qty, FILTER_SANITIZE_NUMBER_INT ), 'Remove' ); ?>
												</td>

												<td>
													<?php echo wp_kses_post( $product_thumbnail ); ?>
												</td>

												<td>
													<h5 class="sc_product_title">
														<?php echo wp_kses_post( $product_name ); ?>
													</h5>
												</td>

												<td>
													<p class="sc_product_price">
														<?php echo wp_kses_post( $product_price ); ?>
													</p>
												</td>

												<td>
													<input type="number" class="sc_product_quantity" value="<?php echo wp_kses_post( $product_qty ); ?>">
												</td>

												<td>
													<p class="sc_total">
														<?php echo wp_kses_post( $product_subtotal ); ?>
													</p>
												</td>
											</tr>
										<?php
								}
								?>
										<tr>
											<td colspan="3">
												<div class="continue_shop_btn">
												<button class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Continue Shopping</button>
												</div>
											</td>

											<td colspan="3" id="sc_btn_align">
												<div class="sc_btn_update">
													<button class="btn btn-outline-success sc_update_btn"><i class="fa-solid fa-arrows-rotate"></i>&nbsp;&nbsp;Update Cart</button>
												</div>
											</td>
										</tr>
							</tbody>
							
						</table>

					</div>

				</div>

			</div>
		
			<div class="row">

				<div class="col-12">

					<div class="sc_coupon">

						<table class="table table-bordered table-responsive">

							<tr>

								<td>
									<h3 class="sc_coupon_title">Coupon</h3>
										<div class="coupon_form">
											<form action="#">
												<div class="row g-3">
												<div class="col-lg-8 col-md-8">
													<input type="text" class="form-control coupon_code_box" placeholder="Coupon Code">
												</div>
												<div class="col-lg-4 col-md-4">
													<div class="btn_coupon_code">
													<button type="submit" class="btn btn-outline-primary coupon_code_btn">Apply Coupon</button>
													</div>
												</div>
												</div>
											</form>
										</div>
								</td>

							</tr>

						</table>

					</div>

				</div>
	
				<div class="col-12">

					<div class="sc_price_total">

						<table class="table table-bordered table-responsive">

							<tr>
								<td colspan="2">
									<h3 class="sc_price_total_title">Cart Total</h3>
								</td>
							</tr>

							<tr>
								<td>
									<h5 class="sc_pt_subtotal">Subtotal</h5>
								</td>

								<td>
									<p class="sc_pt_subtotal_price">$125.00</p>
								</td>
							</tr>
			
							<tr>
								<td>
									<h5 class="sc_pt_shipping">Shipping</h5>
								</td>

								<td>
									<p class="sc_pt_shipping_price">$125.00</p>
								</td>
							</tr>
			
							<tr>
								<td>
									<h5 class="sc_pt_total">Total</h5>
								</td>

								<td>
									<p class="sc_pt_total_price">$125.00</p>
								</td>
							</tr>
			
							<tr>
								<td colspan="2">

									<div class="sc_pt_procedtochkout">
										<!-- <button class="btn btn-outline-secondary">Proceed To Checkout</button> -->
										<button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightCheckout" aria-controls="offcanvasRightCheckout">Proceed To Checkout</button>

									</div>

								</td>

							</tr>

						</table>

					</div>

				</div>

			</div>

		</div>
		
	</section>
	<!-- Cart Content end -->
<?php



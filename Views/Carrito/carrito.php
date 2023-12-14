<?php
headerTienda($data);
?>
<br><br><br>
<hr>
<!-- breadcrumb -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
			Inicio
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>
		<span class="stext-109 cl4">
			<?= $data['page_title'] ?>
		</span>
	</div>
</div>
<?php
$subtotal = 0;
$total = 0;
if (isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0) {
?>
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table id="tblCarrito" class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Producto</th>
									<th class="column-2"></th>
									<th class="column-3">Precio</th>
									<th class="column-4">Cantidad</th>
									<th class="column-5">Total</th>
								</tr>
								<?php
								foreach ($_SESSION['arrCarrito'] as $producto) {
									$totalProducto = $producto['precio'] * $producto['cantidad'];
									$subtotal += $totalProducto;
									$idProducto = openssl_encrypt($producto['idproducto'], METHODENCRIPT, KEY);

								?>
									<tr class="table_row <?= $idProducto ?>">
										<td class="column-1">
											<div class="how-itemcart1" idpr="<?= $idProducto ?>" op="2" onclick="fntdelItem(this)">
												<img src="<?= $producto['imagen'] ?>" alt="<?= $producto['producto'] ?>">
											</div>
										</td>
										<td class="column-2"><?= $producto['producto'] ?></td>
										<td class="column-3"><?= SMONEY . formatMoney($producto['precio']) ?></td>
										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" idpr="<?= $idProducto ?>">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?= $producto['cantidad'] ?>" idpr="<?= $idProducto ?>">

												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" idpr="<?= $idProducto ?>">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>
										<td class="column-5"><?= SMONEY . formatMoney($totalProducto) ?></td>
									</tr>
								<?php } ?>

							</table>

							<!-- Agrega este formulario antes del bloque del carrito -->
							<form id="formMedidas" class="bg0 p-t-75 p-b-85">
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-xl-6 m-lr-auto m-b-50">
											<h4 class="mtext-109 cl2 p-b-30">
												Ingresa tus medidas
											</h4>

											<div class="form-group">
												<label for="anchoCintura">Ancho de cintura:</label>
												<input type="text" class="form-control" id="anchoCintura" name="anchoCintura" required>
											</div>

											<div class="form-group">
												<label for="anchoCadera">Ancho de cadera:</label>
												<input type="text" class="form-control" id="anchoCadera" name="anchoCadera" required>
											</div>

											<div class="form-group">
												<label for="anchoTorso">Ancho de torso:</label>
												<input type="text" class="form-control" id="anchoTorso" name="anchoTorso" required>
											</div>

											<div class="form-group">
												<label for="estatura">Estatura:</label>
												<input type="text" class="form-control" id="estatura" name="estatura" required>
											</div>

											<button type="button" onclick="calcularTalla()" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
												Calcular Talla
											</button>

											<div id="resultadoTalla" class="m-t-20"></div>
										</div>
									</div>
								</div>
							</form>

						</div>

						<script>
							function calcularTalla() {
								var anchoCintura = document.getElementById('anchoCintura').value;
								var anchoCadera = document.getElementById('anchoCadera').value;
								var anchoTorso = document.getElementById('anchoTorso').value;
								var estatura = document.getElementById('estatura').value;

								// Realiza el cálculo aquí según tus necesidades
								// Puedes ajustar este cálculo según tus requerimientos
								var tallaRecomendada = calcularTallaAlgoritmo(anchoCintura, anchoCadera, anchoTorso, estatura);

								// Muestra el modal de SweetAlert con el resultado
								mostrarSweetAlert(tallaRecomendada);
							}

							// Implementa la lógica de cálculo de talla aquí
							function calcularTallaAlgoritmo(anchoCintura, anchoCadera, anchoTorso, estatura) {
								// Implementa tu algoritmo de cálculo de talla aquí
								// Por ejemplo, puedes comparar las medidas con un conjunto predefinido de tallas
								// y devolver la talla correspondiente.

								// Este es un ejemplo simple, ajusta según tus necesidades
								if (anchoCintura > 30 && anchoCadera > 40 && anchoTorso > 25 && estatura > 160) {
									return 'L';
								} else {
									return 'M';
								}
							}

							function mostrarSweetAlert(tallaRecomendada) {
								Swal.fire({
									icon: 'success',
									title: 'Tu Talla precisa seria la \'' + tallaRecomendada + '\'',
									text: '¡Valida y modifica si es necesario!',
									showCancelButton: false,
									confirmButtonText: 'OK',
									confirmButtonClass: 'swal-button swal-button--confirm',
									customClass: {
										icon: 'swal-icon--success',
										title: 'swal-title',
										content: 'swal-text',
										confirmButton: 'swal-button-container'
									}
								});
							}
						</script>

						<!-- <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div> -->
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Totales
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span id="subTotalCompra" class="mtext-110 cl2">
									<?= SMONEY . formatMoney($subtotal) ?>
								</span>
							</div>

							<div class="size-208">
								<span class="stext-110 cl2">
									Envío:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									<?= SMONEY . formatMoney(COSTOENVIO) ?>
								</span>
							</div>
						</div>
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span id="totalCompra" class="mtext-110 cl2">
									<?= SMONEY . formatMoney($subtotal + COSTOENVIO) ?>
								</span>
							</div>
						</div>
						<a href="<?= base_url() ?>/carrito/procesarpago" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Procesar pago
						</a>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } else { ?>
	<br>
	<div class="container">
		<p>No hay producto en el carrito <a href="<?= base_url() ?>/tienda"> Ver productos</a></p>
	</div>
	<br>
<?php
}
footerTienda($data);
?>
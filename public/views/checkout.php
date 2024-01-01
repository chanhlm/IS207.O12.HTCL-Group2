<link rel="stylesheet" href="./public/assets/css/checkout.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section>
	<form method="POST" id="orderForm" class="row" action="./public/backend/process_order.php">
		<div class="container bg-default col-lg-8">
			<h4 class="my-4">Thông tin giao hàng</h4>
			<div class="form-row">
				<div class="col-md-8 form-group pb-2">
					<label for="username">Họ và tên</label>
					<input type="text" class="form-control" id="username" placeholder="Họ và tên" required name="username">
				</div>

				<div class="col-md-8 form-group pb-2">
					<label for="phone">Số điện thoại</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">(+84)</span>
						</div>
						<input type="text" class="form-control" id="phone" placeholder="Số điện thoại" required name="phone">
					</div>
				</div>

				<div class="col-md-8 form-group pb-2">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" placeholder="@gmail.com" required name="email">
				</div>

				<div class="row pb-2">
					<div class="col-md-4 form-group ">
						<label for="province">Tỉnh/thành phố</label>
						<input name="province" type="text" class="form-control" id="province" placeholder="Tỉnh/thành phố" required>
					</div>
					<div class="col-md-4 form-group ms-2">
						<label for="town">Quận/huyện</label>
						<input name="town" type="text" class="form-control" id="town" placeholder="Quận/huyện" required>
					</div>
				</div>

				<div class="col-md-8 form-group pb-2">
					<label for="address">Địa chỉ</label>
					<input name="address" type="text" class="form-control" id="address" placeholder="Địa chỉ" required>
				</div>
			</div>
			<!-- <hr> -->
			<div class="form-check pb-4">
				<input type="checkbox" class="form-check-input" id="save">
				<label for="save" class="form-check-label">Lưu thông tin cho lần tiếp theo</label>
			</div>
			<!-- <hr> -->
			<hr class="mb-4">
			<input type="submit" value="Đặt hàng" class="btn btn-success bt-lg btn-block" name="submit">
			<div class="pb-5"></div>
		</div>

		<div class="col-lg-4 bg-grey">
			<div class="p-5">
				<h3 class="fw-bold mb-5 mt-2 pt-1">Tổng tiền</h3>
				<hr class="my-4" />

				<div class="d-flex justify-content-between mb-4">
					<h5 class="text-uppercase">Sản phẩm: <span class="countProduct">0</span></h5>
					<!-- <h6><span class="totalPrice">0</span> VNĐ</h6> -->
				</div>

				<h5 class="text-uppercase mb-4">NHẬN HÀNG</h5>

				<div class="mb-4 pb-2">
					<select class="select form-control" name="shipping">
						<option value="0"> Tại cửa hàng </option>
						<option value="1"> Tại nhà</option>
					</select>
				</div>

				<h5 class="text-uppercase mb-3">Mã giảm giá</h5>

				<div class="mb-5">
					<div class="form-outline">
						<input type="text" id="discountCode" class="form-control" placeholder="Nhập mã giảm giá" />
					</div>
				</div>

				<hr class="my-4" />

				<div class="d-flex justify-content-between mb-5">
					<h5 class="text-uppercase">Tổng tiền</h5>
					<h5><span class="finalTotal" name="total">0</span> VNĐ</h5>
				</div>
			</div>
		</div>
	</form>
</section>

<script>
	function formatNumber(num) {
		return num.toLocaleString('vi-VN');
	}

	let cart = JSON.parse(localStorage.getItem('cart')) || [];

	$(document).ready(function() {

		// Calculate the total order
		calculateTotalOrder(cart);
	});

	function calculateTotalOrder(cart) {
		let total = 0;
		let finalTotal = 0;
		let count = 0;


		// Loop through each product in the cart
		$.each(cart, function(index, product) {
			// Multiply the product's price by its quantity
			let productTotal = product.productPrice * product.productQuantity;
			let productDiscountedTotal = product.productDiscountedPrice * product.productQuantity;
			let countProduct = product.productQuantity;

			// Add the product's total to the order's total
			total += productTotal;
			finalTotal += productDiscountedTotal;
			count += countProduct;
		});

		// Display the total on the page
		$('.countProduct').html(count);
		$('.finalTotal').html(formatNumber(finalTotal));
		$('.totalPrice').html(formatNumber(total));
	}
</script>


<script>
	$(document).ready(function() {
		$('#orderForm').on('submit', function(e) {
			e.preventDefault();

			// Retrieve finalTotal value and convert it to a number
			let finalTotalString = $('.finalTotal').text().replace(/\./g, '');
			let finalTotalValue = parseFloat(finalTotalString);

			let formData = $(this).serializeArray();
			let cart = JSON.parse(localStorage.getItem('cart')) || [];

			// Add finalTotal to the data object
			formData.push({
				name: 'finalTotal',
				value: finalTotalValue
			});

			$.ajax({
				type: 'POST',
				url: './public/backend/process_order.php',
				data: {
					form: JSON.stringify(formData),
					cart: JSON.stringify(cart)
				},
				success: function(response) {
					console.log(response);
					response = parseInt(response);
					if (typeof response === "number") {
						alert('Đặt hàng thành công');
						localStorage.removeItem('cart');
						window.location.href = './index.php?page=order&id=' + response;
					} else {
						alert('Đặt hàng thất bại');
					}
				}
			});
		});
	});
</script>
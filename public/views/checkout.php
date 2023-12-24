<link rel="stylesheet" href="./public/assets/css/checkout.css" />

<section class="row">
	<div class="container bg-default col-lg-8">
		<h4 class="my-4">Thông tin giao hàng</h4>
		<form>
			<div class="form-row">
				<div class="col-md-8 form-group pb-2">
					<label for="firstname">Họ và tên</label>
					<input type="text" class="form-control" id="firstname" placeholder="Họ và tên" required>
				</div>

				<div class="col-md-8 form-group pb-2">
					<label for="username">Số điện thoại</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">(+84)</span>
						</div>
						<input type="text" class="form-control" id="username" placeholder="Số điện thoại" required>
					</div>
				</div>

				<div class="col-md-8 form-group pb-2">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" placeholder="@gmail.com" required>
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
				<input type="checkbox" class="form-check-input" id="same-adress">
				<label for="same-adress" class="form-check-label">Lưu thông tin cho lần tiếp theo</label>
			</div>
			<!-- <hr> -->
			<hr class="mb-4">
			<button class="btn btn-success bt-lg btn-block" type="submit">Đặt hàng</button>
		</form>
	</div>

	<div class="col-lg-4 bg-grey">
		<div class="p-5">
			<h3 class="fw-bold mb-5 mt-2 pt-1">Tổng tiền</h3>
			<hr class="my-4" />

			<div class="d-flex justify-content-between mb-4">
				<h5 class="text-uppercase">Sản phẩm: <span class="countProduct">0</span></h5>
				<h6><span class="totalPrice">0</span> VNĐ</h6>
			</div>

			<h5 class="text-uppercase mb-4">NHẬN HÀNG</h5>

			<div class="mb-4 pb-2">
				<select class="select form-control">
					<option value="1"> Tại cửa hàng </option>
					<option value="2"> Tại nhà</option>
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
				<h5><span class="finalTotal">0</span> VNĐ</h5>
			</div>
		</div>
	</div>
</section>


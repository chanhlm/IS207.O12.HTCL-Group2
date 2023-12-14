<link rel="stylesheet" href="./public/assets/css/info.css" />

<section>
	<div class="container bg-default">
		<h4 class="my-4">Thông tin giao hàng</h4>
		<form>
			<div class="form-row">
				<div class="col-md-8 form-group">
					<label for="firstname">Họ và tên</label>
					<input type="text" class="form-control" id="firstname" placeholder="Họ và tên" required>
				</div>
				<div class="col-md-8 form-group">
					<label for="username">Số điện thoại</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">(+84)</span>
						</div>
						<input type="text" class="form-control" id="username" placeholder="Số điện thoại" required>
					</div>
				</div>
				<div class="col-md-8 form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" placeholder="@gmail.com" required>
				</div>
				<div class="row">
					<div class="col-md-4 form-group">
						<label for="province">Tỉnh/thành phố</label>
						<input name="province" type="text" class="form-control" id="province" placeholder="Tỉnh/thành phố" required>
					</div>
					<div class="col-md-4 form-group ms-2">
						<label for="town">Quận/huyện</label>
						<input name="town" type="text" class="form-control" id="town" placeholder="Quận/huyện" required>
					</div>
				</div>
				<div class="col-md-8 form-group">
					<label for="address">Địa chỉ</label>
					<input name="address" type="text" class="form-control" id="address" placeholder="Địa chỉ" required>
				</div>
			</div>
			<!-- <hr> -->
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="same-adress">
				<label for="same-adress" class="form-check-label">Lưu thông tin cho lần tiếp theo</label>
			</div>
			<!-- <hr> -->
			<hr class="mb-4">
			<button class="btn btn-primary bt-lg btn-block" type="submit">Tiếp tục</button>
		</form>
	</div>
</section>
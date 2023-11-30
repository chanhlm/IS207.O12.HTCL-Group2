<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
	<link rel="stylesheet" href="../assets/css/base.css" />
	<link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css" />
	<link rel="stylesheet" href="../assets/css/info.css" />
	<link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

	<?php
	$pageTitle = "ecoTech - Thông tin giao hàng";
	?>
	<title><?php echo $pageTitle ?></title>
</head>

<body>
	<?php include '../components/header.php'; ?>


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

	<?php include '../components/footer.php'; ?>
</body>

</html>
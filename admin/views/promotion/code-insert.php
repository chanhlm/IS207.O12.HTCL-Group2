<?php
	$sql_code = mysqli_query($connect, "SELECT * FROM CODE_DISCOUNT");
	$count_code = mysqli_num_rows($sql_code);
?>

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Mã khuyến mãi </li>
						<li class="breadcrumb-item active" aria-current="page">Thêm mã khuyến mãi </li>
					</ol>
				</nav>
			</div>
		</div>	

		<h6 class="mb-0 text-uppercase">Mã khuyến mãi - <?php echo $count_code ?> mã</h6>
		<hr />
		<!-- insert form -->
		<div class="card">
			<div class="card-body">
				<form method="POST">
					<div class="row">
						<div class="col-md-3">
							<div class="mb-3">
								<label for="code-id" class="form-label">Mã khuyến mãi</label>
								<input type="text" class="form-control" id="code-id" name="code-id" placeholder="ID" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="name" class="form-label">Tên mã khuyến mãi</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên mã" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label for="percent" class="form-label">Phần trăm ưu đãi</label>
								<input type="number" class="form-control" id="percent" name="percent" min="0" step="1" value="0" required>
							</div>
						</div>
						
					</div>	
					<div class="col-md-12">
						<div class="mb-3">
							<label for="code-description" class="form-label">Mô tả</label>
							<input type="text" class="form-control" id="code-description" name="code-description" placeholder="Mô tả chi tiết" required>
						</div>
					</div>

					<button type="submit" name="insert" class="btn btn-success">Thêm</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end page wrapper -->

<?php
if (isset($_POST['insert'])) {
	$code_id = $_POST['code-id'];
	$code_name = $_POST['name'];
	$code_percent = $_POST['percent'];
	$code_description = $_POST['code-description'];

	$sql_insert = mysqli_query($connect, "INSERT INTO CODE_DISCOUNT VALUES ('$code_id', '$code_name', '$code_percent', '$code_description')");
	if ($sql_insert) {
		echo '<script>alert("Thêm thành công!")</script>';
		echo '<script>window.location.href="./index.php?page=code"</script>';
	} else {
		echo '<script>alert("Thêm thất bại!")</script>';
	}
}
?>
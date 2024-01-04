<?php
$sql_code = mysqli_query($connect, "SELECT *FROM PROMOTION ORDER BY PROMOTION_ID");
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
						<li class="breadcrumb-item active" aria-current="page">Khuyến mãi </li>
						<li class="breadcrumb-item active" aria-current="page">Thêm khuyến mãi </li>
					</ol>
				</nav>
			</div>
		</div>

		<h6 class="mb-0 text-uppercase">Khuyến mãi - <?php echo $count_code ?> </h6>
		<hr />
		<!-- insert form -->
		<div class="card">
			<div class="card-body">
				<form method="POST">
					<div class="row">
						<div class="col-md-2">
							<div class="mb-3">
								<label for="code-id" class="form-label">Mã khuyến mãi</label>
								<input type="text" class="form-control" id="code-id" name="code-id" placeholder="ID" value="<?php if (isset($_GET['code_id'])) {
																																echo $_GET['code_id'];
																															} ?>" required readonly>
							</div>
						</div>
						<div class="col-md-10">
							<div class="mb-3">
								<label for="list-product" class="form-label">Danh sách sản phẩm</label>
								<input type="text" class="form-control" id="list-product" name="list-product" placeholder="Danh sách sản phẩm, mỗi sản phẩm cách nhau 1 dấu cách" required>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="start-date" class="form-label">Thời gian bắt đầu</label>
								<input type="datetime-local" class="form-control" id="start-date" name="start-date" min="0" step="1" value="0" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="end-date" class="form-label">Thời gian kết thúc</label>
								<input type="datetime-local" class="form-control" id="end-date" name="end-date" min="0" step="1" value="0" required>
							</div>
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
	$list_product = $_POST['list-product'];
	$products = explode(' ', $list_product);
	$start_date = $_POST['start-date'];
	$end_date = $_POST['end-date'];

	$start_date = $_POST['start-date'];
	$end_date = $_POST['end-date'];

	
	// Convert date strings to DateTime objects for comparison
	$startDateTime = new DateTime($start_date);
	$endDateTime = new DateTime($end_date);

	// Check if start date is later than end date
	if ($startDateTime > $endDateTime) {
		// Redirect back to the form with an error message or handle the error in some way
		// header("Location: ./index.php?page=code");
		exit;
	}

	// Continue processing the form data since the dates are valid
	// Your code for processing the form goes here...



	// Thêm dấu nháy đơn vào mỗi phần tử trong mảng
	$product_ids = array_map(function ($id) {
		return "'$id'";
	}, $products);

	// Chuyển đổi mảng thành chuỗi
	$product_ids_string = implode(',', $product_ids);

	// Sử dụng chuỗi trong câu truy vấn SQL
	$sql_product = mysqli_query($connect, "SELECT * FROM PRODUCTS WHERE PRODUCT_ID IN ($product_ids_string)");
	$count_product = mysqli_num_rows($sql_product);

	if ($count_product == 0) {
		echo "<script>alert('Sản phẩm không tồn tại!')</script>";
	} else {
		foreach ($products as $product_id) {
			$combined_value = $code_id . $product_id;
			$sql_insert = mysqli_query($connect, "INSERT INTO PROMOTION VALUES ('$combined_value','$code_id' ,'$start_date', '$end_date', '$product_id')");

			if ($sql_insert) {
				echo "<script>alert('Thêm thành công!')</script>";
				echo "<script>window.location.href = './index.php?page=promotion'</script>";
			} else {
				echo "<script>alert('Thêm thất bại!')</script>";
			}
		}
	}
}



?>
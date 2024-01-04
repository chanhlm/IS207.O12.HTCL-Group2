<?php
	$sql_code = mysqli_query($connect, "SELECT * FROM CODE_DISCOUNT ");
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
						<li class="breadcrumb-item active" aria-current="page">Sửa mã khuyến mãi </li>
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
								<input type="text" class="form-control" id="code-id" name="code-id" placeholder="ID" value="<?php if (isset($_GET['code_id'])) {
                                                                                                                                        echo $_GET['code_id'];
                                                                                                                                    } ?>" required>
							</div>
						</div>
						<div class="col-md-9">
							<div class="mb-3">
								<label for="name" class="form-label">Tên mã khuyến mãi</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên mã" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="percent" class="form-label">Phần trăm ưu đã</label>
								<input type="number" class="form-control" id="percent" name="percent" min="0" step="1" value="0" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="count" class="form-label">Đang được sử dụng</label>
								<input type="number" class="form-control" id="count" name="count" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="mb-3">
							<label for="code-description" class="form-label">Mô tả</label>
							<input type="text" class="form-control" id="code-description" name="code-description" placeholder="Mô tả chi tiết" required>
						</div>
					</div>

					<button type="submit" name="update" class="btn btn-primary">Sửa</button>

				</form>
			</div>
		</div>
	</div>
</div>
<!--end page wrapper -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
	$(document).ready(function() {

		var codeId = $("#code-id").val();

		// Kiểm tra nếu ô input có giá trị từ ban đầu
		if (codeId) {
			// Gọi hàm để xử lý sự kiện change
			handleCodeChange();
		}

		$("#code-id").on("input", handleCodeChange);

		function handleCodeChange() {
			codeId = $("#code-id").val();
			// Kiểm tra nếu code_id không rỗng
			$.ajax({
				type: "POST",
				url: "./backend/code_fetch_data.php",
				data: {
					code_id: codeId
				},
				success: function(response) {
					var data = JSON.parse(response);
					console.log(data);

					// Gán dữ liệu vào các ô input
					$("#name").val(data.code_name);
					$("#percent").val(data.code_percent);
					$("#count").val(data.count_promotion);
					$("#code-description").val(data.code_description);
				}
			});
		}
	});
</script>


<?php
if (isset($_POST['update'])) {
	$code_id = trim($_POST['code-id']);

	$code_name = trim($_POST['name']);
	$code_percent = trim($_POST['percent']);
	$code_description = trim($_POST['code-description']);

	// echo "<script>alert('$code_id - $code_name - $code_picture - $code_description' )</script>";

	$sql_update = mysqli_query($connect, "UPDATE CODE_DISCOUNT SET CODE_NAME = '$code_name', CODE_PERCENT = '$code_percent', CODE_DESCRIPTION = '$code_description' WHERE CODE_ID = '$code_id'");

	if ($sql_update) {
		echo "<script>alert('Cập nhập thành công!')</script>";
	} else {
		echo "<script>alert('Cập nhập thất bại!')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--plugins-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
	<!-- loader-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace-theme-default.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/categories.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../assets/css/semi-dark.css" />

	<link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

	<?php
	$pageTitle = "ecoTech - Danh mục sản phẩm";
	?>
	<title><?php echo $pageTitle ?></title>

</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php include_once "../components/sidebar.php" ?>

		<?php include_once "../components/header.php" ?>


		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="./dashboard.php"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm </li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div >
							<a href="./categories-insert.php" class="ms-2 me-2 btn btn-success">Thêm</a>
							<a href="./categories-update.php" class="ms-2 me-2 btn btn-primary "> Sửa </a>
							<a href="" class="ms-2 me-2 btn btn-danger"> Xóa </a>		
						</div>
					</div>
				</div>

				<h6 class="mb-0 text-uppercase">Danh mục sản phẩm </h6>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Mã danh mục</th>
										<th>Tên danh mục</th>
										<th>Số sản phẩm</th>
										<th>Ghi chú</th>
										<th>Hình ảnh</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
									</tr>
									<tr>
										<td>Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
									</tr>
									<tr>
										<td>Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>Mã danh mục</th>
										<th>Tên danh mục</th>
										<th>Số sản phẩm</th>
										<th>Ghi chú</th>
										<th>Hình ảnh</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>


		</div>
	</div>
	<!--end page wrapper -->


	<?php include_once "../components/footer.php" ?>
	</div>
	<!--end wrapper-->

	<!-- Bootstrap JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
	<script src="../assets/plugins/chartjs/chart.min.js"></script>
	<script src="../assets/js/index.js"></script>
	<!--app JS-->
	<script src="../assets/js/app.js"></script>
</body>

</html>
<!doctype html>
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
	<link href="../assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../assets/css/semi-dark.css" />

	<link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

	<?php
	$pageTitle = "ecoTech - Feedback";
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
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Phản hồi của khách hàng</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!-- FEEDBACK -->
				<div class="col-12 col-lg-12 col-xl-12 d-flex">
					<div class="card radius-10 w-100">
						<div class="card-header border-bottom bg-transparent">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Customer Review</h5>
								</div>
								<div class="dropdown options ms-auto">
									<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
										<i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
									</ul>
								</div>
							</div>
						</div>
						<ul class="list-group list-group-flush review-list">
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="assets/images/avatars/avatar-1.png" alt="user avatar" class="rounded-circle" width="55" height="55">
									<div class="ms-3">
										<h6 class="mb-0">iPhone X <small class="ms-4">08.34 AM</small></h6>
										<p class="mb-0 small-font">Sara Jhon : This is svery Nice phone in low budget.
										</p>
									</div>
									<div class="ms-auto star">
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-light-4'></i>
										<i class='bx bxs-star text-light-4'></i>
									</div>
								</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="assets/images/avatars/avatar-2.png" alt="user avatar" class="rounded-circle" width="55" height="55">
									<div class="ms-3">
										<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
										<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
									</div>
									<div class="ms-auto star">
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-light-4'></i>
										<i class='bx bxs-star text-light-4'></i>
									</div>
								</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="assets/images/avatars/avatar-3.png" alt="user avatar" class="rounded-circle" width="55" height="55">
									<div class="ms-3">
										<h6 class="mb-0">Mackbook Pro <small class="ml-4">06.45 AM</small></h6>
										<p class="mb-0 small-font">Jhon Doe : Excllent product and awsome quality</p>
									</div>
									<div class="ms-auto star">
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-light-4'></i>
										<i class='bx bxs-star text-light-4'></i>
									</div>
								</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="assets/images/avatars/avatar-4.png" alt="user avatar" class="rounded-circle" width="55" height="55">
									<div class="ms-3">
										<h6 class="mb-0">Air Pod <small class="ml-4">08.34 AM</small></h6>
										<p class="mb-0 small-font">Christine : The brand apple is original !</p>
									</div>
									<div class="ms-auto star">
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-light-4'></i>
										<i class='bx bxs-star text-light-4'></i>
									</div>
								</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="assets/images/avatars/avatar-9.png" alt="user avatar" class="rounded-circle" width="55" height="55">
									<div class="ms-3">
										<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
										<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
									</div>
									<div class="ms-auto star">
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-warning'></i>
										<i class='bx bxs-star text-light-4'></i>
										<i class='bx bxs-star text-light-4'></i>
									</div>
								</div>
							</li>

						</ul>
					</div>
				</div>
			</div><!--End Row-->
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
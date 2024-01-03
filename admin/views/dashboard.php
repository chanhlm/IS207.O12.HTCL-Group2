<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
			<div class="col">
				<div class="card radius-10 bg-primary">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-white">Người dùng</p>
								<h4 class="my-1 text-white">
									<?php
										$sql = "SELECT * FROM users";
										$result = mysqli_query($connect, $sql);
										$count = mysqli_num_rows($result);
										echo $count;
									?>
								</h4>
							</div>
							<div class="text-white ms-auto font-35"><i class="bx bxs-user-account"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 bg-success">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-white">Sản phẩm</p>
								<h4 class="my-1 text-white">
									<?php
										$sql = "SELECT * FROM PRODUCTS";
										$result = mysqli_query($connect, $sql);
										$count = mysqli_num_rows($result);
										echo $count;
									?>
								</h4>
							</div>
							<div class="text-white ms-auto font-35"><i class="bx bxs-package"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 bg-danger">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-white">Đơn hàng</p>
								<h4 class="text-white my-1">
									<?php
										$sql = "SELECT * FROM orders";
										$result = mysqli_query($connect, $sql);
										$count = mysqli_num_rows($result);
										echo $count;
									?>
								</h4>
							</div>
							<div class="text-white ms-auto font-35"><i class="bx bx-cart-alt"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 bg-dark">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-white">Doanh thu</p>
								<h4 class="my-1 text-white">
									<?php
										$currentMonth = date('m');
										
										// Truy vấn SQL để lấy tổng doanh thu của tháng hiện tại
										$sql = "SELECT SUM(ORDER_TOTAL) AS totalRevenue FROM ORDERS WHERE order_status != 4 ";
										$result = mysqli_query($connect, $sql);
										
										// Lấy dữ liệu từ truy vấn
										$row = mysqli_fetch_array($result);
										echo number_format($row['totalRevenue'], 0, ',', '.');
									?> VNĐ
								</h4>
							</div>
							<div class="text-white ms-auto font-35"><i class="bx bx-dollar"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->

		<div class="row">
			<div class="col-12 col-lg-8 col-xl-8 d-flex">
				<div class="card radius-10 w-100">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="mb-0">Site Traffic</h5>
							</div>
							<div class="dropdown options ms-auto">
								<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
									<i class='bx bx-dots-horizontal-rounded'></i>
								</div>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="javascript:;">Action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Something else here</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="chart-js-container1">
							<canvas id="chart1"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-4 col-xl-4 d-flex">
				<div class="card radius-10 overflow-hidden w-100">
					<div class="card-body">
						<p>Total Earning</p>
						<h4 class="mb-0">$287,493</h4>
						<small>1.4% <i class='bx bx-up-arrow-alt'></i> Since Last Month</small>
						<hr>
						<p>Total Sales</p>
						<h4 class="mb-0">$87,493</h4>
						<small>5.43% <i class='bx bx-up-arrow-alt'></i> Since Last Month</small>
						<div class="mt-5">
							<div class="chart-container-4">
								<canvas id="chart5"></canvas>
							</div>
						</div>
					</div>
					<div class="card-body" hidden>
						<div class="chart-js-container1">
							<canvas id="chart2"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--End Row-->


		<!-- <div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-0">Orders Summary</h5>
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
				<hr>
				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead class="table-light">
							<tr>
								<th>Order id</th>
								<th>Product</th>
								<th>Customer</th>
								<th>Date</th>
								<th>Price</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>#897656</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/chair.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Light Blue Chair</h6>
										</div>
									</div>
								</td>
								<td>Brooklyn Zeo</td>
								<td>12 Jul 2020</td>
								<td>$64.00</td>
								<td>
									<div class="badge rounded-pill bg-light-info text-info w-100">In Progress
									</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#987549</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/shoes.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Green Sport Shoes</h6>
										</div>
									</div>
								</td>
								<td>Martin Hughes</td>
								<td>14 Jul 2020</td>
								<td>$45.00</td>
								<td>
									<div class="badge rounded-pill bg-light-success text-success w-100">
										Completed</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#685749</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/headphones.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Red Headphone 07</h6>
										</div>
									</div>
								</td>
								<td>Shoan Stephen</td>
								<td>15 Jul 2020</td>
								<td>$67.00</td>
								<td>
									<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled
									</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#887459</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/idea.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Mini Laptop Device</h6>
										</div>
									</div>
								</td>
								<td>Alister Campel</td>
								<td>18 Jul 2020</td>
								<td>$87.00</td>
								<td>
									<div class="badge rounded-pill bg-light-success text-success w-100">
										Completed</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#335428</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/user-interface.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Purple Mobile Phone</h6>
										</div>
									</div>
								</td>
								<td>Keate Medona</td>
								<td>20 Jul 2020</td>
								<td>$75.00</td>
								<td>
									<div class="badge rounded-pill bg-light-info text-info w-100">In Progress
									</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#224578</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/watch.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">Smart Hand Watch</h6>
										</div>
									</div>
								</td>
								<td>Winslet Maya</td>
								<td>22 Jul 2020</td>
								<td>$80.00</td>
								<td>
									<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled
									</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>#447896</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="assets/images/icons/tshirt.png" alt="">
										</div>
										<div class="ms-2">
											<h6 class="mb-1 font-14">T-Shirt Blue</h6>
										</div>
									</div>
								</td>
								<td>Emy Jackson</td>
								<td>28 Jul 2020</td>
								<td>$96.00</td>
								<td>
									<div class="badge rounded-pill bg-light-success text-success w-100">
										Completed</div>
								</td>
								<td>
									<div class="d-flex order-actions"> <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
										<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div> -->

	</div>
</div>
<!--end page wrapper -->
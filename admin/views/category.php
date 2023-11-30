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
				<div>
					<a href="./index.php?quanly=category-insert" class="ms-2 me-2 btn btn-success">Thêm</a>
					<a href="./index.php?quanly=category-update" class="ms-2 me-2 btn btn-primary "> Sửa </a>
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
							<tr class="text-center">
								<th>Mã danh mục</th>
								<th>Tên danh mục</th>
								<th>Số sản phẩm</th>
								<th>Ghi chú</th>
								<th>Hình ảnh</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$sql_category = mysqli_query($connect, "SELECT * FROM CATEGORIES");
							while ($row_category = mysqli_fetch_array($sql_category)) {
							?>
								<tr class="align-middle">
									<td class="text-center"><?php echo $row_category['CATEGORY_ID'] ?></td>
									<td><?php echo $row_category['CATEGORY_NAME'] ?></td>
									<td class="text-center"><?php echo $row_category['NUMBER_PRODUCT'] ?></td>
									<td><?php echo $row_category['CATEGORY_DESCRIPTION'] ?></td>
									<td class="text-center"><img src="<?php echo $row_category['CATEGORY_IMAGE'] ?>" width="150px" align-center></td>
								</tr>
							<?php
							}
							?>
						</tbody>
						<tfoot>
							<tr class="text-center">
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
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
						<li class="breadcrumb-item active" aria-current="page">Thêm danh mục </li>
					</ol>
				</nav>
			</div>
		</div>


		<h6 class="mb-0 text-uppercase">Danh mục sản phẩm </h6>
		<hr />
		<!-- insert form -->
		<div class="card">
			<div class="card-body">
				<form action="../../admin/controllers/categories.php" method="POST">
					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="category-id" class="form-label">Mã danh mục</label>
								<input type="text" class="form-control" id="category-id" name="category-id" placeholder="ID" required readonly>
							</div>
						</div>
						<div class="col-md-8">
							<div class="mb-3">
								<label for="name" class="form-label">Tên danh mục</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="mb-3">
							<label for="category-picture" class="form-label">Hình ảnh</label>
							<input type="text" class="form-control" id="category-picture" name="category-picture" placeholder="Hình ảnh" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="mb-3">
							<label for="product-description" class="form-label">Mô tả</label>
							<input type="text" class="form-control" id="product-description" name="product-description" placeholder="Mô tả chi tiết" required>
						</div>
					</div>

					<button type="submit" name="insert" class="btn btn-success">Thêm</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end page wrapper -->
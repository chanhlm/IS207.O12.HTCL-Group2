<?php
$sql_product = "SELECT 
		    P.PRODUCT_ID,
		    P.PRODUCT_NAME,
		    C.CATEGORY_NAME,
		    B.BRAND_NAME,
		    W.PRODUCT_QUANTITY,
			P.PRODUCT_SALEPRICE,
		    P.PRODUCT_IMAGE,
		    P.PRODUCT_DESCRIPTION,
			p.PRODUCT_STATUS
		FROM PRODUCTS P
		JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID
		JOIN BRANDS B ON P.BRAND_ID = B.BRAND_ID
		JOIN WAREHOUSE W ON P.PRODUCT_ID = W.PRODUCT_ID
		ORDER BY P.CATEGORY_ID ASC, P.PRODUCT_ID ;";

if (isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];
	$sql_product = "SELECT 
		    P.PRODUCT_ID,
		    P.PRODUCT_NAME,
		    C.CATEGORY_NAME,
		    B.BRAND_NAME,
		    W.PRODUCT_QUANTITY,
			P.PRODUCT_SALEPRICE,
		    P.PRODUCT_IMAGE,
		    P.PRODUCT_DESCRIPTION,
			p.PRODUCT_STATUS
		FROM PRODUCTS P
		JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID
		JOIN BRANDS B ON P.BRAND_ID = B.BRAND_ID
		JOIN WAREHOUSE W ON P.PRODUCT_ID = W.PRODUCT_ID
		WHERE P.CATEGORY_ID = '$category_id'
		ORDER BY P.CATEGORY_ID ASC, P.PRODUCT_ID ;";
}

if (isset($_GET['brand_id'])) {
	$brand_id = $_GET['brand_id'];
	$sql_product = "SELECT 
		    P.PRODUCT_ID,
		    P.PRODUCT_NAME,
		    C.CATEGORY_NAME,
		    B.BRAND_NAME,
		    W.PRODUCT_QUANTITY,
			P.PRODUCT_SALEPRICE,
		    P.PRODUCT_IMAGE,
		    P.PRODUCT_DESCRIPTION,
			p.PRODUCT_STATUS
		FROM PRODUCTS P
		JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID
		JOIN BRANDS B ON P.BRAND_ID = B.BRAND_ID
		JOIN WAREHOUSE W ON P.PRODUCT_ID = W.PRODUCT_ID
		WHERE P.BRAND_ID = '$brand_id'
		ORDER BY P.CATEGORY_ID ASC, P.PRODUCT_ID ;";
}

$result_product = mysqli_query($connect, $sql_product);

if ($result_product)
	$count_product = mysqli_num_rows($result_product);
else $count_product = 0;

?>

<style>
	tr,
	th,
	td {
		white-space: wrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Sản phẩm </li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<a href="./index.php?page=product-insert" class="ms-2 me-2 btn btn-success">Thêm</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToUpdatePage()"> Sửa </a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a>
				</div>
			</div>
		</div>

		<h6 class="mb-0 text-uppercase">Sản phẩm - <?php echo $count_product ?> sản phẩm</h6>
		<hr />
		<div class="card ">
			<div class="card-body container">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr class="text-center align-middle">
								<th scope="col">Chọn <input type="checkbox" id="selectAllCheckbox"></th>
								<th scope="col">Mã sản phẩm</th>
								<th scope="col">Tên sản phẩm</th>
								<th scope="col">Danh mục</th>
								<th scope="col">Hãng</th>
								<th scope="col">Giá bán</th>
								<th scope="col">Tồn kho</th>
								<th scope="col">Mô tả sản phẩm</th>
								<th scope="col">Hình ảnh</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result_product)
							while ($row_product = mysqli_fetch_assoc($result_product)) {
							?>
								<tr class="align-middle 
								<?php 
								if ($row_product['PRODUCT_STATUS'] !== 'active') {
									echo "table-danger text-decoration-line-through";
								}
								?>
								">
									<td class="text-center"><input type="checkbox" name="selected_products[]" value="<?php echo $row_product['PRODUCT_ID']; ?>"></td>
									<td class="text-center"><?php echo $row_product['PRODUCT_ID'] ?></td>
									<td> <?php echo $row_product['PRODUCT_NAME']; ?> </td>
									<td class="text-center"><?php echo $row_product['CATEGORY_NAME'] ?></td>
									<td class="text-center"><?php echo $row_product['BRAND_NAME'] ?></td>
									<td class="text-center"><?php echo number_format($row_product['PRODUCT_SALEPRICE'], 0, ',', '.') ?>đ</td>
									<td class="text-center"><?php echo $row_product['PRODUCT_QUANTITY'] ?></td>
									<td><?php echo $row_product['PRODUCT_DESCRIPTION'] ?></td>
									<td class="text-center"><img src="<?php echo $row_product['PRODUCT_IMAGE'] ?>" width="150px" align-center></td>
								</tr>
							<?php
							}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center align-middle">
								<th>Chọn</th>
								<th>Mã sản phẩm</th>
								<th>Tên sản phẩm</th>
								<th>Danh mục</th>
								<th>Hãng</th>
								<th>Giá bán</th>
								<th>Tồn kho</th>
								<th>Mô tả sản phẩm</th>
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

<script>
	function updateDeleteButtonState() {
		var selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedProducts.length === 0;
	}

	function deleteSelected() {
		var selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');
		if (selectedProducts.length === 0) {
			alert("Vui lòng chọn ít nhất một sản phẩm để xóa.");
			return;
		}

		var confirmDelete = confirm("Bạn có chắc muốn xóa các sản phẩm đã chọn?");
		if (confirmDelete) {
			var productIds = Array.from(selectedProducts).map(function(checkbox) {
				
				return checkbox.value;
			});

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {	
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						// Successful response from the server
						alert(xhr.responseText); // Display success message or handle accordingly
						// You may want to reload or update the table after successful deletion
						location.reload();	
					} else {
						// Error handling
						alert('Lỗi xóa: ' + xhr.statusText);
					}
				}
			};

			// Construct the URL for the delete operation
			var url = "./backend/product_delete.php?product_ids=" + productIds.join(",");

			// Open and send the request
			xhr.open("GET", url, true);
			xhr.send();
		}
	}

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function() {
		var checkboxes = document.querySelectorAll('input[name="selected_products[]"]');
		checkboxes.forEach(function(checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});
</script>

<script>
	function redirectToUpdatePage() {
		var selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');

		// Ensure that exactly one cproduct is selected
		if (selectedProducts.length === 1) {
			var selectedProductId = selectedProducts[0].value;
			window.location.href = './index.php?page=product-update&product_id=' + selectedProductId;
		} else {
			alert("Vui lòng chỉ chọn một sản phẩm để sửa.");
		}
	}
</script>

<script>
	// button chọn tất cả
    document.addEventListener("DOMContentLoaded", function () {
        var selectAllCheckbox = document.getElementById("selectAllCheckbox");
        var productCheckboxes = document.querySelectorAll("#example tbody td:first-child input[type='checkbox']");

        selectAllCheckbox.addEventListener("change", function () {
            // Khi checkbox "Chọn Tất Cả" thay đổi trạng thái, cập nhật trạng thái của các checkbox sản phẩm
            productCheckboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Sự kiện để kiểm tra trạng thái của các checkbox sản phẩm và cập nhật checkbox "Chọn Tất Cả"
        productCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                selectAllCheckbox.checked = [...productCheckboxes].every(function (checkbox) {
                    return checkbox.checked;
                });
            });
        });
    });
</script>
<?php
	$sql_brand = mysqli_query($connect, "SELECT * FROM BRANDS");
	$count_brand = mysqli_num_rows($sql_brand);
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
						<li class="breadcrumb-item active" aria-current="page">Nhãn hàng </li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-info" onclick="redirectToProductPage()">Xem sản phẩm</a>
					<a href="./index.php?page=brand-insert" class="ms-2 me-2 btn btn-success">Thêm</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToUpdatePage()"> Sửa </a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a>
				</div>
			</div>
		</div>	

		<h6 class="mb-0 text-uppercase">Nhãn hàng - <?php echo $count_brand ?> hãng</h6>
		<hr />
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr class="text-center">
								<th>Chọn <br> <input type="checkbox" id="selectAllCheckbox"></th>
								<th>Mã nhãn hàng</th>
								<th>Tên nhãn hàng</th>
								<th>Quốc gia</th>
								<th>Số sản phẩm</th>
								<th>Ghi chú</th>
								<th>Hình ảnh</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row_brand = mysqli_fetch_array($sql_brand)) {
							?>
								<tr class="align-middle">
									<td class="text-center"><input type="checkbox" name="selected_brands[]" value="<?php echo $row_brand['BRAND_ID']; ?>"></td>
									<td class="text-center"><?php echo $row_brand['BRAND_ID'] ?></td>
									<td><?php echo $row_brand['BRAND_NAME'] ?></td>
									<td><?php echo $row_brand['COUNTRY'] ?></td>
									<td class="text-center"><?php echo $row_brand['NUMBER_PRODUCT'] ?></td>
									<td><?php echo $row_brand['BRAND_DESCRIPTION'] ?></td>
									<td class="text-center"><img src="<?php echo $row_brand['BRAND_IMAGE'] ?>" width="150px" align-center></td>
								</tr>
							<?php
							}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center">
								<th>Chọn</th>
								<th>Mã nhãn hàng</th>
								<th>Tên nhãn hàng</th>
								<th>Quốc gia</th>
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

<script>
	function updateDeleteButtonState() {
		var selectedBrands = document.querySelectorAll('input[name="selected_brands[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedBrands.length === 0;
	}

	function deleteSelected() {
		var selectedBrands = document.querySelectorAll('input[name="selected_brands[]"]:checked');
		if (selectedBrands.length === 0) {
			alert("Vui lòng chọn ít nhất một nhãn hàng để xóa.");
			return;
		}

		var confirmDelete = confirm("Bạn có chắc muốn xóa các nhãn hàng đã chọn?");
		if (confirmDelete) {
			var brandIds = Array.from(selectedBrands).map(function (checkbox) {
				return checkbox.value;
			});

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
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
			var url = "./backend/brand_delete.php?brand_ids=" + brandIds.join(",");

			// Open and send the request
			xhr.open("GET", url, true);
			xhr.send();
		}
	}

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function () {
		var checkboxes = document.querySelectorAll('input[name="selected_brands[]"]');
		checkboxes.forEach(function (checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});
</script>

<script>
    function redirectToUpdatePage() {
        var selectedBrands = document.querySelectorAll('input[name="selected_brands[]"]:checked');

        // Ensure that exactly one brand is selected
        if (selectedBrands.length === 1) {
            var selectedbrandId = selectedBrands[0].value;
            window.location.href = './index.php?page=brand-update&brand_id=' + selectedbrandId;
        } else {
            alert("Vui lòng chỉ chọn một nhãn hàng");
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

<script>
	function redirectToProductPage() {
		var selectedBrands = document.querySelectorAll('input[name="selected_brands[]"]:checked');

        // Ensure that exactly one brand is selected
        if (selectedBrands.length === 1) {
            var selectedBrandId = selectedBrands[0].value;
            window.location.href = './index.php?page=product&brand_id=' + selectedBrandId;
        } else {
            alert("Vui lòng chọn 1 danh mục!.");
        }
	}

</script>

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
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-info" onclick="redirectToPromotionPage()">Xem khuyến mãi</a>
					<a href="./index.php?page=code-insert" class="ms-2 me-2 btn btn-success">Thêm mã</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-secondary" onclick="redirectToAddPromotionPage()">Thêm khuyến mãi</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToUpdatePage()"> Sửa </a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a>
				</div>
			</div>
		</div>	

		<h6 class="mb-0 text-uppercase">Mã khuyến mãi - <?php echo $count_code ?> mã</h6>
		<hr />
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr class="text-center">
								<th>Chọn <br> <input type="checkbox" id="selectAllCheckbox"></th>
								<th>Mã khuyến mãi</th>
								<th>Tên khuyến mãi</th>
								<th>Ưu đãi</th>
								<th>Đang sử dụng</th>
								<th>Mô tả</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row_code = mysqli_fetch_array($sql_code)) {
								$sql_promotion = mysqli_query($connect, "SELECT count(PROMOTION_ID) as count_promotion FROM PROMOTION WHERE PROMOTION_CODE = '".$row_code['CODE_ID']."'");
								$row_promotion = mysqli_fetch_array($sql_promotion);
							?>
								<tr class="align-middle">
									<td class="text-center"><input type="checkbox" name="selected_codes[]" value="<?php echo $row_code['CODE_ID']; ?>"></td>
									<td class="text-center"><?php echo $row_code['CODE_ID'] ?></td>
									<td><?php echo $row_code['CODE_NAME'] ?></td>
									<td class="text-center"><?php echo $row_code['CODE_PERCENT'] ?> %</td>
									<td class="text-center"><?php echo $row_promotion['count_promotion'] ?></td>
									<td><?php echo $row_code['CODE_DESCRIPTION'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center">
								<th>Chọn</th>
								<th>Mã khuyến mãi</th>
								<th>Tên khuyến mãi</th>
								<th>Đang sử dụng</th>
								<th>Mô tả</th>
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
		var selectedCodes = document.querySelectorAll('input[name="selected_codes[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedCodes.length === 0;
	}

	function deleteSelected() {
		var selectedCodes = document.querySelectorAll('input[name="selected_codes[]"]:checked');
		if (selectedCodes.length === 0) {
			alert("Vui lòng chọn ít nhất một mã để xóa.");
			return;
		}

		var confirmDelete = confirm("Bạn có chắc muốn xóa các mã đã chọn?");
		if (confirmDelete) {
			var codeIds = Array.from(selectedCodes).map(function (checkbox) {
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
			var url = "./backend/code_delete.php?code_ids=" + codeIds.join(",");

			// Open and send the request
			xhr.open("GET", url, true);
			xhr.send();
		}
	}

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function () {
		var checkboxes = document.querySelectorAll('input[name="selected_codes[]"]');
		checkboxes.forEach(function (checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});
</script>

<script>
    function redirectToUpdatePage() {
        var selectedCodes = document.querySelectorAll('input[name="selected_codes[]"]:checked');

        // Ensure that exactly one code is selected
        if (selectedCodes.length === 1) {
            var selectedcodeId = selectedCodes[0].value;
            window.location.href = './index.php?page=code-update&code_id=' + selectedcodeId;
        } else {
            alert("Vui lòng chỉ chọn một mã khuyến mãi");
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
	function redirectToPromotionPage() {
		var selectedCodes = document.querySelectorAll('input[name="selected_codes[]"]:checked');

        // Ensure that exactly one code is selected
        if (selectedCodes.length === 1) {
            var selectedCodeId = selectedCodes[0].value;
            window.location.href = './index.php?page=promotion&code_id=' + selectedCodeId;
        } else {
            alert("Vui lòng chọn 1 mã khuyến mãi!.");
        }
	}

</script>

<script>
	function redirectToAddPromotionPage() {
		var selectedCodes = document.querySelectorAll('input[name="selected_codes[]"]:checked');

		// Ensure that exactly one code is selected
		if (selectedCodes.length === 1) {
			var selectedCodeId = selectedCodes[0].value;
			window.location.href = './index.php?page=promotion-insert&code_id=' + selectedCodeId;
		} else {
			alert("Vui lòng chọn 1 mã khuyến mãi!.");
		}
	}
</script>

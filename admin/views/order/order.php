<?php
if (isset($_GET['customer_id']))
	$sql = "SELECT * FROM `orders`, `users` WHERE orders.USER_PHONE = users.USER_PHONE and USERS.USER_PHONE = '" .$_GET['customer_id'] . "' ORDER BY orders.ORDER_ID DESC";
else
	$sql = "SELECT * FROM `orders`, `users` WHERE orders.USER_PHONE = users.USER_PHONE ORDER BY orders.ORDER_ID DESC";

$result_order = mysqli_query($connect, $sql);
$count_order = mysqli_num_rows($result_order);


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
						<li class="breadcrumb-item active" aria-current="page">Đơn hàng </li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<a href="./index.php?page=order-create" class="ms-2 me-2 btn btn-success">Thêm</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-info" onclick="openUpdateStatusModal()">Cập nhập trạng thái</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToDetailPage()"> Xem chi tiết </a>
				</div>
			</div>
		</div>

		<h6 class="mb-0 text-uppercase">Đơn hàng - <?php echo $count_order ?> đơn</h6>
		<hr />
		<div class="card ">
			<div class="card-body container">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr class="text-center align-middle">
								<th scope="col">Chọn <br> <input type="checkbox" id="selectAllCheckbox"></th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Ngày đặt hàng</th>
								<th scope="col">Tên khách hàng</th>
								<th scope="col">Số điện thoại</th>
								<th scope="col">Tổng hóa đơn</th>
								<th scope="col">Trạng thái</th>

							</tr>
						</thead>
						<tbody>
							<?php
							if ($result_order)
								while ($row_order = mysqli_fetch_assoc($result_order)) {
							?>
								<tr class="align-middle 
								<?php
									if ($row_order['ORDER_STATUS'] == 4) {
										echo "table-danger text-decoration-line-through";
									} else if ($row_order['ORDER_STATUS'] == 3) {
										echo "table-success";
									}


									if ($row_order['ORDER_STATUS'] == 0) {
										$status = "Chờ tiếp nhận";
									} else if ($row_order['ORDER_STATUS'] == 1) {
										$status = "Đang xử lí";
									} else if ($row_order['ORDER_STATUS'] == 2) {
										$status = "Đang giao hàng";
									} else if ($row_order['ORDER_STATUS'] == 3) {
										$status = "Đã giao hàng";
									} else {
										$status = "Đã hủy";
									}
								?>
								">
									<td class="text-center"><input type="checkbox" name="selected_orders[]" value="<?php echo $row_order['ORDER_ID']; ?>"></td>
									<td class="text-center">#<?php echo str_pad($row_order['ORDER_ID'], 6, '0', STR_PAD_LEFT) ?></td>
									<td class="text-center"> <?php echo date_format(date_create($row_order['ORDER_DATE']), 'd/m/Y H:i:s'); ?> </td>
									<td class="text-center"><?php echo $row_order['USER_NAME'] ?></td>
									<td class="text-center"><?php echo $row_order['USER_PHONE'] ?></td>
									<td class="text-center"><?php echo number_format($row_order['ORDER_TOTAL'], 0, ',', '.') . ' ₫' ?></td>
									<td class="text-center"><?php echo $status ?></td>

								</tr>
							<?php
								}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center align-middle">
								<th>Chọn</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Ngày đặt hàng</th>
								<th scope="col">Tên khách hàng</th>
								<th scope="col">Số điện thoại</th>
								<th scope="col">Tổng hóa đơn</th>
								<th scope="col">Trạng thái</th>
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
		var selectedProducts = document.querySelectorAll('input[name="selected_orders[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedProducts.length === 0;
	}

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function() {
		var checkboxes = document.querySelectorAll('input[name="selected_orders[]"]');
		checkboxes.forEach(function(checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});

	function uncheckAllCheckboxes() {
		// Lấy tất cả các checkbox theo tên
		var checkboxes = document.querySelectorAll('input[name="selected_orders[]"]');

		// Lặp qua từng checkbox và đặt thuộc tính checked thành false
		checkboxes.forEach(function(checkbox) {
			checkbox.checked = false;
		});

		// Sau khi bỏ tick tất cả checkbox, cập nhật trạng thái của nút xóa
		updateDeleteButtonState();
	}

	function redirectToDetailPage() {
		var selectedOrders = document.querySelectorAll('input[name="selected_orders[]"]:checked');

		// Ensure that exactly one  is selected
		if (selectedOrders.length === 1) {
			var selectedOrderId = selectedOrders[0].value;
			window.location.href = './index.php?page=order-detail&order_id=' + selectedOrderId;
		} else {
			alert("Vui lòng chỉ chọn một đơn hàng.");
		}
	}

	// button chọn tất cả
	document.addEventListener("DOMContentLoaded", function() {
		var selectAllCheckbox = document.getElementById("selectAllCheckbox");
		var orderCheckboxes = document.querySelectorAll("#example tbody td:first-child input[type='checkbox']");

		selectAllCheckbox.addEventListener("change", function() {
			// Khi checkbox "Chọn Tất Cả" thay đổi trạng thái, cập nhật trạng thái của các checkbox sản phẩm
			orderCheckboxes.forEach(function(checkbox) {
				checkbox.checked = selectAllCheckbox.checked;
			});
		});

		// Sự kiện để kiểm tra trạng thái của các checkbox sản phẩm và cập nhật checkbox "Chọn Tất Cả"
		orderCheckboxes.forEach(function(checkbox) {
			checkbox.addEventListener("change", function() {
				selectAllCheckbox.checked = [...orderCheckboxes].every(function(checkbox) {
					return checkbox.checked;
				});
			});
		});
	});

	function openUpdateStatusModal() {
		var selectedOrders = document.querySelectorAll('input[name="selected_orders[]"]:checked');

		// Ensure that exactly one  is selected
		if (selectedOrders.length !== 1) {
			alert("Vui lòng chỉ chọn một đơn hàng.");
		} else {
			$("#updateStatusModal #order-id").val(selectedOrders[0].value);
			$("#updateStatusModal #current-status").val($("#example tbody tr input[type='checkbox']:checked").parent().siblings().last().text());
			// Hiển thị modal
			$("#updateStatusModal").modal("show");
		}
	}

	function updateStatus() {

		var order_id = document.querySelectorAll('input[name="selected_orders[]"]:checked')[0].value;
		var new_status = $("#status-select").val();

		// Thực hiện AJAX để cập nhật trạng thái
		$.ajax({
			type: "POST",
			url: "./backend/update_status.php",
			data: {
				order_id: order_id,
				new_status: new_status
			},
			success: function(response) {
				// Xử lý phản hồi từ server (nếu cần)
				console.log(response);

				// Đóng modal
				$("#updateStatusModal").modal("hide");
				window.location.reload();
				// uncheckAllCheckboxes();
			},
			error: function(error) {
				console.error("Error updating status: " + error);
			}
		});
	}
</script>

<!-- Thêm Bootstrap Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cập nhật trạng thái đơn hàng</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="order-id">
				<label for="status-select" class="form-label">Trạng thái hiện tại:</label>
				<input type="text" class="form-control" id="current-status" readonly>
				<label for="status-select" class="form-label mt-3">Chọn trạng thái mới:</label>
				<select class="form-select" id="status-select" required>
					<option value="0">Chờ tiếp nhận</option>
					<option value="1">Đang xử lí</option>
					<option value="2">Đang giao hàng</option>
					<option value="3">Đã giao hàng</option>
					<option value="4">Đã hủy</option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="updateStatus()">Cập nhật</button>
			</div>
		</div>
	</div>
</div>
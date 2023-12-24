<?php
	$sql_employee = mysqli_query($connect, "
        SELECT USERS.USER_PHONE, USER_NAME , USER_EMAIL, USER_ADDRESS, USER_STATE, COUNT(ORDERS.ORDER_ID) AS num_orders
        FROM USERS
        JOIN ROLES ON USERS.USER_ROLE = ROLES.ROLE_ID
        LEFT JOIN ORDERS ON USERS.USER_PHONE = ORDERS.USER_PHONE
        WHERE ROLE_NAME = 'Admin'
        GROUP BY USERS.USER_PHONE
        ORDER BY USERS.CREATE_DATE DESC, USERS.USER_STATE ASC;
    ");
    
	$count_employee = mysqli_num_rows($sql_employee);
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
						<li class="breadcrumb-item active" aria-current="page">Nhân viên </li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<!-- <a href="javascript:void(0);" class="ms-2 me-2 btn btn-info" onclick="redirectToOrderPage()">Xem hóa đơn</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-success" onclick="UserAction('unlock')">Mở khóa</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-warning" onclick="UserAction('lock')">Khóa</a> -->
					<!-- <a href="javascript:void(0);" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a> -->
				</div>
			</div>
		</div>	

		<h6 class="mb-0 text-uppercase">NHÂN VIÊN - <?php echo $count_employee ?> </h6>
		<hr />
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr class="text-center">
								<!-- <th>Chọn <br> <input type="checkbox" id="selectAllCheckbox"></th> -->
								<th>STT</th>
                                <th>Số điện thoại</th>
								<th>Công việc</th>
								<th>Email</th>
                                <th>Địa chỉ</th>
								<th>Trạng thái</th>
                                <!-- <th>Số hóa đơn</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
                            $index = 0;
							while ($row_employee = mysqli_fetch_array($sql_employee)) {
                                $index++;
							?>
								<tr class="align-middle">
									<!-- <td class="text-center"><input type="checkbox" name="selected_employees[]" value="<?php echo $row_employee['USER_PHONE']; ?>"></td> -->
									<td class="text-center"><?php echo $index ?></td>
									<td class="text-center"><?php echo $row_employee['USER_PHONE'] ?></td>
									<td class="text-center"><?php echo $row_employee['USER_NAME'] ?></td>
									<td class="text-center"><?php echo $row_employee['USER_EMAIL'] ?></td>
									<td><?php echo $row_employee['USER_ADDRESS'] ?></td>
									<td class="text-center"><?php echo $row_employee['USER_STATE'] ?></td>
									<!-- <td class="text-center"><?php echo $row_employee['num_orders'] ?></td> -->
								</tr>
							<?php
							}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center">
								<!-- <th>Chọn</th> -->
								<th>STT</th>
                                <th>Số điện thoại</th>
								<th>Công việc</th>
								<th>Email</th>
                                <th>Địa chỉ</th>
								<th>Trạng thái</th>
                                <!-- <th>Số hóa đơn</th> -->
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
		var selectedEmployees = document.querySelectorAll('input[name="selected_employees[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedEmployees.length === 0;
	}

	// function deleteSelected() {
	// 	var selectedEmployees = document.querySelectorAll('input[name="selected_employees[]"]:checked');
	// 	if (selectedEmployees.length === 0) {
	// 		alert("Vui lòng chọn ít nhất một người dùng để xóa.");
	// 		return;
	// 	}

	// 	var confirmDelete = confirm("Bạn có chắc muốn xóa các người dùng đã chọn?");
	// 	if (confirmDelete) {
	// 		var employeeIds = Array.from(selectedEmployees).map(function (checkbox) {
	// 			return checkbox.value;
	// 		});

	// 		var xhr = new XMLHttpRequest();
	// 		xhr.onreadystatechange = function () {
	// 			if (xhr.readyState === 4) {
	// 				if (xhr.status === 200) {
	// 					// Successful response from the server
	// 					alert(xhr.responseText); // Display success message or handle accordingly
	// 					// You may want to reload or update the table after successful deletion
	// 					location.reload();
	// 				} else {
	// 					// Error handling
	// 					alert('Lỗi xóa: ' + xhr.statusText);
	// 				}
	// 			}
	// 		};

	// 		// Construct the URL for the delete operation
	// 		var url = "./backend/employee_delete.php?employee_ids=" + employeeIds.join(",");

	// 		// Open and send the request
	// 		xhr.open("GET", url, true);
	// 		xhr.send();
	// 	}
	// }

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function () {
		var checkboxes = document.querySelectorAll('input[name="selected_employees[]"]');
		checkboxes.forEach(function (checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});
</script>

<script>
	// button chọn tất cả
    document.addEventListener("DOMContentLoaded", function () {
        var selectAllCheckbox = document.getElementById("selectAllCheckbox");
        var employeeCheckboxes = document.querySelectorAll("#example tbody td:first-child input[type='checkbox']");

        selectAllCheckbox.addEventListener("change", function () {
            // Khi checkbox "Chọn Tất Cả" thay đổi trạng thái, cập nhật trạng thái của các checkbox sản phẩm
            employeeCheckboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Sự kiện để kiểm tra trạng thái của các checkbox sản phẩm và cập nhật checkbox "Chọn Tất Cả"
        employeeCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                selectAllCheckbox.checked = [...employeeCheckboxes].every(function (checkbox) {
                    return checkbox.checked;
                });
            });
        });
    });
</script>

<script>
	function redirectToOrderPage() {
		var selectedEmployees = document.querySelectorAll('input[name="selected_employees[]"]:checked');

        // Ensure that exactly one employee is selected
        if (selectedEmployees.length === 1) {
            var selectedEmployeeId = selectedEmployees[0].value;
            window.location.href = './index.php?page=order&employee_id=' + selectedEmployeeId;
        } else {
            alert("Vui lòng chọn 1 khách hàng!.");
        }
	}


    function UserAction(action) {
        // Assuming you have an array of checkboxes with class 'userCheckbox'
        var selectedEmployees = document.querySelectorAll('input[name="selected_employees[]"]:checked');
        
        if (selectedEmployees.length === 0) {
            alert("Vui lòng chọn người dùng!");
            return;
        }
		if (selectedEmployees.length > 1) {
			alert("Vui lòng chỉ chọn một người dùng!");
			return;
		}
		console.log(selectedEmployees[0].value);
		console.log(action);

        $.ajax({
            type: "POST",
            url: "./backend/user_Lock_UnLock.php",
            data: {
                action: action,
                userPhone: selectedEmployees[0].value
            },
            success: function (response) {
                alert(response);
                location.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
</script>

</script>

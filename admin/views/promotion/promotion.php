<?php
if (isset($_GET['code_id'])) {
    $sql_promotion = mysqli_query($connect, "SELECT * FROM PROMOTION WHERE PROMOTION_CODE = '{$_GET['code_id']}' ORDER BY PROMOTION_ID");
} else $sql_promotion = mysqli_query($connect, "SELECT * FROM PROMOTION ORDER BY PROMOTION_CODE");

$count_promotion = mysqli_num_rows($sql_promotion);


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
                        <li class="breadcrumb-item active" aria-current="page">Khuyến mãi </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div>
                    <!-- <a href="javascript:void(0);" class="ms-2 me-2 btn btn-info" onclick="redirectToProductPage()">Xem sản phẩm</a> -->
                    <!-- <a href="./index.php?page=promotion-insert" class="ms-2 me-2 btn btn-success">Thêm</a> -->
                    <a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToUpdatePage()"> Sửa </a>
                    <a href="javascript:void(0);" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a>
                </div>
            </div>
        </div>

        <h6 class="mb-0 text-uppercase">Khuyến mãi - <?php echo $count_promotion ?> </h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>Chọn <br> <input type="checkbox" id="selectAllCheckbox"></th>
                                <th>Mã khuyến mãi</th>
                                <th>CODE</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Sản phẩm </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_promotion = mysqli_fetch_array($sql_promotion)) {
                            ?>
                                <tr class="align-middle 
                                <?php
                                $start_date = strtotime($row_promotion['PROMOTION_STARTDATE']);
                                $end_date = strtotime($row_promotion['PROMOTION_ENDDATE']);

                                if ($start_date > time() || $end_date < time()) {
                                    echo "table-danger text-decoration-line-through";
                                } else {
                                    echo "table-success";
                                }
                                ?>
                                
                                ">
                                    <td class="text-center"><input type="checkbox" name="selected_promotions[]" value="<?php echo $row_promotion['PROMOTION_ID']; ?>"></td>
                                    <td class="text-center"><?php echo $row_promotion['PROMOTION_ID'] ?></td>
                                    <td class="text-center"><?php echo $row_promotion['PROMOTION_CODE'] ?></td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($row_promotion['PROMOTION_STARTDATE'])) ?></td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($row_promotion['PROMOTION_ENDDATE'])) ?></td>
                                    <td class="text-center"><?php echo $row_promotion['PRODUCT_ID'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr class="text-center">
                                <th>Chọn</th>
                                <th>Mã khuyến mãi</th>
                                <th>CODE</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Sản phẩm </th>
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
        var selectedPromotions = document.querySelectorAll('input[name="selected_promotions[]"]:checked');
        var btnDeleteSelected = document.getElementById('btnDeleteSelected');
        btnDeleteSelected.disabled = selectedPromotions.length === 0;
    }

    function deleteSelected() {
        var selectedPromotions = document.querySelectorAll('input[name="selected_promotions[]"]:checked');
        if (selectedPromotions.length === 0) {
            alert("Vui lòng chọn ít nhất một khuyến mãi để hủy.");
            return;
        }

        var confirmDelete = confirm("Bạn có chắc muốn hủy các khuyến mãi đã chọn?");
        if (confirmDelete) {
            var promotionIds = Array.from(selectedPromotions).map(function(checkbox) {
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
            var url = "./backend/promotion_delete.php?promotion_ids=" + promotionIds.join(",");

            // Open and send the request
            xhr.open("GET", url, true);
            xhr.send();
        }
    }

    // Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_promotions[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });
    });
</script>

<script>
    function redirectToUpdatePage() {
        var selectedPromotions = document.querySelectorAll('input[name="selected_promotions[]"]:checked');

        // Ensure that exactly one promotion is selected
        if (selectedPromotions.length === 1) {
            var selectedpromotionId = selectedPromotions[0].value;
            window.location.href = './index.php?page=promotion-update&promotion_id=' + selectedpromotionId;
        } else {
            alert("Vui lòng chỉ chọn một khuyến mãi");
        }
    }
</script>

<script>
    // button chọn tất cả
    document.addEventListener("DOMContentLoaded", function() {
        var selectAllCheckbox = document.getElementById("selectAllCheckbox");
        var productCheckboxes = document.querySelectorAll("#example tbody td:first-child input[type='checkbox']");

        selectAllCheckbox.addEventListener("change", function() {
            // Khi checkbox "Chọn Tất Cả" thay đổi trạng thái, cập nhật trạng thái của các checkbox sản phẩm
            productCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Sự kiện để kiểm tra trạng thái của các checkbox sản phẩm và cập nhật checkbox "Chọn Tất Cả"
        productCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                selectAllCheckbox.checked = [...productCheckboxes].every(function(checkbox) {
                    return checkbox.checked;
                });
            });
        });
    });
</script>

<script>
    function redirectToProductPage() {
        var selectedPromotions = document.querySelectorAll('input[name="selected_promotions[]"]:checked');

        // Ensure that exactly one promotion is selected
        if (selectedPromotions.length === 1) {
            var selectedPromotionId = selectedPromotions[0].value;
            window.location.href = './index.php?page=product&promotion_id=' + selectedPromotionId;
        } else {
            alert("Vui lòng chọn 1 danh mục!.");
        }
    }
</script>
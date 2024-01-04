<?php
$sql_promotion = mysqli_query($connect, "SELECT *FROM PROMOTION ORDER BY PROMOTION_ID");
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
                        <li class="breadcrumb-item active" aria-current="page">Cập nhập khuyến mãi </li>
                    </ol>
                </nav>
            </div>
        </div>

        <h6 class="mb-0 text-uppercase">Khuyến mãi - <?php echo $count_promotion ?> </h6>
        <hr />
        <!-- insert form -->
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="promotion-id" class="form-label">Mã khuyến mãi</label>
                                <input type="text" class="form-control" id="promotion-id" name="promotion-id" placeholder="ID" value="<?php if (isset($_GET['promotion_id'])) {
                                                                                                                                            echo $_GET['promotion_id'];
                                                                                                                                        } ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="list-product" class="form-label">Sản phẩm</label>
                                <input type="text" class="form-control" id="list-product" name="list-product" required readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="code" class="form-label">Mã khuyến mãi </label>
                                <input type="text" class="form-control" id="code" name="code" required readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start-date" class="form-label">Thời gian bắt đầu</label>
                                <input type="datetime-local" class="form-control" id="start-date" name="start-date" min="0" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end-date" class="form-label">Thời gian kết thúc</label>
                                <input type="datetime-local" class="form-control" id="end-date" name="end-date" min="0" step="1" required>
                            </div>
                        </div>
                    </div>



                    <button type="submit" name="update" class="btn btn-primary">Sửa</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $(document).ready(function() {
        var promotionId = $("#promotion-id").val();
        // console.log(promotionId);

        // Kiểm tra nếu ô input có giá trị từ ban đầu
        if (promotionId) {
            // Gọi hàm để xử lý sự kiện change
            handleCodeChange();
        }

        $("#promotion-id").on("input", handleCodeChange);

        function handleCodeChange() {
            promotionId = $("#promotion-id").val();
            // Kiểm tra nếu promotion_id không rỗng
            $.ajax({
                type: "POST",
                url: "./backend/promotion_fetch_data.php",
                data: {
                    promotion_id: promotionId
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    // Gán dữ liệu vào các ô input
                    $("#list-product").val(data.product_id);
                    $("#code").val(data.promotion_code);

                    var formattedStartDate = data.promotion_startdate.replace(" ", "T");
                    var formattedEndDate = data.promotion_enddate.replace(" ", "T");

                    // Set the value of the datetime-local input
                    document.getElementById("start-date").value = formattedStartDate;
                    document.getElementById("end-date").value = formattedEndDate;

                }
            });
        }
    });
</script>


<?php
if (isset($_POST['update'])) {
    $promotion_id = $_POST['promotion-id'];
    $product_id = $_POST['list-product'];
    $promotion_code = $_POST['code'];
    $promotion_startdate = $_POST['start-date'];
    $promotion_enddate = $_POST['end-date'];

    $sql = "UPDATE PROMOTION SET PRODUCT_ID = '$product_id', PROMOTION_CODE = '$promotion_code', PROMOTION_STARTDATE = '$promotion_startdate', PROMOTION_ENDDATE = '$promotion_enddate' WHERE PROMOTION_ID = '$promotion_id'";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "<script>alert('Cập nhật khuyến mãi thành công!')</script>";
        echo "<script>window.location.href = './index.php?page=promotion'</script>";
    } else {
        echo "<script>alert('Cập nhật khuyến mãi thất bại!')</script>";
        echo "<script>window.location.href = './index.php?page=promotion'</script>";
    }
}



?>
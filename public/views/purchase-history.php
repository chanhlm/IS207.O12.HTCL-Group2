<link rel="stylesheet" href="./public/assets/css/purchase-history.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<?php
$user_phone = $_SESSION['phone'];
$sql_order = "SELECT * FROM `orders` WHERE `user_phone` ='" . $user_phone . "' ORDER BY `orders`.`order_id` DESC";
$result_order = mysqli_query($connect, $sql_order);

?>

<section class="">
  <div class="container row">
    <div class="sidebar col-md-3">
      <nav>
        <button>
          <span style="background-color:#c6c6c6;">
            <a href="#">
              <i class="fa-solid fa-bag-shopping"></i>
              <span>Lịch sử mua hàng</span>
            </a>
          </span>
        </button>

        <button>
          <span>
            <a href="./index.php?page=info">
              <i class="fa-solid fa-clipboard-list"></i>
              <span>Thông tin khách hàng</span>
            </a>
          </span>
        </button>
      </nav>
    </div>

    <div class="content col-md-9 ms-2">
      <?php
      if ($result_order->num_rows > 0) {
        // Lặp qua dữ liệu và hiển thị nó trong HTML
        while ($order_row = $result_order->fetch_assoc()) {
          echo "<script>console.log('" .  $order_row['ORDER_ID'] . "');</script>";
          $sql = "SELECT * FROM `order_details`, `products` WHERE `order_details`.`order_id` = " . $order_row['ORDER_ID'] . " and `order_details`.`product_id` = `products`.`product_id` ";
          $result = mysqli_query($connect, $sql);

          // Thay 'order_total' bằng tên cột tương ứng trong bảng orders

          $date = $order_row['ORDER_DATE'];
          $orderId = str_pad($order_row['ORDER_ID'], 6, '0', STR_PAD_LEFT);

          if ($order_row['ORDER_STATUS'] == 0) {
            $status = "Chờ tiếp nhận";
          } else if ($order_row['ORDER_STATUS'] == 1) {
            $status = "Đang xử lí";
          } else if ($order_row['ORDER_STATUS'] == 2) {
            $status = "Đang giao hàng";
          } else if ($order_row['ORDER_STATUS'] == 3) {
            $status = "Đã giao hàng";
          } else {
            $status = "Đã hủy";
          }
          // echo $productName . " - " . $status . " - " . $cost . "<br>";

          // Hiển thị dữ liệu trong phần tử HTML
          echo '<div class="item">';
          echo '
              <div class="row justify-content-between pe-4 ps-4"> 
                <div class="item-info-status">#' . $orderId . '</div>

                <div class="item-info-status shipped">' . $status . '</div>
              </div>
              <hr>
              ';

          while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['PRODUCT_NAME'];
            $image = $row['PRODUCT_IMAGE'];
            $cost = $row['ORDER_DETAIL_PRICE'];
            $quantity = $row['ORDER_DETAIL_QUANTITY'];
            echo '
                  
                  <div class="product row">
                    <img class="item-image col-md-3 border border-black" src="' . $image . '">
                    <div class="btn-item-info-detail col-md-9">' . $productName . '</div>
                  </div>
                  <br>
                  <hr>
                ';
          }

          echo ' 

                <div class=" ">
                  <div class="cost w-100 pt-2"> TỔNG TIỀN: ' . number_format($order_row['ORDER_TOTAL']) . 'đ</div>
                  <div class="w-100 align-right"><a href="./index.php?page=order_detail&id=' . $order_row['ORDER_ID'] .'" class="btn btn-outline-success" style = "font-size: 15px;">Xem chi tiết</a></div>
                </div>
              </div>
              ';
        }
      } else {
        echo "Không có dữ liệu";
      }
      ?>



    </div>
  </div>
</section>
<link rel="stylesheet" href="./public/assets/css/purchase-history.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<?php
$user_phone = $_SESSION['phone'];
$sql = "SELECT * FROM USERS WHERE `user_phone` ='" . $user_phone . "'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

?>

<section class="">
  <div class="container row">
    <div class="sidebar col-md-3">
      <nav>
        <button>
          <span ">
            <a href=" ./index.php?page=purchase-history">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Lịch sử mua hàng</span>
            </a>
          </span>
        </button>

        <button>
          <span style="background-color:#c6c6c6;">
            <a href="./index.php?page=info">
              <i class="fa-solid fa-clipboard-list"></i>
              <span>Thông tin khách hàng</span>
            </a>
          </span>
        </button>
      </nav>
    </div>

    <div class="content col-md-9 ms-2 p-4">
      <form  method="post">
        <div class="mb-3">
          <label for="full-name" class="form-label">Họ và tên:</label>
          <input type="text" class="form-control" id="full-name" name="full-name" value="<?php echo $row['USER_NAME']  ?>" required>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Địa chỉ:</label>
          <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $row['USER_ADDRESS']; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="phone-number" class="form-label">Số điện thoại:</label>
          <input type="tel" class="form-control" id="phone-number" name="phone-number"  value=" <?php echo $row['USER_PHONE']  ?>" required readonly>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value=" <?php echo $row['USER_EMAIL']  ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Sửa</button>
      </form>
    </div>

  </div>
</section>

<?php
  if (isset($_POST['update'])) {
    $full_name = $_POST['full-name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $sql = "UPDATE USERS SET `USER_NAME` = '$full_name', `USER_ADDRESS` = '$address',  `USER_EMAIL` = '$email' WHERE `USER_PHONE` = '$user_phone'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
      echo "<script>alert('Cập nhật thông tin thành công!')</script>";
      echo "<script>window.location.href = './index.php?page=info'</script>";
    } else {
      echo "<script>alert('Cập nhật thông tin thất bại!')</script>";
      echo "<script>window.location.href = './index.php?page=info'</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <link rel="stylesheet" href="../../shared/base.css" />
  <link rel="stylesheet" href="../../shared/fonts/themify-icons/themify-icons.css" />
  <link rel="stylesheet" href="../assets/css/cart.css" />
  <link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon" />

  <?php
        $pageTitle = "Giỏ hàng";
    ?>
  <title>
    <?php echo $pageTitle ?>
  </title>
</head>

<body>
  <?php include "./header.php"?>

  <!-- cart has product -->
  <!-- <section>
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Giỏ hàng</h1>
                      <h6 class="mb-0 text-muted">3 sản phẩm</h6>
                    </div>
                    <hr class="my-4" />

                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                          src="data:image/jpeg;base64,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"
                          class="img-fluid rounded-3" alt="Cotton T-shirt" />
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-4">
                        <h6 class="text-muted">Đồng hồ</h6>
                        <h6 class="text-black mb-0">
                          Đồng hồ thông minh Apple Watch SE 2022 GPS 40mm
                        </h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex p-1">
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fas fa-minus"></i>
                        </button>

                        <input id="quantity-form" min="0" name="quantity" value="1" type="number"
                          class="form-control form-control-sm align-center" />

                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2">
                        <h6 class="mb-0">đ 6.290.000</h6>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                      </div>
                    </div>

                    <hr class="my-4" />

                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                          src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxASEBAPDxAQEBAPDw8PDw8QDxAQEBANFREWFxUSFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFxAQGysiHR0rLS0tKystLSstLS0tLS0tLS0tLS0tLS0tLS0tKy0rLS0tLS0rKy0rLSsrLS0rLS0tLf/AABEIAOEA4QMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAAAAgEDBAUGB//EAEYQAAIBAgIGBwQIAwMNAAAAAAABAgMRBDESIUFRYXEFE1KBkaGxIjLB0QYUYnKSouHwI0KCB7LxFiQzNFNUc5SzwsPS4v/EABkBAQEBAQEBAAAAAAAAAAAAAAABAgMEBf/EACMRAQEAAgEEAgIDAAAAAAAAAAABAhEDEiExURNBBDIiYXH/2gAMAwEAAhEDEQA/APuIAAAAC1JpJyeSTb5IBjDiukox1R9uXB+yub+Rhx2OlLV7sGr22tcX8DB1l9UVd8jO/TtOOTvk6dLpOaftJSW5amuRtj0lScdLTS4fzX5HHp4GcvfdluWZfCFKPurSe/Pzy8Czt5Zykyv8I2PpO/8Ao6c5cX7K8SPrNZ7IQ8ZMx1cZbal5swVek03oxUpy3JN+RLyYx0x/Gyvl2HWntrd0VBfMSVb7c3/VJfI5UfrcvcoSS3ztH+80WR6Lxss5U4cHL5Jk679Rr4uOecnQ6+P2nzd/ViutHs+hlh0BXzlXit9lKXyLP8nJbcRLug//AGG8zXD7XdfHsryJVePZ8LFC+jT/AN4qdy/Ub/J17MRPvin8RvM1we1/Xx+2uUmvRjLErZOa53+KMkug6692vF8JQcfiymeBxkf5YT+7L52HXl6Pj4r4ydaGIlsnGXcn6Fqxctsb8U/gecni5RdqtOUXs0o28Lmmhj90nyeteYnJPsv411vG7d6OKi965ouTTyd+RyKeJTz8VkXwazi/Bm5q+HnywuPl0QMsK7Wev1NEJp5BkwAAAAAAAAAAAAAZsfiIwg75yTSW16h8ViFCOk+5bWzlQpucusqa75LZb5FGWjhpTtd2isv0NqjCmtS1v8THq1NFcckv3sM2tu71t/vwM2ydo7cfHc7uipUbzy7Ky795RVky9xNHR+H0p6Tyhr/q2fvkcu9r17x48dqsJ0KpWlWvv6tO34n8Dr0aEILRhGMVuikiwDrMZHhz5Ms73AABWAAAAAAAAAAETimrNJp5pq6ZycZ0FTlrpfw5bv5H3bO464Esl8tY55Y3cryCU4NxldSi7NM1UMR3M6XTeF0o9Yvehnxh+mficVHnsuNfRwynLjuuxRr357jRGW7UzkU2zbRq35nfDPfavJy8PT3nh06dTY8/UsMVOexmmnLY/wDE286wAAgAAAAWpNRTk8kMcvpGtpS0FlHPjL9AKpSdSWlLJZLctxe5JZtLm7HNxE6lv4avszSM7jPbCa70/Ri3TWMl81tnVTd78uCGpTRzHF7p+En6Ea/tr+ma+By7vXM8dadWU0aMLjIxja13dt61+8rHCbfal33BJ9rzEuqmfTlNPRPpJdn836HK6Y+lPUOCWHdTT2qolby4MyqL/wBp+YWthYztpuMra1d3szVy7dnPHjkvdQvpviW9WBp22N4up5pUDVS+lGJlf/NqUXs/i1GvFwRnWApLJR7mWLDx3+Znda+PFdL6QYrJQw+l2fblZb209RE+msYlfSwsV/wasv8AyISnhYLKy5PaOsPG6d7tZXd7cr5F6qfFito9KY9pXhh3dXvacH4acjZQx+I/n6pLdFSb9TKl9rzQyj9vzRrbN4/8dH69Lh4E/XpcPAwKC7f5h4012/MvUnxNqx0vs+D+YLGy3R8GviZlQj234jLDx7T8RtOie1tfpG0XpRi001bSevhkcBTe7zO08JB56+65P1SGyP5f0MZY3J24s8cJf7YIy9lX1DxnbXc3Kgux+UeNH7PkkSYVq8sVwqLO5rpSvzEVJ9n0Ejh5p31Jbr6ztHkyk+m+LJKqcsn3MtIwAAAK8RU0YuW5auew4knqb2v9s6XSkvYS3y+BzKiyXIsSmpR1IdksGURYUdigQi9RK4LWjQkCF0FuQaC3LwLECCs0lrISJYIqGSGSIQyAZIlIhDIBkhkKhgL4ZDIWlkOjKpCwAQJICZClDIlkIYUUU9qL4vUUy1SLY7fEUMAAQYOlso836HOi25a1t33Oj0pnD+r4GClmzUSnc1x8GR1kd68UOQEBBEqcezHwQvVR3JclYC2lmaEZaVNX25bJSXxL1RW+X45/MLFpMSrquMvxNkxpvtS8vkFUMEK4vtP8vyJUX2n+X5FZOh0VpcX5fIdLi/L5AWIlCJcX5fIZLi/IKdDCJcX5DaPF+IRfRyLEUUY8/FosVNfa/FL5mWlgC9WuP4pEdVHcu9XIGkV6a3rxRLpR7MfBAkWAU1sd+WsdS5ioZCijEuX8qi/vScfRMei5atKybWSba1W2tLeTVWoKPwH0LQACDn9JvXDlL4GKmjX0m/aj91mWJqJToESCAVgABFlBZ8i9Iqw+3uLUw0ZIaCz5ComLIMIwoxplKHQikhlJAWIlCKQyYDoZCJjoCylmWlNPMtRGjgQSZESEHkIWBkShUMhQtTIiiPIrpZ+I+hcAAQcvpT319z4szQN3StCTSlFX0U7q9tWdzBSNTwi8gkAEAACLqG3uLSqhkyutiNkfH5BV86iWbsUSxi/lV+L1GZRb48dl+ZNSnaLd/wB/vkS5SNzDKhzfcQprfflr9Cj972MYvI7T8f3V6qrc34fFjKtw8WUIZE+St/BivVbh5/oNGvw8GZ0Oh10+HBoVZbmvD4Fkasd9uer1MqGiXrqXgxboMtjUOdFd3LU/I0Qk99+erzRqZSuOXFY2pkozwqbMnu38t5fCRXNMhB2IIJGQoyAGVw94sZVD3+SuBeAAQV4n3J/cl6HEpnaxPuT+5L0OJAsStMSRYksqlZAxAZRKTtZbSqEdLX/L/e/T15ZtW2R7V+6Kzfov6kWIxlfp34sN96kqxHu+BaynEPV3nN6Yyo8b030ziqeOdKFSTg5UIUcPRp03NucPalOFSnepHSd+sp1LQSs4tp39oSmSXS5Y7fN8R9JMdWpYOGFxEoVnhcPHHVPq0JdRjamJw1J9ZGULRlaVZ6CtqTdtSZ0+jen8fVxMaXV6MoylSq0asHTorEQw0nL+KoOXVupHSjJXupJcD26b3k3Ltjovt85o9OdIPDyqVa1eliYYehPCYeGDhKGNrvS01P8AhN++lC0XDRXtPO50KvTeO6uFKLqxxccZ0iq6+qSqqGEpwxDoyajC0o/6vbR1z1JXuz3CZJdnx32+ZS6Y6TapRjUxduutWrxipU5ReGcloTjgXKNppXTouzklfO3v+hKFRR62dapU66nRloVNJaD6tXzjHN6/chxinqXRRKFq44a805fEoLoZCGR7XRZRqO+i89j3r5/vkiImt2a1xe6RuVxyx22MUITvFNbUny4AacAOhBkBLEh7z5L1HYkfe7viBaAAQV4n3J/dl6HDgd2qvZlyfocKmaiVfFj3EQyQEEIkhlRVnOT3RjFcG7t+Wj4FhVD3p/fX/Tgi25wy8vbh+sDKq+Q7ZXXyI3HPxvSFGik61WFPS1R0nZvki+hWjOKnCUZxlrjKLUotcGj5z/aLg6/1lVdFzpOmowtkmlr773PQ/wBntCpHCvT92Urwjud3peWj4EJl309UiSESGzolCoZAMjL0j0rQw6Uq9WNNPK923vslrNSPmP8Aaz0RialajWpxdSnoOGil7stWa27Xwu95qMZ5XGbkfTMHiqdWCqUpqcJZSi7o2U8jw/8AZb0ZXoYSSrpx056UIPYtd+7LzPb0xE8zusJuKSaYXYR6pLdN+aUv+4tKMJnNfdfk18C9G48+XkDEElZAsfe7n6oYWnm+RBaAAQDOFSWqx3TjSVpyW6T8LliVKiTZkokpopA4MGmSGcvvP0RYVTdpS5p/lQdYcb5e3H9YsZXVyIdV7hZVOBnbciqUU1ZpNbmk14DJfpyJiirETay1cQq64rrR3r1OY6t+PF6yVcm106X1mG/yY8cRHtI5WiwY2aduMhkcOE3sbT4Ox0sNXeUtfEuzTYrlsCqI6NRmriStMa5rbnpfhc5co+si4qwu18UvL9S5G54ebP8AagkAKyhkUc5Pkv34hJk0Fqvvb+XwJRYAAQBysfG1S/aSffl8EdUxdKUrxUlnB/lefw8BBkix0UwkWJmkMDIuAVlxC9pPereD/XyKjVXhdcc1zMlzjnO71cWW5r0kCLkXMuq6gs+Rz+m6qhG792MZ1JW7MVf5nSwub5HJ+k9K8JrtUa0fGD+YXb5vhPpP0viJOWDwkZUm2oy6qbgknl1jklLmkd/CvpyS9qGEp84VZPwRV9Gum6+GpQw9NUpU4ao6UXpKN72un8D09L6QVnnCHc2b6Xmudcf6r008qmE/5Su/iZcRhvpAtcY4WfKnOD/Mj0z6brbIx8f0MWM6fxdtU4x5Qi34v5Dph15PM9E/SDFrFxweOpqE57NFJq6bjJOLaadmv8D6FhdcE+7zPBUqLqYunXqSc6ml78rXsk9Stksz3vR6/hrv9Tnl2rvx3cbqT1FiKqWRYai06JTFLKUbvhtNTuxbqbaaCtFcdZYmIMjo8luz3IuRchsqIqP98S6KsktysU01d8vUvJQAAEAQ1fU8nqfIkAOHVpuEnF5Zxe+OwaMjpY3Dacd0lri+O58DkRbTaeprU1xKjRcLiJk3KbMzLXpbV3rfx5mi5BLNrjlZdxhA01KSevzWZnlBrj5HK4WPXjzY3yehOzGx1HSVtzunxM9y2NZ5PWZdY4Ufo3R0r2nHXlGS0VyumbqXRFJZOfjH5HR0ovgTo7mh3OnH0xPo2nvn4r5Gev0RSeen+JfI6jiK6fFE7nTj6cWj0VThK8U75Xbu0ttjsUFqSySVh1SjzHixpVsR0ytFtOmbmNrnlyYw0It5GumrIrghzrMdPNnyXJYAqYyRXMXIbBssow2vuQDwjZW8eYwAZAAAAAAABlxuDU9a1TWT2PgzUAHCpKSbjJNNW1fEsZo6Qj7ae+NvB/8A0UMqEuFxZor6zeVFtxWriaZOkFQ6SEdEs0guNSrMrPCh0mHVs0XC5OiNzlz9qNBjqk/2i1MdMdEPmz9qo0i2FIlMbSLMZEudvmmjEtRUpBplZXpkplHWIIybA1RLUU0y25AUqe19y+LLyIrUuRJkAAAAAAAAAAAAAGbH07xvti792398Dn3OycrGYdx1r3f7vDkWJVEiipEZzJo0nUejHf7UtkUaQYXoyVSLn1jhraitHSTSzea2+g0uiq6ydOS5yi/T4nchBJJLUkkkuAxna6eeeErrOm3ylB/Ejq6m2nP8LfoeiAbNPO2lthP8EvkTr7Mvws9CA2aefSfZl+FjqEuzP8Evkd0Bs04qpz7Evwteoyw9XsPvcV8TsANq5KwNV9iPe2/Qth0X26knwilFfE6IDaacetR0JuOzU43d9X+Nx4G/E0FNbmsmYpUpLNPmtaLKq2DLo62l+7bSinF7n4GynC3MUOAAZAAAAAAAAAAAAAAAwADzuJ998zuYT3I8iQLRaAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAB//2Q=="
                          class="img-fluid rounded-3" alt="Cotton T-shirt" />
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-4">
                        <h6 class="text-muted">Nồi cơm điện</h6>
                        <h6 class="text-black mb-0">
                          Nồi cơm nắp gài Sunhouse 1.8 lít SHD8607W
                        </h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex p-1">
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fas fa-minus"></i>
                        </button>

                        <input id="quantity-form" min="0" name="quantity" value="1" type="number"
                          class="form-control form-control-sm align-center" />

                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2">
                        <h6 class="mb-0">đ 680.000</h6>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                      </div>
                    </div>

                    <hr class="my-4" />

                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ78Xtg2-C0is4LXgjGxXAViVASJsaPVXji2cOAvm-I2nOO6Q_2ogwkIcDiiFCUGYKKB94&usqp=CAU"
                          class="img-fluid rounded-3" alt="Cotton T-shirt" />
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-4">
                        <h6 class="text-muted">Máy lọc nước</h6>
                        <h6 class="text-black mb-0">
                          Máy lọc nước RO nóng nguội lạnh Karofi KAD-X39 10 lõi
                        </h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex p-1">
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fas fa-minus"></i>
                        </button>

                        <input id="quantity-form" min="0" name="quantity" value="1" type="number"
                          class="form-control form-control-sm align-center" />

                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2">
                        <h6 class="mb-0">đ 7.390.000</h6>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                      </div>
                    </div>

                    <hr class="my-4" />

                    <div class="pt-5">
                      <h6 class="mb-0">
                        <a href="./index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Quay
                          lại trang chủ</a>
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Tổng tiền</h3>
                    <hr class="my-4" />

                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">Sản phẩm 3</h5>
                      <h5>đ 14.360.000</h5>
                    </div>

                    <h5 class="text-uppercase mb-4">NHẬN HÀNG</h5>

                    <div class="mb-4 pb-2">
                      <select class="select form-control">
                        <option value="1"> Tại cửa hàng </option>
                        <option value="2"> Tại nhà</option>
                      </select>
                    </div>

                    <h5 class="text-uppercase mb-3">Mã giảm giá</h5>

                    <div class="mb-5">
                      <div class="form-outline">
                        <input type="text" id="form3Examplea2" class="form-control" placeholder="Nhập mã giảm giá" />
                      </div>
                    </div>

                    <hr class="my-4" />

                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Tổng tiền</h5>
                      <h5>đ 14.410.000</h5>
                    </div>

                    <button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Đặt hàng</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  
  <!-- null cart -->
  <?php include "./empty-cart.php" ?>

  <?php include "./footer.php"?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
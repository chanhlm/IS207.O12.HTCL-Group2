<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link rel="stylesheet" href="./public/assets/css/cart.css" />

<!-- cart has product -->
<section>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-3">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Giỏ hàng</h1>
                    <h6 class="mb-0 text-muted"><span class="countProduct">0</span> sản phẩm</h6>
                  </div>
                  <hr class="my-4" />

                  <div id="cart">
                  </div>

                  <div class="pt-5">
                    <h6 class="mb-0">
                      <a href="./index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Quay lại trang chủ</a>
                    </h6>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Tổng tiền</h3>
                  <hr class="my-4" />

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Sản phẩm: <span class="countProduct">0</span></h5>
                    <h6><span class="totalPrice">0</span> VNĐ</h6>
                  </div>

                  <!-- <h5 class="text-uppercase mb-4">NHẬN HÀNG</h5>

                  <div class="mb-4 pb-2">
                    <select class="select form-control">
                      <option value="1"> Tại cửa hàng </option>
                      <option value="2"> Tại nhà</option>
                    </select>
                  </div> -->

                  <h5 class="text-uppercase mb-3">Mã giảm giá</h5>

                  <div class="mb-5">
                    <div class="form-outline">
                      <input type="text" id="discountCode" class="form-control" placeholder="Nhập mã giảm giá" />
                    </div>
                  </div>

                  <hr class="my-4" />

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Tổng tiền</h5>
                    <h5><span class="finalTotal">0</span> VNĐ</h5>
                  </div>

                  <button type="button" class="btn btn-dark btn-block btn-lg" id="btnPlaceOrder" data-mdb-ripple-color="dark">Đặt hàng</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
  function formatNumber(num) {
    return num.toLocaleString('vi-VN');
  }

  let productHtml;
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  if (cart.length == 0) {
    productHtml = `
        <div class = "pt-0">
          <div class="container mt-100">
            <div class="row">
              <div class="col-md-12">
                <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center">
                    <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3" />
                    <h3><strong>Giỏ hàng của bạn trống</strong></h3>
                    <a href="./index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Quay về trang chủ</a>
                    <h6>
                      Khi cần trợ giúp vui lòng gọi 1800.1000 hoặc 028.3000.0000 (7h30 - 22h)
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>`;
  } else {
    productHtml = ``;
  }
  // Duyệt qua mỗi sản phẩm trong giỏ hàng
  $.each(cart, function(index, product) {
    // console.log(formatNumber(parseInt(product.productPrice)));

    // Tạo ra thẻ HTML cho mỗi sản phẩm
    productHtml += `
    <div class="row mb-4 d-flex justify-content-between align-items-center product-item-${index}" >
      <div class="col-md-2 col-lg-2 col-xl-2 ">
        <img src="${product.productImage}" class="img-fluid rounded-3" alt="${product.productName}" />
      </div>
      <div class="col-md-3 col-lg-3 col-xl-4">
        <a href = "./index.php?page=product&product=${product.productId}"><h6 class="text-black mb-0">${product.productName}</h6></a>
      </div>
      <div class="col-md-3 col-lg-3 col-xl-2 d-flex p-1">
        <button class="btn btn-link px-2" onclick="updateQuantity('${product.productId}', -1)">
          <i class="fas fa-minus"></i>
        </button>

        <input id="quantity-form-${product.productId}" min="0" name="quantity" value="${product.productQuantity}" type="number" class="form-control form-control-sm text-center" />


        <button class="btn btn-link px-2" onclick="updateQuantity('${product.productId}', 1)">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="col-md-3 col-lg-2 col-xl-2 p-0">`;
    if (product.productDiscountedPrice == product.productPrice) {
      productHtml += `
        <h6 class="text-black fs-6">${formatNumber(parseInt(product.productPrice))} VNĐ</h6>  
        `;
    } else {
      productHtml += `
        <h6 class="text-decoration-line-through text-danger">${formatNumber(parseInt(product.productPrice)) } VNĐ</h6>
        <h6 class="text-black fs-6">${formatNumber(parseInt(product.productDiscountedPrice))} VNĐ</h6>  
        `;
    }

    productHtml += `</div>
      <div class="col-md-1 col-lg-1 col-xl-1 text-center">
        <a href="#!" class="text-muted" onclick="removeProduct(${index})"><i class="fas fa-times"></i></a>
      </div>
      <hr class="my-4" />
    </div>
   `;
    // Thêm thẻ HTML vào giỏ hàng
  });
  $('#cart').html(productHtml);
  calculateTotalOrder(cart);

  function updateQuantity(productId, change) {
    // Lấy danh sách sản phẩm từ localStorage (nếu có)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    // console.log(cart);

    // Tìm sản phẩm trong giỏ hàng dựa trên productId
    const productIndex = cart.findIndex(item => item.productId.toString() === productId.toString());

    // Nếu sản phẩm được tìm thấy, cập nhật số lượng
    if (productIndex !== -1) {
      // Chuyển đổi thành số và cập nhật giá trị
      cart[productIndex].productQuantity = parseInt(cart[productIndex].productQuantity) + change;

      // Đảm bảo số lượng không nhỏ hơn 1
      cart[productIndex].productQuantity = Math.max(cart[productIndex].productQuantity, 1);

      // Cập nhật số lượng sản phẩm trên giao diện người dùng
      const quantityForm = document.getElementById(`quantity-form-${productId}`);
      if (quantityForm) {
        quantityForm.value = cart[productIndex].productQuantity;
      } else {
        console.error(`Cannot find quantity form for product ${productId}`);
      }
    } else {
      console.error(`Cannot find product ${productId} in cart`);
    }

    // Lưu danh sách sản phẩm mới vào localStorage
    try {
      localStorage.setItem('cart', JSON.stringify(cart));
    } catch (e) {
      console.error(`Failed to save cart to local storage: ${e}`);
    }
    calculateTotalOrder(cart);

  }

  function removeProduct(index) {
    // Lấy danh sách sản phẩm từ localStorage (nếu có)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Xóa sản phẩm khỏi giỏ hàng
    // console.log(index);
    if (cart.length == 1) {
      cart = [];
    }
    cart.splice(index, 1);

    // Lưu danh sách sản phẩm mới vào localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    calculateTotalOrder(cart);


    // Xóa sản phẩm khỏi giao diện người dùng
    $(`#cart .product-item-${index}`).empty().remove();

    // Cập nhật số lượng sản phẩm trên giao diện người dùng
    $('.countProduct').html(cart.length);

    if (cart.length == 0) {
      $('#cart').html(`
        <section class="pt-0">
          <div class="container mt-100">
            <div class="row">
              <div class="col-md-12">
                <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center">
                    <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3" />
                    <h3><strong>Giỏ hàng của bạn trống</strong></h3>
                    <a href="./index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Quay về trang chủ</a>
                    <h6>
                      Khi cần trợ giúp vui lòng gọi 1800.1000 hoặc 028.3000.0000 (7h30 - 22h)
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      `);
    }
  }

  function calculateTotalOrder(cart) {
    let total = 0;
    let finalTotal = 0;
    let countProduct = 0;

    // Loop through each product in the cart
    $.each(cart, function(index, product) {
      // Multiply the product's price by its quantity
      let productTotal = product.productPrice * product.productQuantity;
      let productDiscountedTotal = product.productDiscountedPrice * product.productQuantity;
      let productCount = product.productQuantity;

      // Add the product's total to the order's total
      total += productTotal;
      finalTotal += productDiscountedTotal;
      countProduct += productCount;
    });

    // Display the total on the page
    $('.finalTotal').html(formatNumber(finalTotal));
    $('.totalPrice').html(formatNumber(total));  
    $('.countProduct').html(countProduct);
  }
</script>


<script>
  $(document).ready(function() {
        // Bắt sự kiện click cho nút "Đặt hàng"
        $("#btnPlaceOrder").click(function() {
            // Chuyển hướng đến trang điền thông tin khi nhấn nút
            window.location.href = "./index.php?page=checkout";
        });
    });
</script>
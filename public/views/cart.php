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
                    <h6 class="mb-0 text-muted"><span id="countProduct"></span> sản phẩm</h6>
                  </div>
                  <hr class="my-4" />

                  <div id="cart"></div>

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
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
  function formatNumber(num) {
    return num.toLocaleString('vi-VN');
  }
  // console.log(formatNumber(1000000)); 



  // Lấy dữ liệu sản phẩm từ localStorage
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  // console.log(cart);

  // Duyệt qua mỗi sản phẩm trong giỏ hàng
  $.each(cart, function(index, product) {
    // console.log(formatNumber(parseInt(product.productPrice)));

    // Tạo ra thẻ HTML cho mỗi sản phẩm
    let productHtml = `
    <div class="row mb-4 d-flex justify-content-between align-items-center">
      <div class="col-md-2 col-lg-2 col-xl-2 ">
        <img src="${product.productImage}" class="img-fluid rounded-3" alt="${product.productName}" />
      </div>
      <div class="col-md-3 col-lg-3 col-xl-4">
        <h6 class="text-black mb-0">${product.productName}</h6>
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
    if (product.productDiscountedPrice == 0) {
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
    </div>
    <hr class="my-4" />
   `;

    // Thêm thẻ HTML vào giỏ hàng
    $('#countProduct').html(cart.length);
    $('#cart').append(productHtml);
  });

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
  }
</script>
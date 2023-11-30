<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/list-product.css" />
    <link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon" />

    <?php
    $pageTitle = "Danh sách sản phẩm"; // cái khúc này là truyền biến từ controller qua view 
    ?>
    <title>
        <?php echo $pageTitle ?>
    </title>

</head>

<body>
    <?php include "../components/header.php" ?>

    <section class="cate-main-container">      
        <div class="box-filter top-box block-scroll-main cate">
            <section>
                <div class="jsfix scrolling__inner">
                    <div class="box-filter block-scroll-main scrolling">
                        <div class="scroll-btn show-right" style="display:none;">
                            <div class="btn-right-scroll"></div>
                        </div>
                        <div class="filter-total">
                            <div class="filter-item__title jsTitle">
                                <div class="arrow-filter">
                                    <i class="ti-filter"> Bộ lọc </i>
                                    <strong class="number count-total" style="display:none;"></strong>
                                </div>
                            </div>
                            <div class="filter-show show-total" id="wrapper">
                                <div class="list-filter-active" style="display:none;"> </div>
                                <div class="show-total-main"> </div>
                            </div>
                        </div>
                        <div class="filter-item block-manu">
                            <div class="filter-item__title jsTitle">
                                <div class="arrow-filter"></div>
                                <span> Hãng </span>
                            </div>
                            <div class="filter-show hascount" style="display:none;">
                                <div class="filter-list filter-list--hang manu">
                                    <a href="#" data-href="tivi-samsung" data-index="0" class="c-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Samsung1942-b_51.png" width="68" height="30" alt="Samsung">
                                    </a>
                                    <a href="#" data-href="tivi-sony" data-index="0" class="bc-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Sony1942-b_57.png" width="68" height="30" alt="Sony">
                                    </a>
                                    <a href="#" data-href="tivi-lg" data-index="0" class="c-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\LG1942-b_16.png" width="68" height="30" alt="LG">
                                    </a>
                                    <a href="#" data-href="tivi-casper" data-index="0" class="c-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Untitled-1-92x40-1.png" width="68" height="30" alt="Casper">
                                    </a>
                                    <a href="#" data-href="tivi-tcl" data-index="0" class="c-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\TCL1942-b_57.png" width="68" height="30" alt="TCL">
                                    </a>
                                    <a href="#" data-href="tivi-sharp" data-index="0" class="c-btnbox filter-manu">
                                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Sharp1942-b_48.png" width="68" height="30" alt="Sharp">
                                    </a>
                                </div>
                                <div class="filter-button">
                                    <a href="#" class="btn-filter-close"> Bỏ chọn </a>
                                    <a href="#" class="btn-filter-readmore">
                                        Xem <b class="total-reloading"> xxx </b> kết quả
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="filter-item__title jsTitle noselecttext">
                                <div class="arrow-filter"></div>
                                <span> Kích cỡ màn hình </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                        <div class="filter-item warpper-price-outside">
                            <div class="filter-item__title jsTitle">
                                <div class="arrow-filter"></div>
                                <span> Giá </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                        <div class="filter-item">
                            <div class="filter-item__title jsTitle noselecttext">
                                <div class="arrow-filter"></div>
                                <span> Độ phân giải </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                        <div class="filter-item">
                            <div class="filter-item__title jsTitle noselecttext">
                                <div class="arrow-filter"></div>
                                <span> Loại Tivi </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                        <div class="filter-item">
                            <div class="filter-item__title jsTitle noselecttext">
                                <div class="arrow-filter"></div>
                                <span> Tiện ích </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                        <div class="filter-item">
                            <div class="filter-item__title jsTitle noselecttext">
                                <div class="arrow-filter"></div>
                                <span> Hệ điều hành </span>
                            </div>
                            <div class="filter-show" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="box-quicklink block-scroll-main">
                    <div class="list-quickfilter q-manu">
                        <a href="#" data-href="tivi-samsung" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Samsung1942-b_51.png" width="30" class="no-text">
                        </a>
                        <a href="#" data-href="tivi-sony" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Sony1942-b_57.png" width="30" class="no-text">
                        </a>
                        <a href="#" data-href="tivi-lg" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\LG1942-b_16.png" width="30" class="no-text">
                        </a>
                        <a href="#" data-href="tivi-casper" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Untitled-1-92x40-1.png" width="30" class="no-text">
                        </a>
                        <a href="#" data-href="tivi-tcl" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\TCL1942-b_57.png" width="30" class="no-text">
                        </a>
                        <a href="#" data-href="tivi-sharp" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                            <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Sharp1942-b_48.png" width="30" class="no-text">
                        </a>
                    </div>
                    <div class="list-quicklink"></div>
                </div>
            </section>
        </div>
        <div id="categoryPage" class="desktop cate" data-name="TV" data-template="cate">
            <div class="box-sort">
                <p class="sort-total">
                    <b> xxx </b> Tivi
                    <strong class="manu-sort"></strong>
                </p>
                <div class="box-checkbox extend">
                    <a href="#" data-href data-type="sp2020" class="c-checkitem">
                        <span class="tick-checkbox"></span>
                        <p class="pb-0"> Giảm giá </p>
                    </a>
                    <a href="#" data-href="-tra-gop-0-phan-tram" data-type="installment0" class="c-checkitem">
                        <span class="tick-checkbox"></span>
                        <p> Góp 0% - 1% </p>
                    </a>
                    <a href="#" data-href data-type="monopoly" class="c-checkitem">
                        <span class="tick-checkbox"></span>
                        <p> Đặc quyền tại SHOP </p>
                    </a>
                    <a href="#" data-href="-moi" data-type="new" class="c-checkitem">
                        <span class="tick-checkbox"></span>
                        <p> Mới nhất </p>
                    </a>
                </div>
                <div class="sort-select">
                    <p class="click-sort">
                        Xếp theo:
                        <span class="sort-show">
                            Nổi bật
                        </span>
                    </p>
                    <div class="sort-select-main-sort"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="container-productbox">
                <div id="preloader">
                    <div id="loader"></div>
                </div>
                <ul class="listproduct">
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                    <li class="item __cate" data-index="1">
                        <a href="#" data-s="TwoPrice" data-site="2" data-pro="3" data-name="Smart Tivi QLED 4K 43 inch Samsung QA43Q65A" class="main-contain">
                            <div class="item-img item-img_">
                                <img class="thumb ls-is-cached lazyloaded" src="../assets/img/product-picture.jpg">
                            </div>
                            <h3> Tên sản phẩm </h3>
                            <div class="item-compare">
                                <span> 43 inch </span>
                                <span> 4K </span>
                            </div>
                            <div class="box-p">
                                <p class="price-old black">12.390.000₫</p>
                                <span class="percent"> - 19% </span>
                            </div>
                            <strong class="price"> 9.990.000₫ </strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                    <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                                </p>
                                <p class="item-rating-total"> 133 </p>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="view-more">
                    <a href="#"> Xem thêm
                        <span class="remain"> xxx </span> Tivi
                    </a>
                </div>

            </div>
        </div>
    </section>

    <?php include '../components/footer.php'; ?>
</body>

</html>
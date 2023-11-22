<!DOCTYPE html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--plugins-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
    <!-- loader-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace-theme-default.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/categories.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../assets/css/semi-dark.css" />

    <link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

    <?php
    $pageTitle = "ecoTech - Sửa danh mục";
    ?>
    <title><?php echo $pageTitle ?></title>

</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <?php include_once "../components/sidebar.php" ?>

        <?php include_once "../components/header.php" ?>


        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="./dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm </li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <h6 class="mb-0 text-uppercase">Danh mục sản phẩm </h6>
                <hr />
                <!-- insert form -->
                <div class="card">
                    <div class="card-body">
                        <form action="../../admin/controllers/categories.php" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="category-id" class="form-label">Mã danh mục</label>
                                        <input type="text" class="form-control" id="category-id" name="category-id" placeholder="ID" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="category-quantity" class="form-label">Số lượng</label>
                                        <input type="number" class="form-control" id="category-quantity" name="category-quantity" placeholder="0" required min="0" step="1">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label for="category-picture" class="form-label">Hình ảnh</label>
                                        <input type="text" class="form-control" id="category-picture" name="category-picture" placeholder="Hình ảnh" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="product-description" class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" id="product-description" name="product-description" placeholder="Mô tả chi tiết" required>
                                </div>
                            </div>

                            <button type="submit" name="insert" class="btn btn-primary">Sửa</button>
                        </form>
                    </div>
                </div>



            </div>
        </div>
        <!--end page wrapper -->


        <?php include_once "../components/footer.php" ?>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
    <script src="../assets/plugins/chartjs/chart.min.js"></script>
    <script src="../assets/js/index.js"></script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
</body>

</html>
<?php
require_once "./partials/header2.par.php";
require_once "../includes/config.session.inc.php";
require_once "../includes/autoloader.inc.php";
if (!isset($_SESSION["user_id"])) {
    header("location: ../index.php");
}
$view = new ProductView();
?>
<link rel="stylesheet" href="../assets/css/create.css">
<link rel="stylesheet" href="../assets/libraries/Vendor/fontawesome/css/all.css">
<script src="../assets/libraries/Vendor/fontawesome/js/all.js"></script>
<link rel="stylesheet" href="../assets/libraries/CodeSeven-toastr-2.1.4-7-g50092cc/CodeSeven-toastr-50092cc/build/toastr.min.css">

</head>

<body>
    <main>
        <form id="productForm" action="../includes/product.inc.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code_prod" placeholder="e.g. P-001">
            </div>


            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name_prod" placeholder="Product name">
            </div>


            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the product..."></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            <!-- Weight -->
            <div class="mb-3">
                <label for="weight" class="form-label">Weight[g]</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="0.00">
            </div>


            <!-- Cost Price -->
            <div class="mb-3">
                <label for="cost" class="form-label">Cost Price[XAF]</label>
                <input type="number" class="form-control" id="cost" name="cost_price">
            </div>


            <!-- Sale Price -->
            <div class=" mb-3">
                <label for="sale" class="form-label">Sale Price[XAF]</label>
                <input type="number" class="form-control" id="sale" name="sale_price">
            </div>
            <div id="error_log">
                <?php
                if (isset($_SESSION['errors_product']) && $_SESSION["errors_product"] !== null) {
                    $data = $_SESSION["errors_product"];
                    $_SESSION["errors_product"] = null;
                    echo "<ul>";
                    foreach ($data as $key => $value) {
                        echo "<li class='errors' style='font-size: 15px;color: red; margin-bottom: 5px'>$value</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>



            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" name="create_product" class="btn btn-primary">Submit</button>
            </div>


        </form>

    </main>
    <script src="../assets/libraries/jquery-ui-1.14.1.custom/external/jquery/jquery.js"></script>
    <script src="../node_modules/jquery-validation/dist/jquery.validate.js"></script>
    <script src="../node_modules/jquery-validation/dist/additional-methods.js"></script>
    <script src="../assets/libraries/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script src="../assets/libraries/CodeSeven-toastr-2.1.4-7-g50092cc/CodeSeven-toastr-50092cc/build/toastr.min.js"></script>
    <script>
        let url = new URLSearchParams(window.location.search)
        let status = url.get('task');

        if (status == "success") {
            toastr["success"]("Product added succesfully")

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
        $(document).ready(function() {
            $("#productForm").validate({
                errorElement: "em",
                debug: true,
                highlight: function(element) {
                    $(element).addClass("error-input");
                },
                unhighlight: function(element) {
                    $(element).removeClass("error-input");

                },
                rules: {
                    code_prod: {
                        required: true,
                        number: true,
                        minlength: 13,
                        maxlength: 13,

                    },
                    name_prod: "required",
                    description: "required",
                    image: {
                        required: true,
                        // extension: "png|jpg|jpeg",
                        accept: "images/*",
                    },
                    weight: {
                        required: true,
                        number: true,
                    },
                    cost_price: {
                        required: true,
                        number: true,
                    },
                    sale_price: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    code_prod: {
                        required: "please enter the product's code",
                        number: "Product code must consist of only numbers",
                        minlength: "it must be 13 digits",
                        maxlength: "it must be 13 digits"
                    },
                    name_prod: "please enter the product's name",
                    description: "please enter the product's description",
                    image:  {
                        required: "please enter the product's image",
                        // extension: "the required file types are png|jpg|jpeg",
                        accept: "it must be an image",
                    },
                    weight: {
                        required: "please enter the product's weight",
                        number: "it must be a number/decimal",
                    },
                    cost_price: {
                        required: "please enter the product's cost price",
                        number: "it must be a number",
                    },
                    sale_price: {
                        required: "please enter the product's sale price",
                        number: "it must be a number",
                    }
                },

            })
        });
    </script>
</body>

</html>
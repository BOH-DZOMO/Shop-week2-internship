<?php
require_once "./partials/header2.par.php";
require_once "../includes/config.session.inc.php";
require_once "../includes/autoloader.inc.php";
if (!isset($_SESSION["user_id"])) {
    header("location: ../index.php");
}
$view = new ProductView();
?>
<link rel="stylesheet" href="../assets/css/list.css">
<link rel="stylesheet" href="../assets/libraries/Vendor/fontawesome/css/all.css">
<script src="../assets/libraries/Vendor/fontawesome/js/all.js"></script>
<link rel="stylesheet" href="../assets/libraries/CodeSeven-toastr-2.1.4-7-g50092cc/CodeSeven-toastr-50092cc/build/toastr.min.css">
</head>

<body>
    <div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="page-header">
					<div class="alert alert-info" role="alert">
						<h4>This demo shows how to integrate JQuery-validation and the Bootstrap framework.</h4>
						<ul>
							<li><a href="https://getbootstrap.com/" class="alert-link">Bootstrap home project</a>.</li>
						</ul>
					</div>
				</div>

				<div class="panel panel-default">

        <form id="productForm" action="" method="POST" enctype="multipart/form-data">

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
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="0.00">
            </div>


            <!-- Cost Price -->
            <div class="mb-3">
                <label for="cost" class="form-label">Cost Price[XAF]</label>
                <input type="text" class="form-control" id="cost" name="cost_price">
            </div>


            <!-- Sale Price -->
            <div class=" mb-3">
                <label for="sale" class="form-label">Sale Price[XAF]</label>
                <input type="text" class="form-control" id="sale" name="sale_price">
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
                // errorPlacement: function(error, element) {
                //     // Add the `help-block` class to the error element
                //     error.addClass("help-block");

                    // if (element.prop("type") === "checkbox") {
                    //     error.insertAfter(element.parent("label"));
                    // } else {
                    //     error.insertAfter(element);
                    // }
                // },
                // highlight: function(element, errorClass, validClass) {
                //     $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                // },
                // unhighlight: function(element, errorClass, validClass) {
                //     $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                // },
                rules: {
                    code_prod: "required",
                    name_prod: "required",
                    description: "required",
                    image: "required",
                    weight: "required",
                    cost_price: "required",
                    sale_price: "required",
                },
                messages: {
                    code_prod: "please enter the product's code",
                    name_prod: "please enter the product's name",
                    description: "please enter the product's description",
                    image: "please enter the product's image",
                    weight: "please enter the product's weight",
                    cost_price: "please enter the product's cost price",
                    sale_price: "please enter the product's sale price",
                },

            })
        });
    </script>
</body>

</html>
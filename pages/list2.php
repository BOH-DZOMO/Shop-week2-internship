<?php
require_once "./partials/header2.par.php";
require_once "../includes/autoloader.inc.php";
$view = new ProductView();
?>
<link rel="stylesheet" href="../assets/css/list.css">
<link rel="stylesheet" href="../assets/libraries/DataTables/datatables.css">
<link rel="stylesheet" href="../assets/libraries/Vendor/fontawesome/css/all.css">
<script src="../assets/libraries/Vendor/fontawesome/js/all.js"></script>
</head>

<body>
    <main>
        <div>
            <table class='table' id='product-table'>
                <thead>
                    <tr>
                        <th scope='col'>code</th>
                        <th scope='col'>name</th>
                        <th scope='col'>description</th>
                        <th scope='col'>image</th>
                        <th scope='col'>weight</th>
                        <th scope='col'>cost price</th>
                        <th scope='col'>sele price</th>
                        <th scope='col'>created_at</th>
                        <th scope='col'>actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </main>
    <script src="../assets/libraries/jquery-ui-1.14.1.custom/external/jquery/jquery.js"></script>
    <!-- <script src="../assets/libraries/DataTables/datatables.min.js"></script> -->
    <script src="../assets/libraries/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script src="../assets/libraries/DataTables/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                responsive: true,
                
                ajax: {
                    url: '../scripts/product-server.php',
                    type: 'POST',
                    },
                    columns: [
                        { data: 'code_prod' },
                        { data: 'name_prod' },
                        { data: 'description' },
                        { data: 'image' },
                        { data: 'weight' },
                        { data: 'cost_price' },
                        { data: 'sale_price' },
                        { data: 'created_at' },
                        { data: 'actions'}
                ],
            serverSide: true,
            processing: true,
            });
        });
    </script>
</body>

</html>
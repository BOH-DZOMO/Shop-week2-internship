<?php
require_once "./partials/header2.par.php";
require_once "../includes/autoloader.inc.php";
$view = new ProductView();
?>
<link rel="stylesheet" href="../assets/css/list.css">
</head>

<body>
    <main>
        <div>
            <!-- <table class='table' id='user-table'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>firstName</th>
                        <th scope='col'>lastName</th>
                        <th scope='col'>telephone</th>
                        <th scope='col'>role</th>
                        <th scope='col'>created_at</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope='row'>$c</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table> -->
        </div>
        <div>
           <?php $view->ProductTable() ?>
        </div>
    </main>
    <script src="../assets/libraries/DataTables/datatables.min.js"></script>
    <script src="../assets/libraries/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>
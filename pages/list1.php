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
<script src="../assets/libraries/DataTables/datatables.js"></script>
<link rel="stylesheet" href="../assets/libraries/DataTables/datatables.css">
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
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
    <!-- <script src="../assets/libraries/jquery-ui-1.14.1.custom/external/jquery/jquery.js"></script> -->
    <!-- <script src="../assets/libraries/DataTables/datatables.min.js"></script> -->
    <script src="../assets/libraries/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
    <script>

             function deleteProd(user_id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../scripts/deleteProd.php", {
                            id: user_id
                        },
                        function(data) {
                            console.log(data.status)
                            if (data.status == "success") {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                location.reload()
                            } else {
                                Swal.fire("An error occured!");
                            }
                        },
                        "json"
                    );
                }
            });


        }

        $(document).ready(function() {
            $('#product-table').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
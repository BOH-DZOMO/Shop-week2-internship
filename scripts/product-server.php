<?php
// require_once "../classes/Product.class.php";
require_once "../includes/autoloader.inc.php";

$product = new Product();

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$search = $_POST['search']['value'] ?? '';

// Count total records
$total = $product->countProducts();

// Get filtered records
$data = $product->getProductsServerSide($start, $length, $search);
$recordsFiltered = $product->countFilteredProducts($search);

// Prepare JSON response
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($total),
    "recordsFiltered" => intval($recordsFiltered),
    "data" => []
];

$c = $start + 1;
foreach ($data as $row) {
    $response['data'][] = [
        'code_prod' => $row['code_prod'],
        'name_prod' => $row['name_prod'],
        'description' => $row['description'],
        // 'image' => "<img class='image' src='{$row['image']}'>",
        'image' => "<div><img class='image' src='{$row['image']}'></div>",
        'weight' => $row['weight'],
        'cost_price' => $row['cost_price'] . " XAF",
        'sale_price' => $row['sale_price'] . " XAF",
        'created_at' => $row['created_at'],
        'actions' => "
        <div class='btn-group'>
    <button type='button' class='btn btn-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
        Actions
    </button>
    <ul class='dropdown-menu'>
        <li><a class='dropdown-item d-flex justify-content-around align-items-center' href='#'><span class='fa fa-pen-to-square'></span>Edit</a></li>
        <li><a class='dropdown-item d-flex justify-content-evenly align-items-center' href='#'><span class='fa fa-trash'></span>Delete</a></li>
    </ul>
</div>
        "
    ];
}

echo json_encode($response);

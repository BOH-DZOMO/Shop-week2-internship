<?php

    class ProductView extends Product{
        public function ProductTable()
        {
            $data = $this->getProducts();
            $c = 1;
            echo "
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
                <tbody>
            ";
            foreach ($data as $key => $value) {       
            echo "      <tr>
                        <td>{$value['code_prod']}</td>
                        <td>{$value['name_prod']}</td>
                        <td>{$value['description']}</td>
                        <td><div><img class='image' src='{$value['image']}'></div></td>
                        <td>{$value['weight']}</td>
                        <td>{$value['cost_price']} XAF</td>
                        <td>{$value['sale_price']} XAF</td>
                        <td>{$value['created_at']}</td>
                        <td>
                        <div class='btn-group'>
                            <button type='button' class='btn btn-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                Actions
                            </button>
                            <ul class='dropdown-menu'>
                                <li onclick='deleteProd({$value["id_prod"]})'><a class='dropdown-item d-flex justify-content-evenly align-items-center' href='#'><span class='fa fa-trash'></span>Delete</a></li>
                            </ul>
                        </div>                        
                        </td>
                        </tr>

            ";
            $c+=1;
            }
            echo "
                </tbody>
            </table>
            ";
        }
    }
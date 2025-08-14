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
                        <th scope='col'>#</th>
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
                    <tr>
            ";
            foreach ($data as $key => $value) {       
            echo "      <tr>
                        <th scope='row'>$c</th>
                        <td>{$value['code_prod']}</td>
                        <td>{$value['name_prod']}</td>
                        <td>{$value['description']}</td>
                        <td><div><img class='image' src='{$value['image']}'></div></td>
                        <td>{$value['weight']}</td>
                        <td>{$value['cost_price']} XAF</td>
                        <td>{$value['sale_price']} XAF</td>
                        <td>{$value['created_at']}</td>
                        <td>                        
                        <div class='action_bar'>
                        <form action='' method='post'>
                        <input type='hidden' name='task_id' value='{$value["user_id"]}' >
                        <button class='btn btn-primary' name='edit_page'>Edit</button>
                        </form>
                        <form action='' method='post'>
                        <input type='hidden' name='task_id' value='{$value["user_id"]}'>
                        <button type='submit' class='btn btn-danger' id='delete' name='delete_task'>Delete</button>
                        </form>
                        <form action='' method='post'>
                        <input type='hidden' name='task_id' value='{$value["user_id"]}' >
                        <button  class='btn btn-success' name='complete_task'>Complete</button>
                        </form>
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
<?php
    include('connection.php');

    if (isset($_POST['key'])) {

        if($_POST['key'] == 'addNew'){
            
            $prod_id = $_POST['prod_id'];
            $name = $_POST['name'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $price = $_POST['price'];
            
            $check = mysqli_query($conn,"SELECT * FROM product WHERE prod_id = '$prod_id'");
    
            if(mysqli_num_rows($check) > 0) {
                echo "That product already exists";
            } else {
            
                $sql="INSERT INTO `product` (`prod_id`, `name`, `size`, `price`, `color`) VALUES ('$prod_id', '$name', '$size', '$price', '$color')";
            
                if ($conn->query($sql) === TRUE) {
                    echo "Successfully inserted new product!";
                }
                else 
                {
                    echo "Error while inserting new product!";
                }
            }
        }


        if($_POST['key'] == 'viewData'){
    
            $start = $conn->real_escape_string($_POST['start']);
            $limit = $conn->real_escape_string($_POST['limit']);
            $sort = $conn->real_escape_string($_POST['sort']);
            $sql = $conn->query("SELECT prod_id, name, size, color, price FROM product ORDER BY $sort LIMIT $start, $limit");

            if ($sql->num_rows > 0) {
                $response = "";
                while($data = $sql->fetch_array()) {
    
                    $response .= '
                                <tr>
                                    <td id="product_'.$data["prod_id"].'">'.$data["prod_id"].'</td>
                                    <td>'.$data["name"].'</td>
                                    <td>'.$data["size"].'</td>
                                    <td>'.$data["color"].'</td>
                                    <td>'.$data["price"].'</td>
                                    <td>
                                         <input type="button" onclick="changeView('.$data["prod_id"].', \'change\')" value="View" class="btn btn-primary">
                                         <input type="button" onclick="changeView('.$data["prod_id"].', \'view\')" value="Edit" class="btn btn-warning">
                                         <input type="button" onclick="deleteProd('.$data["prod_id"].')" value="Delete" class="btn btn-danger">
                                    </td>
                                </tr>
                            ';
                    }
                    exit($response);
                    } else
                        exit('reachedMax');	
        }


        
        if ($_POST['key'] == 'delete') {
            $prod_id = $conn->real_escape_string($_POST['prod_id']);
            $conn->query("DELETE FROM product WHERE prod_id='$prod_id'");
            exit('Product has been deleted!');
        }

        if($_POST['key'] == 'getOne'){
            $prod_id = $conn->real_escape_string($_POST['prod_id']);
            $sql = $conn->query("SELECT prod_id , name, size, color, price FROM product WHERE prod_id = $prod_id");
            $data = $sql->fetch_array();
            $jsonArray = array(
                'prod_id'=>$data['prod_id'],
                'name'=>$data['name'],
                'size'=>$data['size'],
                'color'=>$data['color'],
                'price'=>$data['price']
            );
            exit(json_encode($jsonArray));
        }
            

        if ($_POST['key'] == 'edit') {

            $prod_id = $conn->real_escape_string($_POST['prod_id']);

                $prod_id = $_POST['prod_id'];
                $name = $_POST['name'];
                $size = $_POST['size'];
                $color=$_POST['color'];
                $price=$_POST['price'];
                
            
                $sql="UPDATE product SET name='$name', size='$size', color='$color', price='$price' WHERE (prod_id='$prod_id')";
                if ($conn->query($sql) === TRUE) {
                    echo "Product successfully changed!";
                }
                else 
                {
                    echo "Error updating product!";
                }
            
            }
        }
    
        mysqli_close($conn);
    
?>
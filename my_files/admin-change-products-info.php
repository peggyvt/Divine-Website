<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Products</title>
        <link rel="shortcut icon" href="images/icon.png"/>
        
        <!--Basic Settings-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--External CSS Bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        
        <!--External JQuery-->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

        <!--External JS Bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!--Noto Serif Display fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@100&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300&display=swap" rel="stylesheet"> 
        
        <!--Icon Library-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--External CSS-->
        <link rel="stylesheet" href="style.css">

        <style>
            .navbar {
                padding: 0;
            }
            .nav-item .dropdown-menu{ display: none; }
            .nav-item:hover .dropdown-menu{ display: block; }
            .nav-item .dropdown-menu{ margin-top:0; }
            .slogan {
                font-family: "Calibri Light", sans-serif;
                font-size: 90%;
            }

            .num {
                padding: 30px;
            }

            .products {
                text-align: center;
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
            }

            input {
                outline: none;
            }
        </style>
        
        <?php 
            require 'vendor/autoload.php';
            session_start();
            $m = new MongoDB\Client("mongodb://127.0.0.1/");
            $db = $m->divinedb;
            $collection_products = $db->products;
        ?>
    </head>
    <body>
        <header class="text-center">
            <a href="home.php"><img src="images/logo.png" width="166.3px" height="83.67px" align="center"></a><br>
            <font size=small color="white">DIVINE</font>
            <font class="slogan" color=#ad873a>..divine scents for divine people</font>
            <br><br>
        </header>

        <nav class="mx-auto">
            <div class="container">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-change-users-info.php">USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-change-products-info.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-change-orders-info.php">ORDERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">ACCOUNT</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="extras" align="right">
            <!--sign out button-->
            <button style="background-color: #dfe0df;color: #674335;
            border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-out-Modal"><i class="fa fa-sign-out"></i></button>
        
            <!--SIGN OUT MODAL-->
            <div class="modal" id="sign-out-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">LEAVING?</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-Out-Form" text-align="center">
                            <form method="POST" action="sign-out-user.php">   
                                <input type="submit" id="sign-out-btn1" aria-label="sign out button" name="sign-out-btn1" value="YES"/>
                                <input type="submit" id="sign-out-btn2" aria-label="sign out button" name="sign-out-btn2" value="STAY"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="products container">
            <?php 
                $num = $collection_products->count(); 
                echo "<div class='num'>Total Products: " . $num . "</div>";?>

            <table class="table">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>price</th>
                    <th>availability</th>
                    <th>collection</th>
                    <th>image</th>
                </tr>

                <?php 
                    $products = $collection_products->find(); ?>
                    <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:150px; outline: none;" type="button" data-toggle="modal" data-target="#add-product-Modal">Add new product</button>
                    <?php foreach ($products as $product) { ?>
                            <tr>
                                <td> <?php echo $product->_id; ?></td>
                                <td> <?php echo $product->name; ?></td>
                                <td> <?php echo $product->price; ?></td>
                                <td> <?php echo $product->availability; ?></td>
                                <td> <?php echo $product->collection; ?></td>
                                <td> <?php echo $product->img; ?></td>
                                <td> <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#edit-product-Modal-<?php echo $product->_id?>"><i class="fa fa-edit"></i></button></td>
                                <td> <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#delete-product-Modal-<?php echo $product->_id?>"><i class="fa fa-trash"></i></button></td>
                            </tr><br>

                        <div class="modal" id="edit-product-Modal-<?php echo $product->_id?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">UPDATE PRODUCT</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <section class="Update-Form" text-align="center">
                                        <form method='POST' action='update-product.php'> 
                                            <label class='name-label' for='name'>NAME</label><br/>
                                            <input type='text' id='name' name='name' value='<?php echo $product->name; ?>' aria-label='name' pattern='\S+.*'><br/>
                                            
                                            <label class='price-label' for='price'>PRICE</label><br/>
                                            <input type='text' id='price' name='price' value='<?php echo $product->price; ?>' aria-label='price' pattern='\S+.*'><br/>

                                            <label class='availability-label' for='availability'>AVAILABILITY</label><br/>
                                            <input type='text' id='availability' name='availability' value='<?php echo $product->availability; ?>' aria-label='availability' pattern='\S+.*'><br/>

                                            <label class='collection-label' for='collection'>COLLECTION</label><br/>
                                            <input type='text' id='collection' name='collection' value='<?php echo $product->collection; ?>' aria-label='collection' pattern='\S+.*'><br/>

                                            <label class='img-label' for='img'>IMAGE</label><br/>
                                            <input type='text' id='img' name='img' value='<?php echo $product->img; ?>' aria-label='image' pattern='[A-Za-zΑ-Ωα-ω]{0, 20}'><br/>
                                            
                                            <input type='submit' id='update-product-details-btn' aria-label='update product details button' class='update-product-details-btn' value='UPDATE'/>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="delete-product-Modal-<?php echo $product->_id?>" class="delete-product">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">DELETE PRODUCT</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <section class="Delete-Form" text-align="center">
                                        <form method='POST' action='delete-product.php'> 
                                            <label class='delete-label' style="color: black;" for='name'>Are you sure you want to delete product with name:</label><br/>
                                            <input type='text' id='name' style="border: none; width: 180px;" name='name' value='<?php echo $product->name;?>' readonly aria-label='product email'>?<br/>
                                            
                                            <input type='submit' id='delete-product-btn' style="margin: 15px;" aria-label='delete product button' name='delete-product-btn' value='YES'/>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </table>
            
            
            <div class="modal" id="add-product-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">ADD PRODUCT</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Insert-Products-Form" text-align="center">
                            <form method="POST" action="insert-products.php" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "passwords do not match" : "")'>
                                <label class="name-label" for="name">NAME</label><br/>
                                <input type="text" id="name" name="name" aria-label="name" required title="please enter product name" required minlength="1" pattern="\S+.*"><br/>
                                
                                <label class="price-label" for="price">PRICE</label><br/>
                                <input type="text" id="price" name="price" aria-label="price" required title="please enter price" required minlength="1" pattern="\S+.*"><br/>

                                <label class="availability-label" for="availability">AVAILABILITY</label><br/>
                                <input type="text" id="availability" name="availability" required title="please enter availability"><br/>
                                
                                <label class="collection-label" for="collection">COLLECTION</label><br/>
                                <select id="collection" name="collection" required title="please enter collection">
                                    <option value="RUSTIC">RUSTIC</option>
                                    <option value="SILHOUETTE">SILHOUETTE</option>
                                </select><br/>
                                
                                <label class="img-label" for="img">IMAGE</label><br/>
                                <input type="text" id="img" name="img"  required title="please enter img path"><br/>

                                <input type="submit" id="add-product-btn" aria-label="add product button" class="add-product-btn" value="ADD NEW PRODUCT"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy DIVINE, 2022
        </footer>
    </body>
</html>
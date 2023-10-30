<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Account</title>
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
        <link rel="stylesheet" href="style.css?v=1">

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
            h2 {
                padding-left: 0%;
                padding-bottom: 20px;
                margin-bottom: 0px;
                text-align: center;
            }
            .text-1, .text-2 {
                font-family: "Calibri Light", sans-serif;
                width: 70%;
                text-align: center;
            }

            .first_name-label {
                padding-top: 10px;
            }

            .update-user-details-btn {
                margin: 25px;
            } 

            .sign-in-button {
                color: #674335;
                text-decoration: underline;
                cursor: pointer;
            }
            
            .sign-up-button {
                cursor: pointer;
            }
            
            .sign-in-button:hover {
                color: #674335;
                text-decoration: none;

            }

            .order_history {
                padding-top: 20px;
            }
        </style>
        
        <?php 
            require 'vendor/autoload.php';
            session_start();
            $m = new MongoDB\Client("mongodb://127.0.0.1/");
            $db = $m->divinedb;
            $collection_users = $db->users;
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
        <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['email'] == 'admin@gmail.com') { ?>
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
                        <a class="nav-link" href="admin-change-products-info.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-change-orders-info.php">ORDERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="account.php">ACCOUNT</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php } else { ?>
            <nav class="mx-auto">
                <div class="container">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" type="button" class="dropdown-toggle" data-toggle="dropdown">
                                OUR COLLECTIONS
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="rustic.php">RUSTIC</a>
                                <a class="dropdown-item" href="silhouette.php">SILHOUETTE</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inspiration.php">INSPIRATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">GALLERY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="account.php">ACCOUNT</a>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php } ?>
        <div class="extras" align="right">
            <!--favorites button, cart button, user button-->
            <?php if (isset($_SESSION['email']) && !$_SESSION['email'] == 'admin@gmail.com') { ?>
                <form method="POST" action="search-products.php">
                    <input class="search-bar" type="text" name="search" id="search" aria-label="search bar" placeholder="whatcha lookin fo..">
                    <button class="search-button" color="#4b8178"><i class="fa fa-search"></i></button><br><br>
                </form>
            <?php } ?>
            
            <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { 
                if (!$_SESSION['email'] == 'admin@gmail.com') {?>
                    <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#favorites-Modal"><i class="fa fa-heart"></i></button>
                    <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#cart-Modal"><i class="fa fa-shopping-cart"></i></button>
                <?php } ?>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-out-Modal"><i class="fa fa-sign-out"></i></button>
            <?php } else { ?>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#cart-Modal"><i class="fa fa-shopping-cart"></i></button>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-in-Modal"><i class="fa fa-user"></i></button>
            <?php } ?>

            <!--FAVORITES MODAL-->
            <div class="modal" id="favorites-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">YOUR FAVORITES</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Favorites-Form" text-align="center">
                            <form>
                                <?php 
                                    $user = $collection_users->findOne(['email' => $_SESSION['email']]);
                                    $i = 0;
                                    foreach ($user->favorites as $product) {
                                        $favorites = $user->favorites;?>

                                        <div class="item">
                                            <img style="border: none; align: left;" class="img" id="img" name="img" src="<?php echo $product->img;?>" width="168.5" height="168.5" alt="candle image">
                                        
                                            <div class="products-info">
                                                <label class="name-label" for="name">Name: </label>
                                                <input style="white-space: pre-wrap; outline: none; border: none; font-weight: 100; width: 220px;" type="text" id="name" name="name" readonly value="<?php echo $product->name;?>"><br/>
                                            
                                                <label class="price-label" for="price">Price: </label>
                                                <input style="outline: none; border: none; font-weight: 100; width: 30px;" type="text" id="price" name="price" readonly value="<?php echo $product->price;?>"><span style="font-weight: 100;">&euro;</span><br/>
                                            </div>
                                            
                                            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" class="delete-product-from-favs-btn" id="delete-product-from-favs-btn" name="delete-product-from-favs-btn" data-target="#delete-product-from-favs-<?php echo $i;?>"><i class="fa fa-trash"></i></button>
                                            
                                            <div class="modal" id="delete-product-from-favs-<?php echo $i;?>" class="delete-product-from-favs">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">DELETE PRODUCT FROM FAVORITES</h3>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <section class="Delete-Form" text-align="center">
                                                            <form> 
                                                                <label class='delete-label' style="color: black;text-align: center;" for='name'>Are you sure you want to delete product from favorites with name:</label><br/>
                                                                <input type='text' style="text-align: center; width: 220px;font-family: 'Noto Serif Display', serif;font-weight: 100; border: none;" id='product_name_from_favs' style="border: none; width: 180px;" name='product_name_from_favs' value='<?php echo $product->name;?>' readonly aria-label='product name'><span style="font-family: 'Noto Serif Display', serif;font-weight: 100;">?</span><br/>
                                                                
                                                                <input type='button' id='delete-product-from-favorites-btn' style="margin-right: 15px;" aria-label='delete product from favorites button' name='delete-product-from-favorites-btn'><a href="delete-product-from-favorites.php?name=<?php echo $product->name;?>">YES</a></input>
                                                            </form>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i = $i + 1;
                                    }?> 
                            </form>
                        </section>
                    </div>
                </div>
            </div>

            <!--CART MODAL-->
            <div class="modal" id="cart-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">YOUR CART</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Cart-Form" text-align="center">
                            <form>
                                <?php 
                                    $user = $collection_users->findOne(['email' => $_SESSION['email']]);
                                    $i = 0;
                                    foreach ($user->cart as $product) {
                                        $cart = $user->cart;?>

                                        <div class="item">
                                            <img style="border: none; align: left;" class="img" id="img" name="img" src="<?php echo $product->img;?>" width="168.5" height="168.5" alt="candle image">
                                        
                                            <div class="products-info">
                                                <label class="name-label" for="name">Name: </label>
                                                <input style="white-space: pre-wrap; outline: none; border: none; font-weight: 100; width: 220px;" type="text" id="name" name="name" readonly value="<?php echo $product->name;?>"><br/>
                                            
                                                <label class="price-label" for="price">Price: </label>
                                                <input style="outline: none; border: none; font-weight: 100; width: 30px;" type="text" id="price" name="price" readonly value="<?php echo $product->price;?>"><span style="font-weight: 100;">&euro;</span><br/>
                                            
                                                <label class="quantity-label" for="quantity">Quantity: </label>
                                                <input style="outline: none; border: none; font-weight: 100; width: 30px;" type="text" id="quantity" name="quantity" readonly value="<?php echo $product->quantity;?>"><br/>
                                            
                                                <label class="colour-label" for="colour">Colour: </label>
                                                <input style="outline: none; border: none; font-weight: 100; width: 150px;" type="text" id="colour" name="colour" readonly value="<?php echo $product->colour;?>"><br/>
                                            </div>

                                            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" class="delete-product-from-cart" id="delete-product-from-cart" name="delete-product-from-cart" data-target="#delete-product-from-cart-<?php echo $i;?>"><i class="fa fa-trash"></i></button>

                                            <div class="modal" id="delete-product-from-cart-<?php echo $i;?>" class="delete-product-from-cart">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">DELETE PRODUCT FROM CART</h3>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <section class="Delete-Form" text-align="center">
                                                        <form> 
                                                            <label class='delete-label' style="color: black;text-align: center;" for='name'>Are you sure you want to delete product from cart with name:</label><br/>
                                                            <input type='text' style="text-align: center; width: 220px;font-family: 'Noto Serif Display', serif;font-weight: 100; border: none;" id='product_name' style="border: none; width: 180px;" name='name' value='<?php echo $product->name;?>' readonly aria-label='product name'><span style="font-family: 'Noto Serif Display', serif;font-weight: 100;">?</span><br/>
                                                            
                                                            <input type='button' id='delete-product-from-cart-btn' style="margin-right: 15px;" aria-label='delete product from cart button' name='delete-product-from-cart-btn'><a href="delete-product-from-cart.php?name=<?php echo $product->name;?>">YES</a></input>
                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                            <?php $i = $i + 1;?>
                                        </div>
                                    <?php }?> 
                                <br><br>
                                <div class="justify-content-center mx-auto">
                                    <button type="button" id="checkout-btn" style="text-align: center; margin: 15px;margin-top: 0px;" aria-label="checkout button" class="checkout-btn" name="checkout-btn"><a href="checkout.php?email=<?php echo $user->email?>">CHECKOUT</a></button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>

            <!--SIGN IN MODAL-->
            <div class="modal" id="sign-in-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">HELLO YOU</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-In-Form" text-align="center">
                            <form method="POST" action="check-user.php">
                                <label class="email-label-1" for="email">EMAIL</label><br/>
                                <input type="email" id="email" name="email" required title="please enter your email"><br/>
                                
                                <label class="password-label-1" for="password">PASSWORD</label><br/>
                                <input type="password" id="password" name="password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please enter your password"></input><br/>

                                <input type="submit" id="sign-in-btn" aria-label="sign in button" class="sign-in-btn" value="SIGN IN"/>
                            </form>
                            <h6 class="new-here">NEW HERE? <a class="sign-up-button" class="btn btn-primary" data-toggle="modal" data-target="#sign-up-Modal" href="">SIGN UP</a></h6>
                        </section>
                        
                    </div>
                </div>
            </div>

            <!--SIGN UP MODAL-->
            <div class="modal" id="sign-up-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">WELCOME</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-Up-Form" text-align="center">
                            <form method="POST" action="insert-users.php" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "passwords do not match" : "")'>
                                <label class="first_name-label" for="first_name">FIRST NAME</label><br/>
                                <input type="text" id="first_name" name="first_name" aria-label="first name" required title="please enter your first name" required minlength="1" pattern="\S+.*"><br/>
                                
                                <label class="surname-label" for="surname">SURNAME</label><br/>
                                <input type="text" id="surname" name="surname" aria-label="surname" required title="please enter your surname" required minlength="1" pattern="\S+.*"><br/>

                                <label class="email-label-2" for="email">EMAIL</label><br/>
                                <input type="email" id="email" name="email" required title="please enter your email"><br/>
                                
                                <label class="password-label-2" for="password">PASSWORD</label><br/>
                                <input type="password" id="password" name="password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please enter your password"><br/>
                                
                                <label class="confirm_password-label" for="confirm_password">CONFIRM PASSWORD</label><br/>
                                <input type="password" id="confirm_password" name="confirm_password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please re-enter your password"><br/>

                                <input type="submit" id="sign-up-btn" aria-label="sign up button" class="sign-up-btn" value="SIGN UP"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>

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

        <div>
            <div class="text-1 mx-auto" width="65%">
                <?php 
                if (!isset($_SESSION['email'])) {
                    $_SESSION['email'] = 'guest@gmail.com';
                }
                $user = $collection_users->findOne(array('email' => $_SESSION['email']));
                if (isset($_SESSION['log']) && $_SESSION['log'] == true) { 
                    echo "
                    <h2>MY ACCOUNT</h2>
                    <form method='POST' action='update-user.php'> 
                    <label class='first_name-label' for='first_name'>FIRST NAME</label><br/>
                    <input type='text' id='first_name' name='first_name' value='" . $user->first_name . "' aria-label='first name' pattern='\S+.*'><br/>";

                    echo "<label class='surname-label' for='surname'>SURNAME</label><br/>
                    <input type='text' id='surname' name='surname' value='" . $user->surname . "' aria-label='surname' pattern='\S+.*'><br/>";

                    echo "<label class='email-label-2' for='email'>EMAIL</label><br/>
                    <input type='text' id='email' name='email' value='" . $user->email . "' aria-label='email' readonly pattern='\S+.*'><br/>";

                    echo "<label class='password-label-2' for='password'>PASSWORD</label><br/>
                    <input type='text' id='password' name='password' value='" . $user->password . "' aria-label='password' readonly pattern='[A-Za-zΑ-Ωα-ω]{0, 20}'><br/>
                    
                    <input type='submit' id='update-user-details-btn' aria-label='update user details button' class='update-user-details-btn' value='UPDATE'/></form>";?>

                    
                        <h2 class="order_history">ORDER HISTORY</h2>
                            <?php foreach ($user->orders as $order) {?>
                                <table class="table">
                                    <tr>
                                        <th>NAME</th>
                                        <th>PRICE</th>
                                        <th>QUANTITY</th>
                                        <th>COLOUR</th>
                                    </tr>
                                    <?php foreach ($order as $document) {?>
                                        <tr>
                                            <?php foreach ($document as $key=>$value) {
                                                if ($key != "user_email" AND $key != "total_price"){?>
                                                    <td>
                                                        <?php echo $value;?>
                                                    </td> 
                                                <?php }
                                            }?>
                                        </tr><br>
                                    <?php }?>
                                </table>
                        <?php }?>
                <?php } else {
                    echo"
                    <h2>HELLO</h2>
                    <h6 class='new-here'>ALREADY HAVE AN ACCOUNT? <a class='sign-in-button' class='btn btn-primary' data-toggle='modal' data-target='#sign-in-Modal1'>SIGN IN</a></h6>
                    <h6 class='new-here'>NEW HERE? <a class='sign-up-button' class='btn btn-primary' data-toggle='modal' data-target='#sign-up-Modal1'>SIGN UP</a></h6>
                    <br>";
                } ?>

                <!--SIGN IN MODAL-->
            <div class="modal" id="sign-in-Modal1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">HELLO YOU</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-In-Form" text-align="center">
                            <form method="POST" action="check-user.php">
                                <label class="email-label-1" for="email">EMAIL</label><br/>
                                <input type="email" id="email" name="email" required title="please enter your email"><br/>
                                
                                <label class="password-label-1" for="password">PASSWORD</label><br/>
                                <input type="password" id="password" name="password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please enter your password"></input><br/>

                                <input type="submit" id="sign-in-btn" aria-label="sign in button" class="sign-in-btn" value="SIGN IN"/>
                            </form>
                            <h6 class="new-here">NEW HERE? <a class="sign-up-button" class="btn btn-primary" data-toggle="modal" data-target="#sign-up-Modal1" href="">SIGN UP</a></h6>
                        </section>
                        
                    </div>
                </div>
            </div>

            <!--SIGN UP MODAL-->
            <div class="modal" id="sign-up-Modal1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">WELCOME</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-Up-Form" text-align="center">
                            <form method="POST" action="insert-users.php" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "passwords do not match" : "")'>
                                <label class="first_name-label" for="first_name">FIRST NAME</label><br/>
                                <input type="text" id="first_name" name="first_name" aria-label="first name" required title="please enter your first name" required minlength="1" pattern="\S+.*"><br/>
                                
                                <label class="surname-label" for="surname">SURNAME</label><br/>
                                <input type="text" id="surname" name="surname" aria-label="surname" required title="please enter your surname" required minlength="1" pattern="\S+.*"><br/>

                                <label class="email-label-2" for="email">EMAIL</label><br/>
                                <input type="email" id="email" name="email" required title="please enter your email"><br/>
                                
                                <label class="password-label-2" for="password">PASSWORD</label><br/>
                                <input type="password" id="password" name="password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please enter your password"><br/>
                                
                                <label class="confirm_password-label" for="confirm_password">CONFIRM PASSWORD</label><br/>
                                <input type="password" id="confirm_password" name="confirm_password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please re-enter your password"><br/>

                                <input type="submit" id="sign-up-btn" aria-label="sign up button" class="sign-up-btn" value="SIGN UP"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['email']=='admin@gmail.com') {?>
                <footer>
                    &copy DIVINE, 2022
                </footer>
            <?php } else {?>
                <footer>
                    <span><a align=left class="evaluation" target="_blank" href="https://forms.gle/zqGi5pqG3qHUcLP2A">Evaluate Us!</a></span><br>
                    <span>Follow us on <a class="instagram" target="_blank" href="https://www.instagram.com/thisisfilmaqi/">Instagram!</a></span>
                    <br><br>&copy DIVINE, 2022
                </footer>
            <?php } ?>
    </body>
</html>
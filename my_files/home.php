<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Home</title>
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

        <!--External Javascript-->
        <script src="functions.js"></script>

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

            #user_status {
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
                color: #4b8178;
            }

            .sign-out-btn1, .sign-out-btn2 {
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
                color: #000; 
                margin: 25px;
            }

            .Sign-Out-Form {
                text-align: center;
            }

            .products-info {
                padding: 10px;
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
                font-size: 125%;
                text-align: left;
            }

            label {
                color: black;
                display: inline;
            }

            #img {
                padding: 10px;
                float: left;
                align: left !important;
            }

            .item {
                clear: both;
            }

            .delete-product-from-cart {
                float: right;
                margin-right: 20px;
            }

            input #checkout-btn {
                clear: both;
                text-align: center;
                margin: 20px;
            }

            .Delete-Form {
                text-align: center;
            }

            .Cart-Form {
                text-align: center;
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
        <nav class="navbar-expand-lg mx-auto">
            <div class="container">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" type="button" class="dropdown-toggle" data-toggle="dropdown">
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
                        <a class="nav-link" href="account.php">ACCOUNT</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="extras" align="right">
            <!--search bar, favorites button, cart button, user button-->
            <form method="POST" action="search-products.php">
                <input class="search-bar" type="text" name="search" id="search" aria-label="search bar" placeholder="whatcha lookin fo..">
                <button class="search-button" color="#4b8178"><i class="fa fa-search"></i></button><br><br>
            </form>

            <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { ?>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#favorites-Modal"><i class="fa fa-heart"></i></button>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#cart-Modal"><i class="fa fa-shopping-cart"></i></button>
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
        <?php 
            //check if there is someone signed in
            if (isset($_SESSION['log']) && $_SESSION['log'] == true) {
                $user = $collection_users->findOne(['email' => $_SESSION['email']]);
                $_SESSION['email'] = $user->email;
                echo "<span id='user_status'>a user is signed in: ".$_SESSION['email']."</span>";
            } else { //if there's no user logged in, find the 'dummy' one
                echo "<span id='user_status'>there's a guest here</span>";
                //$user = $collection_users->findOne(['email' => 'guest']);
            }
        ?>
        <div align="center">
            <h1 align="left">Welcome to Divine</h1>
            <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                    <li data-target="#demo" data-slide-to="3"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="images/carousel/slide1.jpg" alt="candle image"></div>
                    <div class="carousel-item"><img src="images/carousel/slide2.jpg" alt="candle image"></div>
                    <div class="carousel-item"><img src="images/carousel/slide3.jpg" alt="candle image"></div>
                    <div class="carousel-item"><img src="images/carousel/slide4.jpg" alt="candle image"></div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div><br><br>
        <div>
            <h2>have a look...</h2>
            <div class="container py-5 myCont1">
                <div class="row">
                    <div class="mx-auto">
                        <img src="images/silhouette/pic1.jpg" alt="candle image" width="237px" height="237px">
                        <div class="candle-names">
                            EMOTIONS REVEALED
                        </div>
                        <div class="candle-price">
                            27&euro;
                        </div>
                    </div>
                    <div class="mx-auto">
                        <img src="images/rustic/pic7.jpg" alt="candle image" width="237px" height="237px">
                        <div class="candle-names">
                            SEA SHELLS
                        </div>
                        <div class="candle-price">
                            9&euro;
                        </div>
                    </div>
                    <div class="mx-auto">
                        <img src="images/rustic/pic3.jpg" alt="candle image" width="237px" height="237px">
                        <div class="candle-names">
                            LOVERS
                        </div>
                        <div class="candle-price">
                            12&euro;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <span><a align=left class="evaluation" target="_blank" href="https://forms.gle/zqGi5pqG3qHUcLP2A">Evaluate Us!</a></span><br>
            <span>Follow us on <a class="instagram" target="_blank" href="https://www.instagram.com/thisisfilmaqi/">Instagram!</a></span>
            <br><br>&copy DIVINE, 2022
        </footer>
    </body>
</html>
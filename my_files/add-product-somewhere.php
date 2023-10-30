<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Rustic Collection</title>
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
            /*.nav-item .dropdown-item { 
                display: none; 
            }

            .nav-item:hover .dropdown-item { 
                display: block; 
            }
            .nav-item .dropdown-menu{ margin-top:0; }*/
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
            h1 {
                text-align: center;
                padding-left: 0;
                padding-bottom: 20px;
            }
            .candle-names {
                color: black;
            }

            .candle-price {
                color: black;
            }

            .img:hover {
                box-shadow: 3px 2px rgba(75, 129, 120, 0.9);
                /*box-shadow: 3px 2px rgba(103, 67, 53, 0.9);*/
                transition: 0.3s;
            }

            .product-information {
                display: flex;
                padding: 10px;
            }

            .info {
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
                font-size: 125%;
                padding-left: 10px;
                text-align: left;
            }

            .modal-img {
                width: 337px;
                height: 337px;
            }

            .modal-lg {
                width: 700px;
            }

            .item-btns {
                font-family: 'Noto Serif Display', serif;
                font-weight: 100;
                padding-left: 14px;
                padding-top: 12px;
            }

            input {
                font-weight: 100;
                color: black;
                border: none;
                outline: none;
            }

            label {
                color: black;
                display: inline;
            }

            select {
                border: none;
                background-color: white;
                font-family: 'Noto Serif Display', serif;
                font-weight: 100;
                width: 130px;
            }

            option {
                font-family: 'Noto Serif Display', serif;
                font-weight: 100;
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
                        <a class="nav-link" href="home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="" type="button" class="dropdown-toggle" data-toggle="dropdown">
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
            <!--search bar, cart button, user button-->
            <input class="search-bar" type="text" aria-label="search bar" placeholder="whatcha lookin fo..">
            <button class="search-button" color="#4b8178"><i class="fa fa-search"></i></button><br><br>
            
            <button style="background-color: #dfe0df;color: #674335;
            border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;"><i class="fa fa-shopping-cart"></i></button>
            
            <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { ?>
                <button style="background-color: #dfe0df;color: #674335;
            border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-out-Modal"><i class="fa fa-sign-out"></i></button>
            <?php } else { ?>
                <button style="background-color: #dfe0df;color: #674335;
            border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-in-Modal"><i class="fa fa-user"></i></button>
            <?php } ?>

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
                                <!--onclick="CheckUser()"-->
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
                                <!--onclick="CheckUser()"-->
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div align="center">
                <div class="container myCont3">
                <div class="row">
                    <?php 
                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $availability = $_POST['availability'];
                        $quantity = $_POST['quantity'];
                        $colour = $_POST['colour'];
                        
                        $user = $collection_users->findOne(['email' => $_SESSION['email']]);
                        $product = $collection_products->findOne(['name' => $name]);

                        if (isset($_POST['favorites-btn'])) {
                            // add product to favorites
                            if($user->email != "guest") {
                                $favorites = (array)$user->favorites;
                                array_push($favorites, $product);
                                $user = $collection_users->updateOne(array("email"=>$_SESSION['email']), ['$set'=>["favorites"=>$favorites]]);
                                echo "Product successfully added to favorites!";
                                echo "<script>javascript:history.go(-1);</script>";

                            } else {
                                echo "You cannot add favorites as you are not signed in!";
                                echo "<script>javascript:history.go(-1);</script>";
                            }
                            
                        } else if (isset($_POST['cart-btn'])) {
                            // add product to cart if only there's availability
                            if($availability>0 && $availability>$quantity) {
                                $cart = (array)$user->cart;
                                $product = ['img'=>$product->img, 'name'=>$name, 'price'=>$price, 'quantity' => $quantity, 'colour' => $colour];
                                array_push($cart, $product);
                                
                                $product = $collection_products->findOne(['name' => $name]);
                                $collection_users->updateOne(array("email"=>$_SESSION['email']), ['$set'=>["cart"=>$cart]]);
                                echo "Product successfully added to cart!";
                                echo "<script>javascript:history.go(-1);</script>";
                            }
                        } ?>
                </div>
            </div>
        </div><br><br>
        <footer>
            &copy DIVINE, 2022
        </footer>
    </body>
</html>
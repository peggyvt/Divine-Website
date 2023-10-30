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

            h2 {
                padding-left: 0;
                text-align: center !important; 
            }

            h3 { 
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
                margin-bottom: 0;
                padding-left: 40px;
            }

            span {
                font-weight: 100;
            }

            .Card-Form {
                text-align: center;
            }

            .finish {
                margin-bottom: 10px;
            }

            #card_number, #expiration, #card_name, #cvv {
                outline: none; 
                font-weight: 100; 
                width: 150px;
                border: 1px 1px solid #4b8178;
                border-top: none;
                border-left: none;
                border-right: none;
                border-radius: 0px;
                margin: 10px;
            } 
        </style>

        <?php
            require 'vendor/autoload.php';
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
            <!--user button-->
            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#cart-Modal"><i class="fa fa-shopping-cart"></i></button>

            <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { ?>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-out-Modal"><i class="fa fa-sign-out"></i></button>
            <?php } else { ?>
                <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#sign-in-Modal"><i class="fa fa-user"></i></button>
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
        <?php
            
            if (isset($_SESSION['email'])) {
                echo "its set";
            }
            $email = $_GET['email'];
            $user = $collection_users->findOne(array('email' => $email));

            $i = 0;
            $price = 0;?>
            <div class="checkout">
                <h2 text-align="center">CHECKOUT</h2>
                
                <?php foreach ($user->cart as $product) {

                    echo'<div class="item">
                            <img style="border: none; align: left;" class="img" id="img" name="img" src="' . $product->img . '" width="168.5" height="168.5" alt="candle image">
                            <div class="products-info">
                                <label class="name-label" for="name">Name: </label>
                                <input style="white-space: pre-wrap; outline: none; border: none; font-weight: 100; width: 220px;" type="text" id="name" name="name" readonly value="' . $product->name . '"><br/>
                            
                                <label class="price-label" for="price">Price: </label>
                                <input style="outline: none; border: none; font-weight: 100; width: 30px;" type="text" id="price" name="price" readonly value="' . $product->price . '"><span style="font-weight: 100;">&euro;</span><br/>
                                ';
                                $product_price = $product->price;
                                $product_quantity = $product->quantity;
                                $price = $price + $product_price*$product_quantity;
                                echo'
                                <label class="quantity-label" for="quantity">Quantity: </label>
                                <input style="outline: none; border: none; font-weight: 100; width: 30px;" type="text" id="quantity" name="quantity" readonly value="' . $product->quantity . '"><br/>
                            
                                <label class="colour-label" for="colour">Colour: </label>
                                <input style="outline: none; border: none; font-weight: 100; width: 150px;" type="text" id="colour" name="colour" readonly value="' . $product->colour . '"><br/>
                            </div>
                        </div>
                    ';
                }?><br>
                <h3>Total Price: <span><?php echo $price;?>&euro;</span></h3>
            </div>
            <br><br>
            <section class="Card-Form" text-align="center">
                <h2 class="finish">FINISH YOUR ORDER</h2>
                <form method="POST" action="add-order.php"> 
                    <label class="card_number-label" for="card_number">CARD NUMBER: </label>
                    <input type="text" id="card_number" name="card_number"><br/>
                
                    <label class="expiration-label" for="expiration">EXPIRATION: </label>
                    <input type="text" id="expiration" name="expiration"><br/>
                
                    <label class="card_name-label" for="card_name">CARD NAME: </label>
                    <input type="text" id="card_name" name="card_name"><br/>
                    
                    <label class="cvv-label" for="cvv">CVV: </label>
                    <input type="text" id="cvv" name="cvv"><br/>
                
                    <input type="submit" id="add-order-btn" aria-label="add order button" class="add-order-btn" value="PAY"/>
                </form>
            </div>
        </div>
        <footer>
            <span><a align=left class="evaluation" target="_blank" href="https://forms.gle/zqGi5pqG3qHUcLP2A">Evaluate Us!</a></span><br>
            <span>Follow us on <a class="instagram" target="_blank" href="https://www.instagram.com/thisisfilmaqi/">Instagram!</a></span>
            <br><br>&copy DIVINE, 2022
        </footer>
    </body>
</html>
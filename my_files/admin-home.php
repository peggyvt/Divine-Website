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
        <link rel="stylesheet" href="style.css">

        <!--External Javascript-->
        <script src="functions.js"></script>

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

        <nav class="mx-auto">
            <div class="container">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-home.php">HOME</a>
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
                        <a class="nav-link" href="account.php">ACCOUNT</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="extras" align="right">
            <!--user button-->
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
                echo "<span id='user_status'>an admin is signed in: ".$_SESSION['email']."</span>";
            } else { //if there's no user logged in, find the 'dummy' one
                echo "<span id='user_status'>there's a guest here</span>";
                //$user = $collection_users->findOne(['email' => 'guest']);
            }
        ?>
        <h1 align="left">Welcome to Divine, Admin</h1>

        <div align="center">
            <br>
            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178; border-bottom-color: #4b8178; font-family: 'Noto Serif Display', serif; font-weight: 300; font-size: 16px; outline: none;"><a class="nav-link" href="admin-change-users-info.php">
                <span style="color: #402e32;">EDIT USERS</a></span>
            </button>
            <br><br><br>
            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178; border-bottom-color: #4b8178; font-family: 'Noto Serif Display', serif; font-weight: 300; font-size: 16px; outline: none;"><a class="nav-link" href="admin-change-products-info.php">
                <span style="color: #402e32;">EDIT PRODUCTS</a></span>
            </button>
            <br><br><br>
            <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-family: 'Noto Serif Display', serif;font-weight: 300;font-size: 16px; outline: none;"><a class="nav-link" href="admin-change-orders-info.php">
                <span style="color: #402e32;">EDIT ORDERS</a></span>
            </button>
            <br><br><br>
        </div>
        <footer>
            &copy DIVINE, 2022
        </footer>
    </body>
</html>
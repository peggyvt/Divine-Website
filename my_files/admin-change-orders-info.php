<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Orders</title>
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

            .orders {
                text-align: center;
                font-family: 'Noto Serif Display', serif;
                font-weight: 300;
            }
        </style>
        
        <?php 
            require 'vendor/autoload.php';
            session_start();
            $m = new MongoDB\Client("mongodb://127.0.0.1/");
            $db = $m->divinedb;
            $collection_orders = $db->orders;
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
                        <a class="nav-link" href="admin-change-products-info.php">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-change-orders-info.php">ORDERS</a>
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

        <div class="orders container">
            <?php 
                $num = $collection_orders->count();
                echo "<div class='num'>Total Orders: " . $num . "</div>";?>

            <table class="table">
                <tr>
                    <th>id</th>
                </tr>

                <?php 
                    $orders = $collection_orders->find(); ?>
                    <?php foreach ($orders as $order) {
                        $i = 0;
                        foreach ($order as $document) {
                            foreach ($document as $key=>$value) {?>
                                <tr>
                                    <?php if ($i == 0) {?>
                                            <td> <?php echo $value; ?></td>
                                            <td> <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#delete-order-Modal-<?php echo $value?>"><i class="fa fa-trash"></i></button></td>

                                            <div class="modal" id="delete-order-Modal-<?php echo $value?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">DELETE ORDER</h3>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <section class="Delete-Order-Form" text-align="center">
                                                            <form method='POST' action='delete-order.php'> 
                                                                <label class='delete-label' style="color: black;" for='id'>Are you sure you want to delete order with id:</label><br/>
                                                                <input type='text' id='id' style="border: none; width: 220px;" name='id' value='<?php echo $value?>' readonly aria-label='product id'>?<br/>
                                                                <input type='submit' id='delete-product-details-btn' style="margin: 15px;" aria-label='delete product details button' name='delete-product-details-btn' value='YES'/>
                                                            </form>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr><br>
                                    <?php }
                                $i = 1;
                                break;
                            } ?>
                        <?php } ?>
                    <?php } ?>
            </table>
        </div>

        <footer>
            &copy DIVINE, 2022
        </footer>
    </body>
</html>
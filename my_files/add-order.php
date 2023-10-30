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

    </head>
    <body>
        <header>
            <table width="800px" align="center">
                <tr align="center">
                    <td>
                        <a href="home.php"><img src="images/logo.png" width="166.3px" height="83.67px" align="center"></a> <br>
                        <font size=small color="white">DIVINE</font>
                        <font color=#ad873a><small>..divine scents for divine people</small></font>
                        <br><br>
                    </td>
                </tr>
            </table>
        </header>
        <nav class="mx-auto">
            <div class="container">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">OUR COLLECTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">INSPIRATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">GALLERY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ACCOUNT</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
            require 'vendor/autoload.php';
            session_start();

            $m = new MongoDB\Client("mongodb://127.0.0.1/");
            $db = $m->divinedb;
            $collection_users = $db->users;
            $collection_products = $db->products;
            $collection_orders = $db->orders;

            /*$name = $_POST['name'];
            $price = $_POST['price'];
            $availability = $_POST['availability'];
            $collection = $_POST['collection'];
            $img = $_POST['img'];

            //img name price quantity colour

            $user = $_SESSION['user'];
            foreach($user->cart as $product) {
                $document = array (
                    "img" => "$product->img",
                    "name" => "$product->name",
                    "price" => "$product->price", 
                    "quantity" => "$product->quantity",
                    "colour" => "$product->colour");
                $user_cart = array ($document);
            }

            $collection_orders->insertOne($user_cart);*/
            $user1 = $_SESSION['user'];
            $user = $collection_users->findOne(array('email'=> $_SESSION['email']));
            echo $user->first_name;
            $user_email = $user->email;
            $document = array();  
            array_push($document, ["user_email" => $user_email]);
            $cart = $user->cart;
            $total = 0;
            foreach ($cart as $product) {  
                $product_name = $product->name;
                $product_price = $product->price;
                $product_quantity = $product->quantity;
                $product_colour = $product->colour;
                $total = $total + $product_price*$product_quantity;
                
                $product1 = $collection_products->findOne(array('name' => $product_name));
                $product1_availability = $product1->availability;
                $new_availability = $product1_availability - $product_quantity;
                $collection_products->UpdateOne(["name" => $product_name], [ '$set' => ['availability' => $new_availability]]);

                $array1 = array (
                    "name" => "$product_name",
                    "price" => "$product_price",
                    "quantity" => "$product_quantity", 
                    "colour" => "$product_colour");
                array_push($document, $array1); 
            } 
            array_push($document, ["total_price" => $total]);
            $array = (array)$user->orders;
            array_push($array, $document);

            $collection_users->UpdateOne(["email" => $user->email], [ '$set' => ['orders' => $array]]);
            $collection_users->UpdateOne(["email" => $user->email], [ '$set' => ['cart' => [] ]]); 

            $collection_users->UpdateOne(["email" => $user->email], [ '$set' => ['orders' => $array]]);
            
            $collection_orders->insertOne([ "order" => $document]);
            
            header("Location: home.php");
        ?>
    </body>
</html>
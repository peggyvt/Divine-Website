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
            $collection_products = $db->products;

            $name = $_POST['name'];
            $price = $_POST['price'];
            $availability = $_POST['availability'];
            $collection = $_POST['collection'];
            $img = $_POST['img'];

            $product = $collection_products->findOne(array('name' => $name));
            if($product == null) {
                $document = array (
                    "name" => "$name",
                    "price" => "$price",
                    "availability" => "$availability", 
                    "collection" => "$collection",
                    "img" => "$img");
                $collection_products->insertOne($document);
            } else {
                echo "A product with that name already exists!";
            }
            header("Location: admin-change-products-info.php");
        ?>
    </body>
</html>
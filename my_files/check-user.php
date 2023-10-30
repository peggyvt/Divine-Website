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
                        <a class="nav-link" href="home.php">HOME</a>
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
            echo "Connected successfully!<br><br>";

            $db = $m->divinedb;
            echo "Database 'divinedb' created successfully!<br><br>";

            $collection = $db->users;
            echo "Collection 'users' created successfully!<br><br>";

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $collection->findOne(array('email' => $email, 'password' => $password));
            if($user == null) {
                echo "Email doesn't exist!";
                $user = $collection->findOne(['email' => 'guest']);
                $_SESSION['email'] = 'guest';
                $_SESSION['user'] = $user;
                header("Location:home.php");
            } else {
                echo "User sign-in successful!";
                $user = $collection->findOne(array('email' => $email, 'password' => $password));
                $_SESSION['log'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user'] = $user;
                if($_SESSION['email'] == "admin@gmail.com") {
                    header("Location:admin-home.php");
                } else {
                    header("Location:account.php");
                }
            }
        ?>
    </body>
</html>
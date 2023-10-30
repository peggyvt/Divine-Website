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

        <?php
            session_start();
        ?>
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
            //session_start();
            $m = new MongoDB\Client("mongodb://127.0.0.1/");
            echo "Connected successfully!<br><br>";

            $db = $m->divinedb;
            echo "Database 'divinedb' created successfully!<br><br>";

            $collection = $db->users;
            echo "Collection 'users' created successfully!<br><br>";

            $name = $_POST['first_name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $collection->updateOne(array("email"=>$email), array('$set'=>array("first_name"=>$name, "surname"=>$surname, "email"=>$email, "password"=>$password, "confirm_password"=>$password)));
    
            if(!(isset($_SESSION['email']) && $_SESSION['email'] == 'admin@gmail.com')) {
                $_SESSION['email'] = $email;
                header("Location:account.php");
            } else {
                $_SESSION['email'] = 'admin@gmail.com';
                header("Location:admin-change-users-info.php");
            }

            //echo '<script>window.location.replace("account.php");</script>';
            /*if ($name != $_SESSION['first_name']) {
                $user = $collection->updateOne(array('first_name' => $_SESSION['first_name']));
                $_SESSION['first_name'] = $name;
                $_SESSION['user'] = $user;
            }
            if ($surname != $_SESSION['surname']) {
                $user = $collection->updateOne(array('surname' => $surname));
                $_SESSION['surname'] = $surname;
                $_SESSION['user'] = $user;
            }
            if ($email != $_SESSION['email']) {
                $user = $collection->updateOne(array('email' => $email));
                $_SESSION['email'] = $email;
                $_SESSION['user'] = $user;
            }
            if ($password != $_SESSION['password']) {
                $user = $collection->updateOne(array('password' => $password));
                $_SESSION['password'] = $password;
                $_SESSION['user'] = $user;
            }*/

            //$user = $collection->updateOne(array('email' => $email), array('$set'=>(array(''))));
            /*if($user == null) {
                echo "Email doesn't exist!";
                header("Location:home.php");
            } else {
                echo "User sign-in successful!";
                header("Location:account.php");
            }*/
        ?>
    </body>
</html>
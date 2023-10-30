<!DOCTYPE html>
<html>
    <head>
        <title>DIVINE | Users</title>
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

            .users {
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
            $collection_users = $db->users;
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
                        <a class="nav-link active" href="admin-change-users-info.php">USERS</a>
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

        <div class="users container">
            <?php 
                $num = $collection_users->count() - 2; //exclude admin and guest
                echo "<div class='num'>Total Users: " . $num . "</div>";?>

            <table class="table">
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>surname</th>
                    <th>email</th>
                    <th>password</th>
                </tr>

                <?php 
                    $users = $collection_users->find(); ?>
                    <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:120px; outline: none;" type="button" data-toggle="modal" data-target="#add-user-Modal"><i class="fa fa-user"> Add new user</i></button>
                    <?php foreach ($users as $user) {
                        if (!str_contains($user->email, 'admin') AND ($user->email != "guest")) { ?>
                            <tr>
                                <td> <?php echo $user->_id; ?></td>
                                <td> <?php echo $user->first_name; ?></td>
                                <td> <?php echo $user->surname; ?></td>
                                <td> <?php echo $user->email; ?></td>
                                <td> <?php echo $user->password; ?></td>
                                <td> <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#edit-user-Modal-<?php echo $user->_id?>"><i class="fa fa-edit"></i></button></td>
                                <td> <button style="background-color: #dfe0df;color: #674335; border-right-color: #4b8178;border-bottom-color: #4b8178;font-size: 16px; width:30px; outline: none;" type="button" data-toggle="modal" data-target="#delete-user-Modal-<?php echo $user->_id?>"><i class="fa fa-trash"></i></button></td>
                            </tr><br>
                        <?php } ?>

                        <div class="modal" id="edit-user-Modal-<?php echo $user->_id?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">UPDATE USER</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <section class="Update-Form" text-align="center">
                                        <form method='POST' action='update-user.php'> 
                                            <label class='first_name-label' for='first_name'>FIRST NAME</label><br/>
                                            <input type='text' id='first_name' name='first_name' value='<?php echo $user->first_name; ?>' aria-label='first name' pattern='\S+.*'><br/>
                                            
                                            <label class='surname-label' for='surname'>SURNAME</label><br/>
                                            <input type='text' id='surname' name='surname' value='<?php echo $user->surname; ?>' aria-label='surname' pattern='\S+.*'><br/>

                                            <label class='email-label-2' for='email'>EMAIL</label><br/>
                                            <input type='text' id='email' name='email' value='<?php echo $user->email; ?>' aria-label='email' readonly pattern='\S+.*'><br/>

                                            <label class='password-label-2' for='password'>PASSWORD</label><br/>
                                            <input type='text' id='password' name='password' value='<?php echo $user->password; ?>' aria-label='password' readonly pattern='[A-Za-zΑ-Ωα-ω]{0, 20}'><br/>
                                            
                                            <input type='submit' id='update-user-details-btn' aria-label='update user details button' class='update-user-details-btn' value='UPDATE'/>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="delete-user-Modal-<?php echo $user->_id?>" class="delete-user">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">DELETE USER</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <section class="Delete-Form" text-align="center">
                                        <form method='POST' action='delete-user.php'> 
                                            <label class='delete-label' style="color: black;" for='email'>Are you sure you want to delete user with email:</label><br/>
                                            <input type='text' id='email' style="border: none; width: 180px;" name='email' value='<?php echo $user->email;?>' readonly aria-label='user email'>?<br/>
                                            
                                            <input type='submit' id='delete-user-details-btn' style="margin: 15px;" aria-label='delete user details button' name='delete-user-details-btn' value='YES'/>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </table>
            
            
            <div class="modal" id="add-user-Modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">ADD USER</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <section class="Sign-Up-Form" text-align="center">
                            <form method="POST" action="insert-users.php" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "passwords do not match" : "")'>
                                <label class="first_name-label" for="first_name">FIRST NAME</label><br/>
                                <input type="text" id="first_name" name="first_name" aria-label="first name" required title="please enter first name" required minlength="1" pattern="\S+.*"><br/>
                                
                                <label class="surname-label" for="surname">SURNAME</label><br/>
                                <input type="text" id="surname" name="surname" aria-label="surname" required title="please enter surname" required minlength="1" pattern="\S+.*"><br/>

                                <label class="email-label-2" for="email">EMAIL</label><br/>
                                <input type="email" id="email" name="email" required title="please enter ur email"><br/>
                                
                                <label class="password-label-2" for="password">PASSWORD</label><br/>
                                <input type="password" id="password" name="password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please enter password"><br/>
                                
                                <label class="confirm_password-label" for="confirm_password">CONFIRM PASSWORD</label><br/>
                                <input type="password" id="confirm_password" name="confirm_password" required pattern="[A-Za-zΑ-Ωα-ω]{0, 20}" required title="please re-enter password"><br/>

                                <input type="submit" id="sign-up-btn" aria-label="sign up button" class="sign-up-btn" value="ADD NEW USER"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy DIVINE, 2022
        </footer>
    </body>
</html>
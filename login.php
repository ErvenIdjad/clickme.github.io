<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="loginstyle.css">
    <title>Login Page</title>
</head>

<?php
session_start();
?>

<body>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login</div>
            <div class="title signup">Signup</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
            <?php
               
                require_once 'dbconfig.php';
                $error = "";
                if(isset($_POST['login'])) {
                    $username = htmlentities($_POST['username']);
                    $password = htmlentities($_POST['password']);
                    $query = "SELECT id, username FROM users WHERE username = ? AND password = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // login success
                        mysqli_stmt_bind_result($stmt, $id, $username);
                        mysqli_stmt_fetch($stmt);
                        $_SESSION['logged-in'] = $id;
                        $_SESSION['username'] = $username;
                        header('location: logged.php');
                        
                    } 
                     else {
                        // login failed
                        $error = "Invalid username or password";
                    }
                }
            ?>


                <form action="login.php" class="login" method="POST">
                    <div class="field">
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login" name="login">
                    </div>
                    <div class="success"><span><?php $result ?></span></div>
                    <?php
                        if(isset($error)) {
                            echo "<span class='error'>".$error."</span>";
                        }
                    ?>
                </form>

                <?php

                if(isset($_POST['signup'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $success = "Signup successful";
                    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                    $result = mysqli_query($conn, $query);
                }
                ?>
                <form action="login.php" class="signup" method="POST">
                    <div class="field">
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup" name="signup">
                    </div>
                </form>
            </div>
        </div>
        
        <?php
    if(isset($_POST['signup'])) {
        echo "<span class='signup-success'>Signup Successful</span>";
    }
    ?>
    </div>




    <script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });
    </script>
</body>

</html>
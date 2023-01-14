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
    <link rel="stylesheet" href="style.css">
    <title>Click Me</title>
</head>


<body>

<?php
include_once('dbconfig.php');
session_start();
if (!isset($_SESSION['logged-in'])){
    header('location: index.php');
    exit;
}


$username = $_SESSION['username'];
$query = "SELECT clickcounts FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$current_click_count = mysqli_fetch_assoc($result)['clickcounts'];

if (isset($_GET['clicks'])) {
    $new_click_count = $current_click_count + 1;
    $query = "UPDATE users SET clickcounts = $new_click_count WHERE username = '$username'";
    mysqli_query($conn, $query);
}


?>


    <nav class="navbar navbar-expand-lg bg-body-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="logged.php">clickme</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="d-block" href="#" data-toggle="modal" data-target="#exampleModal">LEADERBOARDS</a>
                    </li>
                </ul>
                <form class="d-flex log" role="search">
                    <div class="dropdown">
                        <span class="usern " role="button" data-bs-toggle="dropdown"><i class="fa fa-user-ninja">
                            </i>&nbsp;<?php echo $_SESSION['username']; ?>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                            <a class="dropdown-item" href="logout.php"><span class="ml-2">Logout</span><i
                                        class="fas fa-sign-out-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <h4 class="hcount">Highest Click Counts: <?php echo $current_click_count; ?></span></h4>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Clicks Count:</h2>
                <h1 id="clicks">0</h1>
                <button class="btn" id="increment" onclick="clicked()">CLICK ME</button>
            </div>
        </div>
    </div>

    <script>
    let current_click_count = <?php echo $current_click_count; ?>;
    document.getElementById("clicks").innerHTML = current_click_count;

    function clicked() {
        current_click_count++;
        document.getElementById("clicks").innerHTML = current_click_count;
        // send the updated click count to the server
        fetch("?clicks=" + current_click_count);
    }
    </script>

    <?php include_once('leaderboard_modal.php') ?>

    <script src="app.js"></script>
</body>

</html>
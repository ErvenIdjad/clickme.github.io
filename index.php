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
    <title>Click Count</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">clickme</a>
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
                    <a class="btn btn-outline-success" href="login.php" type="submit">Join</a>
                </form>
            </div>
        </div>
    </nav>


    <h4 class="hcount">Highest Click Counts: <span id="highestCount">0</span></h4>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Clicks Count:</h2>
                <h1 id="clicks">0</h1>
                <button class="btn" id="increment" onclick="clicked()">CLICK ME</button>
            </div>
        </div>
    </div>
    <script src="app.js"></script>
    
    <script>
    let counts = document.querySelector("#clicks");
    let highestCount = document.querySelector("#highestCount");
    let count = 0;
    let highest = 0;

    function clicked() {
        count += 1;
        counts.innerHTML = count;
        if (count > highest) {
            highest = count;
            highestCount.innerHTML = highest;
        }
    }
    </script>

    <?php include_once('leaderboard_modal.php') ?>

</body>

</html>
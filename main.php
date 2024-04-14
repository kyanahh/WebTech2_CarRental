<?php

session_start();

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["username"])){
        $textaccount = $_SESSION["username"];
    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent Me Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="background-color: #fafcef;">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
                <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-list"></i></button>
                <div class="offcanvas offcanvas-start bg-dark text-white" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title ms-3 mt-3" id="offcanvasWithBothOptionsLabel">Rent Me Up</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start ms-3" id="menu">
                        <li class="nav-item">
                            <a href="/CaluntadAllenSizley/main.php" class="nav-link align-middle px-0 fw-bold" style="color: #FF4500;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/CaluntadAllenSizley/profile.php" class="nav-link align-middle px-0 fw-bold" style="color: #FF4500;">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="/CaluntadAllenSizley/book.php" class="nav-link align-middle px-0 fw-bold" style="color: #FF4500;">Book</a>
                        </li>
                        <li>
                            <a href="/CaluntadAllenSizley/aboutmain.php" class="nav-link px-0 align- fw-bold" style="color: #FF4500;">About</a>
                        </li>
                        <li>
                            <a href="/CaluntadAllenSizley/contactmain.php" class="nav-link px-0 align-middle fw-bold" style="color: #FF4500;">Contact Us</a>
                        </li>
                        <li>
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle px-4 mt-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php  echo $textaccount; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/CaluntadAllenSizley/logout.php">Logout</a></li>
                            </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                </div>

                <a href="/CaluntadAllenSizley/main.php" class="navbar-brand" style="font-family: Copperplate, fantasy;">
                    <img src="https://www.freepnglogos.com/uploads/zent-logo-png-car-22.png" height="28" alt="CoolBrand">
                RENT ME UP</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                </div>
        </nav>
    </div>
        
        
        <div class="container-fluid bg-image p-5 text-center-left" style="background-image: url('https://www.wallpaperup.com/uploads/wallpapers/2013/12/30/209337/a456723ed43e77560628bd8ace73076f-700.jpg'); 
    height: 100vh; background-repeat: no-repeat; background-position: center; background-size: cover;">
        <h1 class="fs-4 pt-5 fw-bold" style="padding-top: 50px;">Plan your trip now</h1>
        <h2 class="display-3 fw-bold mt-3">Rates so <span style="color: #FF4500;">low</span>,</h2>
        <h3 class="display-3 fw-bold">you won’t think twice</h3>
        <p class="mt-5" style="font-family: Helvetica, sans-serif;">We provide excellent service at an affordable price, demonstrating to our</p>
        <p class="" style="font-family:Helvetica, sans-serif;">customers that they received the best car rental value possible.</p>
        <p class="mt-5"><a href="/CaluntadAllenSizley/book.php" target="_blank" class="btn btn-lg me-2 fw-bold px-4 py-3" style="background-color: #FF4500;">Book Ride</a>
        </div>

    <hr>
    <footer>
        <div class="container-fluid row m-2">

            <div class="col-md-6">
                <p>Copyright &copy; 2023 Allen Sizley Caluntad</p>
            </div>

        </div>
    </footer>
</body>
</html>
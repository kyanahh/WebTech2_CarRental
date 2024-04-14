<?php

include("connection.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) == 1) {
        header('Location: signin.php');
        exit();
    } else if (mysqli_num_rows($result) == 0) {
        echo '<p class="text-danger">Incorrect email or password.</p>';
        exit();
    }
    
    mysqli_close($connection);
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
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #fafcef;">
            <div class="container-fluid">
                <a href="/CaluntadAllenSizley/landing.php" class="navbar-brand" style="font-family: Copperplate, fantasy;">
                <img src="https://www.freepnglogos.com/uploads/zent-logo-png-car-22.png" height="28" alt="CoolBrand">RENT ME UP</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <div class="navbar-nav">
                        <a href="/CaluntadAllenSizley/landing.php" class="nav-item nav-link active" style="font-weight: bold;">Home</a>
                        <a href="/CaluntadAllenSizley/about.php" class="nav-item nav-link active" style="font-weight: bold;">About</a>
                        <a href="/CaluntadAllenSizley/contact.php" class="nav-item nav-link active" style="font-weight: bold;">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="container-fluid bg-image p-5 text-center-left" style="background-image: url('https://www.wallpaperup.com/uploads/wallpapers/2013/12/30/209337/a456723ed43e77560628bd8ace73076f-700.jpg'); 
    height: 100vh; background-repeat: no-repeat; background-position: center; background-size: cover;">
            <h1 class="mt-5 ms-4">Log in</h1>
            <form method="POST" action="user.php" class="ms-4 w-50 mt-5">
                <div class="row">
                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email address" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                </div>                               
                <div class="ms-auto mt-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn fw-bold p-2 text-white" href="/CaluntadAllenSizley/main.php" value="submit" style="background-color: #FF4500;">Sign in</button>
                        <p class="text-center">Do not have an account yet? <a href="/CaluntadAllenSizley/register.php" class="text-center mt-1 mb-0 text-decoration-none">Register here.</a></p>    
                    </div>
                </div>
            </form>
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
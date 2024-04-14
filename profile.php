<?php

session_start();

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["username"]) && ($_SESSION["lastname"] && ($_SESSION["email"]))){
        $textaccount = $_SESSION["username"];
        $lastname = $_SESSION["lastname"];
        $email = $_SESSION["email"];
    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["email"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $result = $connection->query("SELECT password FROM user WHERE email = '$email'");
    $record = $result->fetch_assoc();
    $stored_password = $record["password"];
    if ($old_password == $stored_password) {
      $connection->query("UPDATE user SET password = '$new_password' WHERE email = '$email'");
      $_SESSION["success_message"] = "Password changed successfully";
    } else {
      $_SESSION["error_message"] = "Old password does not match";
    }
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
            <div class="card" style="width: 700px">
                <div class="card-body">
                    <?php
                    if (!empty($errorMessage)) {
                        echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    ?>
                    <h1 class="mt-2 ms-4">Profile</h1>
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>" class="mx-4 mt-4">
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" value="<?php echo $textaccount; ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email address" name="email" value="<?php echo $email; ?>" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <input type="password" class="form-control" name="new_password" placeholder="New Password">
                            </div>
                            <?php
                                if (isset($_SESSION["success_message"])) {
                                    echo "<label>" . $_SESSION["success_message"] . "</label>";
                                    unset($_SESSION["success_message"]);
                                } elseif (isset($_SESSION["error_message"])) {
                                    echo "<label>" . $_SESSION["error_message"] . "</label>";
                                    unset($_SESSION["error_message"]);
                                }
                                ?>
                        </div>
                        <div class="row">
                        <div class="ms-auto mt-3">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn fw-bold p-2 text-white" href="/CaluntadAllenSizley/main.php" value="Submit" style="background-color: #FF4500;">Save Changes</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
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
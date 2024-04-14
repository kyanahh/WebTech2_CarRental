<?php

include("connection.php");

$firstname  = $lastname = $email = $password = $errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        $errorMessage = "All fields are required";
    } else {
        $result = $connection->query("INSERT INTO user (firstname, lastname, email, password) VALUES('$firstname', '$lastname', '$email', '$password')");

        if (!$result) {
            $errorMessage = "Invalid query " . $connection->error;
        } else {
            $successMessage = "Client added successfully";
            header("location: /CaluntadAllenSizley/signin.php");
            exit;
        }
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
                    <h1 class="mt-2 ms-4">Create an Account</h1>
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>" class="mx-4 mt-4">
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email address" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $password; ?>">
                            </div>
                        </div>                               
                        <div class="ms-auto mt-3">
                            <div class="d-grid gap-2">
                                <?php
                                if (!empty($successMessage)) {
                                    echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                    ";
                                }
                                ?>
                                <button type="submit" class="btn fw-bold p-2 text-white" href="/CaluntadAllenSizley/signin.php" value="Submit" style="background-color: #FF4500;">Register</button>
                                <p class="text-center">Already have an account? <a href="/CaluntadAllenSizley/signin.php" class="text-center mt-1 mb-0 text-decoration-none">Sign in here.</a></p>    
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
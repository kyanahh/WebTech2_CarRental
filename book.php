<?php

include("connection.php");

session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("location: signin.php");
    exit();
}

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

$username = $_SESSION["username"];
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

if (empty($email)) {
    $errorMessage = "Email parameter is missing.";
} else {
    $sql = "SELECT user.firstname, rent.type, rent.brand, rent.rentdate
    FROM rent
    INNER JOIN user ON rent.userid = user.userid
    WHERE user.firstname = '$username'";
}

// Retrieve the user's bookings
$sql = "SELECT rent.rentid, user.firstname, rent.type, rent.brand, rent.rentdate
        FROM rent 
        INNER JOIN user ON rent.userid = user.userid
        WHERE user.firstname = '$username'";

$result = mysqli_query($connection, $sql);

$type = $brand = $rentdate = $successMessage = $errorMessage = "";

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = mysqli_real_escape_string($connection, $_POST["type"]);
    $brand = mysqli_real_escape_string($connection, $_POST["brand"]);
    $rentdate = mysqli_real_escape_string($connection, $_POST["rentdate"]);


    // Check if any field is empty
    if (empty($type) || empty($brand) || empty($rentdate)) {
        $errorMessage = "All fields are required";
    } else {
        // Retrieve the loginid based on the username
        $username = $_SESSION['username'];
        $query = "SELECT userid FROM user WHERE firstname = '$username'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $userid = $row['userid'];

        // Insert the booking into the database
        $book = "INSERT INTO rent (userid, type, brand, rentdate) 
                    VALUES ('$userid', '$type', '$brand', '$rentdate')";
        if (mysqli_query($connection, $book)) {
            $_SESSION["success_message"] = "Booking added successfully";
            header("location: book.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Error: " . mysqli_error($connection);
        }
    }
}

// Handle delete button click
if(isset($_POST['delete'])) {
    $rentid = mysqli_real_escape_string($connection, $_POST['rentid']);

    // Delete booking from database
    $sql = "DELETE FROM rent WHERE rentid='$rentid'";
    if(mysqli_query($connection, $sql)) {
        $_SESSION['success_message'] = "Booking deleted successfully";
        header("location: book.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error deleting booking: " . mysqli_error($connection);
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
            <div class="card p-5 mt-5" style="width: 500px">
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
                    <h1>Book</h1>
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">
                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <label class="form-label" for="type">Seat Type</label>
                                <select class="form-select" name="type" id="type" value="<?php echo $type; ?>">
                                    <option selected>Please Choose Seat Type</option>
                                    <option value="2-seater">2-seater</option>
                                    <option value="4-seater">4-seater</option>
                                    <option value="8-seater">8-seater</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <label class="form-label" for="brand">Brand</label>
                                <select class="form-select" name="brand" id="brand" value="<?php echo $brand; ?>">
                                    <option selected>Please Choose Car Brand</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Honda">Kia</option>
                                    <option value="Ford">Ford</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <label class="form-label" for="rentdate">Rent Date</label>
                                <input class="form-control" name="rentdate" id="rentdate" placeholder="YYYY-MM-DD" value="<?php echo $rentdate; ?>">
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
        <hr class="my-5">
        <div class="container-fluid mt-3">
        <div class="card mx-5" style="height: 500px;">
            <div class="card-body p-3 mx-4">
                <h1 class="h4 my-5">Booking History</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-label col-sm-3" id="myInput" onkeyup="myFunction()" placeholder="Search">
                    </div>
                </div>
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table text-center" id="myTable">
                        <thead>
                            <tr>
                                <th>Seat Type</th>
                                <th>Brand</th>
                                <th>Rent Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row['type'] . "</td><td>" . $row['brand'] . "</td><td>" . $row['rentdate'] . "</td><td>
                                    <form method='POST'>
                                        <input type='hidden' name='rentid' value='" . $row['rentid'] . "'>
                                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>Delete</button>
                                        
                                        <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                          <div class='modal-dialog'>
                                            <div class='modal-content'>
                                              <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>Confirm Delete</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                              </div>
                                              <div class='modal-body'>
                                                Are you sure you want to delete this booking?
                                              </div>
                                              <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>
                                  </td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <footer>
        <div class="container-fluid row m-2">
            <div class="col-md-6">
                <p>Copyright &copy; 2023 Allen Sizley Caluntad</p>
            </div>
        </div>
    </footer>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                var display = false;
                // Loop through all table columns, and check if any column matches the search query
                for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    display = true;
                    break;
                    }
                }
                }
                // Set the row display style based on whether any column matches the search query
                if (display) {
                tr[i].style.display = "";
                } else {
                tr[i].style.display = "none";
                }
            }

            // If the search field is empty, show all rows
            if (filter.length === 0) {
                for (i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
                }
            }
        }


    </script>

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
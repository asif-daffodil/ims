<?php  
    session_start();
    include_once("db.php");
    if (isset($_SESSION['id'])) {
        # code...
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head></head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
<?php 
        if (isset($_POST['login'])) {
            $email = safuda($_POST['email']);
            $password = safuda($_POST['password']);
            if (empty($email)) {
                echo "<script>toastr.error('Email is Required')</script>";
            } else {
                # code...
                if (empty($password)) {
                    # code...
                    echo "<script>toastr.error('Password is Required')</script>";
                } else {
                    # code...
                    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        # code...
                        $row = mysqli_fetch_object($result);
                        if (password_verify($password, $row->pass)) {
                            # code...
                            $_SESSION['id'] = $row->id;
                            $_SESSION['name'] = $row->name;
                            $_SESSION['email'] = $row->email;
                            $_SESSION['gender'] = $row->gender;
                            $_SESSION['image'] = $row->image ?? "demopp.jpg";
                            $_SESSION['role'] = $row->role;
                            header("location: index.php");
                        } else {
                            # code...
                            echo "<script>toastr.error('Email or Password is Incorrect')</script>";
                        }
                    } else {
                        # code...
                        echo "<script>toastr.error('Email or Password is Incorrect')</script>";
                    }
                }
            }
        }
    ?>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-md-6 min-vh-100" style="background: url('https://source.unsplash.com/random?cat'); background-size: cover; background-position: center;">
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center">
                <h1 class="mb-4">Login</h1>
                <form method="post" action="">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $email ?? null ?>">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

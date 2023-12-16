<?php
session_start();
include('includes/config.php');
error_reporting(0);

if ($_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
    $email = $_POST['emailid'];
    $password = md5($_POST['password']);
    $recaptcha_secret = '6Lco5yUpAAAAAOcRdBB2VmG6k_CEEV216JeA2zln'; // Replace with your secret key
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
    ];

    $recaptcha_options = [
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data),
        ],
    ];

    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_json = json_decode($recaptcha_result, true);

    if (!$recaptcha_json['success']) {
        echo "<script>alert('CAPTCHA verification failed. Please try again.');</script>";
    } else {
        // Continue with the rest of your login logic
        $sql = "SELECT student_email, student_password, student_id, status FROM students WHERE student_email=:email AND student_password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $_SESSION['stdid'] = $result->student_id;
        
                if (strcasecmp($result->student_password, md5($_POST['password'])) === 0) {
                    // Passwords match
                    if ($result->status == 1) {
                        $_SESSION['login'] = $_POST['emailid'];
                        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                    } else {
                        echo "<script>alert('Your account is currently blocked. Contact the admin to seek help.');</script>";
                    }
                } else {
                    // Passwords do not match
                    echo "<script>alert('Invalid details.');</script>";
                }
            }
        } else {
            echo "<script>alert('Invalid details.');</script>";
        }        
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Library Management System | User Login</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- FAVICON -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icons8-book-ios-16-filled-16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icons8-book-ios-16-filled-32.png">
    <link rel="icon" type="image/png" href="assets/img/icons8-book-ios-16-filled-16.png">
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!-- MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">USER LOGIN</h4>
                </div>
            </div>
            <!--LOGIN PANEL START-->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            LOGIN FORM
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="emailid" required autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" required autocomplete="off" />
                                    <p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
                                </div>
                                <!-- reCAPTCHA -->
                                <div class="g-recaptcha" data-sitekey="6Lco5yUpAAAAAHhIP3L652PN_WlyLcnB7Qpaz4w_" style="margin-bottom: 15px;"></div>

                                <button type="submit" name="login" class="btn btn-info">LOGIN</button> | <a href="signup.php">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---LOGIN PANEL END-->
        </div>
    </div>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>

</html>
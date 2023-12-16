<?php
session_start();
error_reporting(0);
include('includes/config.php');

if ($_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
    $email = $_POST['student_email'];
    $student_password = md5($_POST['student_password']);

    $sql = "SELECT student_email, student_password, student_id, status FROM students WHERE student_email=:email and student_password=:student_password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':student_password', $student_password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['stdid'] = $result->student_id;

            if ($result->status == 1) {
                $_SESSION['login'] = $_POST['student_email'];
                echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
            } else {
                echo "<script>alert('Your account is currently blocked. Contact the admin to seek help.');</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
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
    <title>Library Management System</title>
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

</head>
<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <!--Slider---->
            <div class="row">
                <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/img/1.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="assets/img/2.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="assets/img/3.jpg" alt="" />
                            </div>
                        </div>
                        <!--INDICATORS-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <!--PREVIOUS-NEXT BUTTONS-->
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row pad-botm">
                <!---LOGIN PANEL END-->
            </div>
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
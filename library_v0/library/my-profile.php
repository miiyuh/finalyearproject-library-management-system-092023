<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['stdid'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];
        $new_email = $_POST['new_email'];

        $sql = "UPDATE students SET student_name=:fname, student_phonenumber=:mobileno, student_email=:new_email WHERE student_id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':new_email', $new_email, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Your profile has been updated")</script>';
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Library Management System | Profile</title>
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
    <!-- MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">My Profile</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            My Profile
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post">
                                <?php
                                $sid = $_SESSION['stdid'];
                                $sql = "SELECT student_id, student_name, student_email, student_phonenumber, registration_date, updation_date, status FROM students WHERE student_id=:sid ";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                        <div class="form-group">
                                            <label>Student ID: </label>
                                            <?php echo htmlentities($result->student_id); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Registration Date: </label>
                                            <?php echo htmlentities($result->registration_date); ?>
                                        </div>
                                        <?php if ($result->updation_date != "") { ?>
                                            <div class="form-group">
                                                <label>Most Recent Profile Updation Date: </label>
                                                <?php echo htmlentities($result->updation_date); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label>Profile Status: </label>
                                            <?php if ($result->status == 1) { ?>
                                                <span style="color: green">Active</span>
                                            <?php } else { ?>
                                                <span style="color: red">Blocked</span>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Change Name</label>
                                            <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->student_name); ?>" autocomplete="off" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Change Phone Number</label>
                                            <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->student_phonenumber); ?>" autocomplete="off" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Change Email</label>
                                            <input class="form-control" type="email" name="new_email" id="new_email" value="<?php echo htmlentities($result->student_email); ?>" autocomplete="off" required />
                                        </div>
                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-primary" id="submit">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
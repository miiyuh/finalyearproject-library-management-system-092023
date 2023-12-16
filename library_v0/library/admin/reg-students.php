<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Code for blocking a student
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "UPDATE students SET status=:status WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }

    // Code for activating students
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE students SET status=:status WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Library Management System | Manage Registered Students</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                    <h4 class="header-line">Manage Registered Students</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registered Students
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Registration Date</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * from students";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->student_id); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->student_name); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->student_email); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->student_phonenumber); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->registration_date); ?></td>
                                                    <td class="center">
                                                        <?php
                                                        if ($result->status == 1) {
                                                            echo htmlentities("Active");
                                                        } else {
                                                            echo htmlentities("Blocked");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php
                                                        if ($result->status == 1) {
                                                        ?>
                                                            <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Deactivate this account?');">
                                                                <button class="btn btn-danger">Deactivate</button>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Reactivate this account?');">
                                                                <button class="btn btn-primary">Reactivate</button>
                                                            </a>
                                                        <?php } ?>

                                                        <a href="student-history.php?stdid=<?php echo htmlentities($result->student_id); ?>">
                                                            <button class="btn btn-success">Details</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $cnt = $cnt + 1;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Library Management System | User Dashboard</title>
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
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">USER DASHBOARD</h4>
                    </div>
                </div>

                <div class="row">
                    <a href="listed-books.php">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="alert alert-success back-widget-set text-center">
                                <i class="fa fa-book fa-5x"></i>
                                <?php
                                $sql = "SELECT id from books ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $listdbooks = $query->rowCount();
                                ?>
                                <h3><?php echo htmlentities($listdbooks); ?></h3>
                                Books Listed
                            </div>
                        </div>
                    </a>

                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-recycle fa-5x"></i>
                            <?php
                            $rsts = 0;
                            $sid = $_SESSION['stdid'];
                            $sql2 = "SELECT id from issued_book_details where student_id=:sid and (return_status=:rsts || return_status is null || return_status='')";
                            $query2 = $dbh->prepare($sql2);
                            $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
                            $query2->execute();
                            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                            $returnedbooks = $query2->rowCount();
                            ?>
                            <h3><?php echo htmlentities($returnedbooks); ?></h3>
                            Books Not Returned Yet
                        </div>
                    </div>

                    <a href="issued-books.php">
    <div class="col-md-4 col-sm-4 col-xs-6">
        <div class="alert alert-success back-widget-set text-center">
            <i class="fa fa-book fa-5x"></i>
            <?php
            $returnedStatus = 'Returned'; // Add this variable to represent the 'Returned' status
            $sid = $_SESSION['stdid'];
            $sql2 = "SELECT id FROM issued_book_details WHERE student_id=:sid AND return_status=:returnedStatus";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query2->bindParam(':returnedStatus', $returnedStatus, PDO::PARAM_STR);
            $query2->execute();
            $returnedbooks = $query2->rowCount();
            ?>
            <h3><?php echo htmlentities($returnedbooks); ?></h3>
            Previously Issued Books
        </div>
    </div>
</a>

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
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
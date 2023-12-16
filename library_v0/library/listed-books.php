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
        <title>Library Management System | Issued Books</title>
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
                        <h4 class="header-line">Listed Books</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Listed Books
                            </div>
                            <div class="panel-body">
                                <?php
                                $sql = "SELECT books.book_name,book_categories.category_name,authors.author_name,books.isbn_number,books.book_price,books.id as book_id,books.book_image,books.is_issued from  books join book_categories on book_categories.id=books.category_id join authors on authors.id=books.author_id";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                        <div class="col-md-4" style="float:left; height:300px;">
                                            <img src="admin/book_img/<?php echo htmlentities($result->book_image); ?>" width="100">
                                            <br /><b><?php echo htmlentities($result->book_name); ?></b><br />
                                            <?php echo htmlentities($result->category_name); ?><br />
                                            <?php echo htmlentities($result->author_name); ?><br />
                                            <?php echo htmlentities($result->isbn_number); ?><br />
                                            <?php if ($result->is_issued == '1') : ?>
                                                <p style="color:red;">Book unavailable. Unable to borrow this book.</p>
                                            <?php endif; ?>
                                        </div>
                                <?php $cnt = $cnt + 1;
                                    }
                                } ?>
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
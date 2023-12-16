<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1;
        $book_id = $_POST['book_id'];
        $sql = "UPDATE issued_book_details SET fine=:fine, return_status=:rstatus WHERE id=:rid;
                UPDATE books SET is_issued=0 WHERE id=:book_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->bindParam(':book_id', $book_id, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Book returned successfully";
        header('location:manage-issued-books.php');
    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Library Management System | Issued Book Details</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://www.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- FAVICON -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icons8-book-ios-16-filled-16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icons8-book-ios-16-filled-32.png">
        <link rel="icon" type="image/png" href="assets/img/icons8-book-ios-16-filled-16.png">
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'student_id=' + $("#student_id").val(),
                    type: "POST",
                    success: function (data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {}
                });
            }

            // function for book details
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'book_id=' + $("#book_id").val(),
                    type: "POST",
                    success: function (data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>
    </head>
    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Issued Book Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Issued Book Details
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <?php
                                    $rid = intval($_GET['rid']);
                                    $sql = "SELECT students.student_id, students.student_name, students.student_email, students.student_phonenumber, books.book_name, books.isbn_number, issued_book_details.issued_date, issued_book_details.return_date, issued_book_details.id as rid, issued_book_details.fine, issued_book_details.return_status, books.id as bid, books.book_image FROM issued_book_details JOIN students ON students.student_id = issued_book_details.student_id JOIN books ON books.id = issued_book_details.book_id WHERE issued_book_details.id=:rid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            ?>
                                            <input type="hidden" name="book_id" value="<?php echo htmlentities($result->bid); ?>">
                                            <h4>Student Details</h4>
                                            <hr />
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Student ID:</label>
                                                    <?php echo htmlentities($result->student_id); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Student Name:</label>
                                                    <?php echo htmlentities($result->student_name); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Student Email:</label>
                                                    <?php echo htmlentities($result->student_email); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Student Phone Number:</label>
                                                    <?php echo htmlentities($result->student_phonenumber); ?>
                                                </div>
                                            </div>
                                            <h4>Book Details</h4>
                                            <hr />
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Book Image:</label>
                                                    <img src="book_img/<?php echo htmlentities($result->book_image); ?>" width="120">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Book Name:</label>
                                                    <?php echo htmlentities($result->book_name); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ISBN:</label>
                                                    <?php echo htmlentities($result->isbn_number); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Book Issued Date:</label>
                                                    <?php echo htmlentities($result->issued_date); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Book Returned Date:</label>
                                                    <?php
                                                    if ($result->return_date == "") {
                                                        echo htmlentities("Book Not Returned Yet");
                                                    } else {
                                                        echo htmlentities($result->return_date);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Fine (MYR) :</label>
                                                    <?php
                                                    if ($result->fine == "") {
                                                        ?>
                                                        <input class="form-control" type="text" name="fine" id="fine" required />
                                                    <?php } else {
                                                        echo htmlentities($result->fine);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php if ($result->return_status == 0) { ?>
                                                <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>
                                            </div>
                                    <?php }
                                        }
                                    } ?>
                                </form>
                            </div>
                        </div>
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
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>
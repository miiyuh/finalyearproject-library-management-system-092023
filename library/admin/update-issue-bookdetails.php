<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['return'])) {
        $rid = isset($_GET['rid']) ? intval($_GET['rid']) : 0;
        $fine = $_POST['fine'];
        $rstatus = 1;
        
        $sql = "UPDATE issued_book_details SET fine = :fine, return_status = :rstatus WHERE id = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Book Returned successfully";
        header('location:manage-issued-books.php');
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
    <title>Library Management System | Issued Book Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script>
        // function for getting student name
        function getstudent() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "get_student.php",
                data: 'studentid=' + $("#studentid").val(),
                type: "POST",
                success: function (data) {
                    $("#get_student_name").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }

        // function for getting book details
        function getbook() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "get_book.php",
                data: 'bookid=' + $("#bookid").val(),
                type: "POST",
                success: function (data) {
                    $("#get_book_name").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
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
    <!-- MENU SECTION START-->
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
                                $sql = "SELECT students.student_name, books.book_name, books.isbn_number, issued_book_details.issues_date, issued_book_details.return_date, issued_book_details.id as rid, issued_book_details.fine, issued_book_details.return_status FROM issued_book_details JOIN students ON students.student_id = issued_book_details.student_id JOIN books ON books.id = issued_book_details.book_id WHERE issued_book_details.id = :rid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                        <div class="form-group">
                                            <label>Student Name:</label>
                                            <?php echo htmlentities($result->student_name); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Name:</label>
                                            <?php echo htmlentities($result->book_name); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN:</label>
                                            <?php echo htmlentities($result->isbn_number); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Issued Date:</label>
                                            <?php echo htmlentities($result->issues_date); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Returned Date:</label>
                                            <?php
                                            if ($result->return_date == "") {
                                                echo htmlentities("Not Returned Yet");
                                            } else {
                                                echo htmlentities($result->return_date);
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Fine (in MYR) :</label>
                                            <?php
                                            if ($result->fine == "") {
                                            ?>
                                                <input class="form-control" type="text" name="fine" id="fine" required />
                                            <?php } else {
                                                echo htmlentities($result->fine);
                                            }
                                            ?>
                                        </div>
                                        <?php if ($result->return_status == 0) { ?>
                                            <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>
                                        <?php } ?>
                                <?php
                                    } // Closing the foreach loop
                                } // Closing the if statement
                                ?>
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
<?php ?>

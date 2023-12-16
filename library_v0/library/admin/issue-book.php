<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['issue'])) {
        $student_id = strtoupper($_POST['student_id']);
        $book_id = $_POST['book_id'];
        $is_issued = 1;

        $sql = "INSERT INTO issued_book_details(student_id, book_id) VALUES(:student_id, :book_id);
                UPDATE books SET is_issued=:is_issued WHERE id=:book_id;";

        $query = $dbh->prepare($sql);
        $query->bindParam(':student_id', $student_id, PDO::PARAM_STR);
        $query->bindParam(':book_id', $book_id, PDO::PARAM_STR);
        $query->bindParam(':is_issued', $is_issued, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId) {
            $_SESSION['msg'] = "Book issued successfully";
            header('location:manage-issued-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-issued-books.php');
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
    <title>Library Management System | Issue Book To User</title>
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
    <script>
        // function for getting student name
        function getstudent() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "get_student.php",
                data:'student_id='+$("#student_id").val(),
                type: "POST",
                success:function(data){
                    $("#get_student_name").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }

        // function for getting book details
        function getbook() {
            $("#loaderIcon").show();
            var searchCriteria = $("#search_criteria").val();
            jQuery.ajax({
                url: "get_book.php",
                data: { 'book_id': $("#book_id").val(), 'search_criteria': searchCriteria },
                type: "POST",
                success:function(data){
                    $("#get_book_name").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
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
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Issue a New Book to User</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Issue a New Book
                        </div>

                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Student ID<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="student_id" id="student_id" onBlur="getstudent()" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span> 
                                </div>

                                <div class="form-group">
                                    <label>Search by:</label>
                                    <select class="form-control" id="search_criteria">
                                        <option value="isbn">ISBN Number</option>
                                        <option value="title">Book Title</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>ISBN Number or Book Title<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="book_id" id="book_id" onBlur="getbook()" required="required" />
                                </div>

                                <div class="form-group" id="get_book_name"></div>
                                <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
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

<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if(isset($_POST['update'])) {
        $book_name = $_POST['book_name'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $book_id = intval($_GET['book_id']);
        
        $sql = "UPDATE books SET book_name=:book_name, category_id=:category, author_id=:author, isbn_number=:isbn, book_price=:price WHERE id=:book_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':book_name', $book_name, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':book_id', $book_id, PDO::PARAM_STR);
        $query->execute();
        
        echo "<script>alert('Book information updated successfully');</script>";
        echo "<script>window.location.href='manage-books.php'</script>";
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
    <title>Library Management System | Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- 16x16 favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets\img\icons8-book-ios-16-filled-16.png">
    <!-- 32x32 favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets\img\icons8-book-ios-16-filled-32.png">
    <!-- Generic favicon (for browsers that don't support sizes attribute) -->
    <link rel="icon" type="image/png" href="assets\img\icons8-book-ios-16-filled-16.png">
</head>
<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Edit Book</h4>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Book Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $book_id = intval($_GET['book_id']);
                                $sql = "SELECT books.book_name, book_categories.category_name, book_categories.id as cid, authors.author_name, authors.id as athrid, books.isbn_number, books.book_price, books.id as book_id, books.book_image FROM books JOIN book_categories ON book_categories.id=books.category_id JOIN authors ON authors.id=books.author_id WHERE books.id=:book_id";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':book_id', $book_id, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book Image</label>
                                        <img src="book_img/<?php echo htmlentities($result->book_image);?>" width="100">
                                        <a href="change-bookimg.php?book_id=<?php echo htmlentities($result->book_id);?>">Change Book Image</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book Name<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="book_name" value="<?php echo htmlentities($result->book_name);?>" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Category<span style="color:red;">*</span></label>
                                        <select class="form-control" name="category" required="required">
                                            <option value="<?php echo htmlentities($result->cid);?>"><?php echo htmlentities($catname=$result->category_name);?></option>
                                            <?php
                                            $status = 1;
                                            $sql1 = "SELECT * FROM book_categories WHERE status=:status";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                            $query1->execute();
                                            $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                            
                                            if($query1->rowCount() > 0) {
                                                foreach($resultss as $row) {
                                                    if($catname == $row->category_name) {
                                                        continue;
                                                    } else {
                                            ?>
                                            <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->category_name);?></option>
                                            <?php }}} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Author<span style="color:red;">*</span></label>
                                        <select class="form-control" name="author" required="required">
                                            <option value="<?php echo htmlentities($result->athrid);?>"><?php echo htmlentities($athrname=$result->author_name);?></option>
                                            <?php
                                            $sql2 = "SELECT * FROM authors";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                            
                                            if($query2->rowCount() > 0) {
                                                foreach($result2 as $ret) {
                                                    if($athrname == $ret->author_name) {
                                                        continue;
                                                    } else {
                                            ?>
                                            <option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->author_name);?></option>
                                            <?php }}} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ISBN Number<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->isbn_number);?>" required />
                                        <p class="help-block">ISBN is the International Standard Book Number. It must be unique.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price (MYR)<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->book_price);?>" required />
                                    </div>
                                </div>

                                <?php }} ?>
                                
                                <div class="col-md-12">
                                    <button type="submit" name="update" class="btn btn-info">Update</button>
                                </div>
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

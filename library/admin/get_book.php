<?php
require_once("includes/config.php");

if (!empty($_POST["bookid"])) {
    $bookid = $_POST["bookid"];

    $sql = "SELECT book_name, id FROM books WHERE (isbn_number=:bookid)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            ?>
            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->book_name); ?></option>
            <b>Book Name :</b>
            <?php
            echo htmlentities($result->book_name);
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    } else {
        ?>
        <option class="others"> Invalid ISBN Number</option>
        <?php
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
}
?>
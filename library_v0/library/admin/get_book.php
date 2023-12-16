<?php 
require_once("includes/config.php");
if(!empty($_POST["book_id"])) {
  $book_id=$_POST["book_id"];
 
    $sql ="SELECT distinct books.book_name,books.id,authors.author_name,books.book_image,books.is_issued FROM books
join authors on authors.id=books.author_id
     WHERE (isbn_number=:book_id || book_name like '%$book_id%')";
$query= $dbh -> prepare($sql);
$query-> bindParam(':book_id', $book_id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0){
?>
<table border="1">

  <tr>
<?php foreach ($results as $result) {?>
    <th style="padding-left:5%; width: 10%;">
<img src="book_img/<?php echo htmlentities($result->book_image); ?>" width="120"><br />
      <?php echo htmlentities($result->book_name); ?><br />
    <?php echo htmlentities($result->author_name); ?><br />
    <?php if($result->is_issued=='1'): ?>
<p style="color:red;">Unavailable</p>
<?php else:?>
<input type="radio" name="book_id" value="<?php echo htmlentities($result->id); ?>" required>
<?php endif;?>
  </th>
    <?php  echo "<script>$('#submit').prop('disabled',false);</script>";
}
?>
  </tr>

</table>
</div>
</div>

<?php  
}else{?>
<p>Record not found. Please try again.</p>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
?>

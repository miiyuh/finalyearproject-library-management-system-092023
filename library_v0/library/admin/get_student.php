<?php
require_once("includes/config.php");

if(!empty($_POST["student_id"])) {
    $student_id = strtoupper($_POST["student_id"]);

    $sql = "SELECT student_name, status, student_email, student_phonenumber FROM students WHERE student_id=:student_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            if($result->status == 0) {
                echo "<span style='color:red'> Student is currently blocked. </span>" . "<br />";
                echo "<b>Student Name</b>" . htmlentities($result->student_name);
                echo "<script>$('#submit').prop('disabled',true);</script>";
            } else {
                echo htmlentities($result->student_name) . "<br />";
                echo htmlentities($result->student_email) . "<br />";
                echo htmlentities($result->student_phonenumber);
                echo "<script>$('#submit').prop('disabled',false);</script>";
            }
        }
    } else {
        echo "<span style='color:red'> Invalid Student ID. Please enter a valid Student ID.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
}
?>
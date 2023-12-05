<?php
require_once("includes/config.php");

if (!empty($_POST["studentid"])) {
    $studentid = strtoupper($_POST["studentid"]);

    $sql = "SELECT student_name, Status FROM students WHERE student_id=:studentid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            if ($result->status == 0) {
                echo "<span style='color:red'> Student ID Blocked </span>" . "<br />";
                echo "<b>Student Name-</b>" . $result->student_name;
                echo "<script>$('#submit').prop('disabled',true);</script>";
            } else {
                echo htmlentities($result->student_name);
                echo "<script>$('#submit').prop('disabled',false);</script>";
            }
        }
    } else {
        echo "<span style='color:red'> Invalid Student ID. Please enter a valid Student ID.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
}
?>
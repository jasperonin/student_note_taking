<?php

date_default_timezone_set('Asia/Kuala_lumpur');
include_once "../class/student.php";

$stamp = date("Y-m-d H:i:s");
$id = $_GET['id'];


$student = new Student;

$student -> updateTimestampIn($stamp,$id);

header("location: ../index.php");

?>
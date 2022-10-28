<?php

date_default_timezone_set('Asia/Kuala_lumpur');
include_once "../class/student.php";

$stamp = date("Y-m-d H:i:s");
$subject_name = $_POST['subject_name'];
$id = $_POST['student_id'];


$student = new Student;

$student -> insertSubject($id,$subject_name);

?>
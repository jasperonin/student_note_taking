<?php

include_once "../class/student.php";

$notes  = $_POST['notes'];
$id = $_POST['student_id'];

$student = new Student;

$student -> createNote($id, $notes);
header("location: ../index.php");

?>
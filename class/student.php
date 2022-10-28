<?php

require_once "database.php";

class Student extends Database {

    function getSubject() {
        $sql = "SELECT * FROM subjects";

        $result = $this->conn->query($sql);
        return $result;
    }

    function insertSubject($student_id,$subject_name) {
        $sql = "INSERT INTO student_tbl (id,`subject_name`) VALUES($student_id,'$subject_name')";

        if($this->conn->query($sql)) {
            header("location: ../index.php");
            exit;
        }
        else {
            die("ERROR!");
        }
    }

    function updateTimestampIn($stamp_in,$id) {
        $sql = "UPDATE student_tbl SET time_in = '$stamp_in' WHERE id = $id";

        $result = $this->conn->query($sql);
        return $result;
    }

    function updateTimestampOut($stamp_out,$id) {
        $sql = "UPDATE student_tbl SET time_out = '$stamp_out' WHERE id = $id";

        $result = $this->conn->query($sql);
        return $result;
    }

    function getStudent() {
        $sql = "SELECT * FROM student_tbl";

        $result = $this->conn->query($sql);
        return $result;
    }

    function getTotalTime($id,$stamp_out, $stamp_in) {
        $sql = "UPDATE student_tbl SET total_time = TIMEDIFF(time_out,time_in) WHERE id =$id";

        $result = $this->conn->query($sql);
        return $result;
    }

    function createNote($id,$notes) {
        $sql = "UPDATE student_tbl SET notes = '$notes' WHERE id =$id";

        $result = $this->conn->query($sql);
        return $result;
    }
}
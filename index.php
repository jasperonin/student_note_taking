<?php
session_start();
include_once "./class/student.php";
date_default_timezone_set('Asia/Kuala_lumpur');

$student = new Student;

$subject_details =  $student -> getSubject();
$student_details = $student->getStudent();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- JQUERY -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
    
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title h4">Student Info</h2>
                    </div>
                        <div class="card-body">
                            <div class=""><button type="button" name="add" id="add" class="btn btn-success mb-2 btn-xs d-inline-block">Add a Subject</button></<div>
                           <span><button class="btn btn-primary mb-2" name="note" id="note">Add a note</button></span>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Subject ID</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Total Study Hours</th>
                                            <th>Subject Name</th>
                                            <th></th>
                                            <th></th>
                                            <th>Notes</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                                while($student = $student_details->fetch_assoc()) {
                                                  ?>  
                                                  <tr>
                                                    <td> <?php echo $student['id'] ?> </td>
                                                    <td> <?php echo $student['time_in'] ?> </td>
                                                    <td> <?php echo $student['time_out'] ?> </td>
                                                    <td>
                                                       <?php echo $student['total_time'] ?>
                                                    </td>
                                                    <td> <?php echo $student['subject_name'] ?> </td>
                                                    <td> 
                                                        <a href="../students/action/updateTimeStamp.php?id=<?= $student['id'];?>" class="btn btn-secondary">
                                                        <i class="bi bi-arrow-down-circle"></i> Clock in
                                                        </a>
                                                    </td>
                                                    <td> 
                                                        <a href="../students/action/updateTimeStampOut.php?id=<?= $student['id'];?>" class="btn btn-warning">
                                                        <i class="bi bi-arrow-up-circle"></i> Clock out
                                                        </a>
                                                    </td>

                                                    <td class="text-wrap w-25 h-25">
                                                        <?php echo $student['notes'] ?>
                                                    </td>
                                                  
                                                  </tr>
                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 col-lg">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center h4">Current  Time</h2>         
                    </div>
                    <div class="card-body">
                        <div id="time" class="display-4 lead text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id = "modal" title="Add Subject">
            <div class="form-group">
                <form action="../students/action/create_subject.php" method="post"> 
                    <label for="student_id" class="form-label">ID</label>
                    <input type="text" name="student_id" id="student_id" class="form-control">
                    <label for="subject_name">Subject Name</label>
                    <select name="subject_name" id="subject_name" class="form-select">
                        <?php
                           
                            while($subjects = mysqli_fetch_array($subject_details)):;
                            ?>
                            <option name="subject_name" value="<?php echo $subjects['subject_name']; ?>">
                                <?php echo $subjects['subject_name']; ?>    
                            </option>
            
                    
                            
                       <?php
                       endwhile;
                       ?>
                    
                    </select>
                    <input type="submit" value="Save" class="btn btn-primary mt-2 w-100" name="save">
                </form>
                
            </div>
        </div>

        <div class="note-modal">
            <div class="form-group">
                <form action="../students/action/create_note.php" method="post">
                <input type="text" name="student_id" id="student_id" class="form-control mb-2" placeholder="Enter Student ID...">
                    <textarea name="notes" id="" cols="10" rows="5" class="form-control" placeholder="Add notes.."></textarea>
                    <input type="submit" value="Add Note" class="btn btn-outline-success mx-auto mt-2 p-3" name="btn_add_note">
                </form>
            </div>
        </div>


    </div>

</body>
</html>

<script>

    $(document).ready(function(){

        $('.note-modal').dialog({
            autoOpen: false,
            width: 700,
        });

        $('#note').click(function(){
            $('.note-modal').dialog('option','title','Add Notes');
            $('.note-modal').dialog('open'); 
        });
    });

    $(document).ready(function(){
        var count =0;

        $('#modal').dialog({
            autoOpen: false,
            width: 400
        });

        $('#add').click(function(){
            $('#modal').dialog('option','title','Add Subject');
            $('#modal').dialog('open');
        }); 

    });
    $(document).ready(function() {
  clockUpdate();
  setInterval(clockUpdate, 1000);
})

function clockUpdate() {
  var date = new Date();
  $('#time').css({'color': '#000', 'text-shadow': '0 0 6px #ff0'});
  function addZero(x) {
    if (x < 10) {
      return x = '0' + x;
    } else {
      return x;
    }
  }

  function twelveHour(x) {
    if (x > 12) {
      return x = x - 12;
    } else if (x == 0) {
      return x = 12;
    } else {
      return x;
    }
  }

  var h = addZero(twelveHour(date.getHours()));
  var m = addZero(date.getMinutes());
  var s = addZero(date.getSeconds());

  $('#time').text(h + ':' + m + ':' + s)
}
    



</script>
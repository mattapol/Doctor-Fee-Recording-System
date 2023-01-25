<?php include 'condb.php';

    $CODE_NAME = $_POST['code_name'];
    $NAME_TITLE= $_POST['name_title'];
    $NAME = $_POST['name'];
    $LAST_NAME = $_POST['last_name'];
    $W_DOCTOR = $_POST['w_doctor'];

    if($_GET['status'] != 'add') {

        $id = $_POST['ids'];

        $sql = "UPDATE name_doctor SET CODE_NAME='".$CODE_NAME."',
                                       NAME_TITLE='".$NAME_TITLE."',
                                       NAME='".$NAME."',
                                       LAST_NAME='".$LAST_NAME."',
                                       W_DOCTOR='".$W_DOCTOR."'
                                       WHERE ID='".$id."' ";
        
        if($connect->query($sql)==TRUE){
            echo "<script type='text/javascript'>";
            echo "window.location = 'show_doctor.php';";
            echo "alert('Updated Successfully')"; 
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'show_doctor.php';";
            echo "alert('Error back to edit again');";
            echo "</script>";
        }
    }
    else{
        $check = "SELECT * FROM name_doctor WHERE CODE_NAME = '$CODE_NAME' OR W_DOCTOR = '$W_DOCTOR'";

	    $checked = mysqli_query($connect, $check);
		
        $num = mysqli_num_rows($checked); 
        if($num > 0) {
             echo "<script>";
			 echo "alert('CODE_NAME OR W_DOCTOR already exists in the system. Please try again!');";
			 echo "window.history.back();";
          	 echo "</script>";
		}
        else{
            $sql = "INSERT INTO name_doctor (CODE_NAME, NAME_TITLE, NAME, LAST_NAME, W_DOCTOR)
                    VALUES ('$CODE_NAME', '$NAME_TITLE', '$NAME', '$LAST_NAME', '$W_DOCTOR')";
            
            $result = mysqli_query($connect, $sql);

            if ($result > 1){
                echo "<script type='text/javascript'>";
                echo "alert('Error!');";
                echo "window.location = 'form_doctor.php';";
            }
            else {
                echo "</script>";
                echo "<script type='text/javascript'>";
                echo "window.location = 'form_doctor.php';";
                echo "</script>";
            }
        }
    }
    $connect->close();
?>
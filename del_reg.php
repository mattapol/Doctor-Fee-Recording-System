<?php include 'condb.php';

    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if($id!='') {

        $sql = "DELETE FROM payroll_doctor WHERE RECORD='".$id."' ";

        if($connect->query($sql)==TRUE){
            echo "<script type='text/javascript'>";
            echo "window.location = 'show_regular.php';";
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'show_regular.php';";
            echo "alert('Error back to delete again');";
            echo "</script>";
        }
    }
    $connect->close();
?>
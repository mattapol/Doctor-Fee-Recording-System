<?php include 'condb.php';
    
    $CODE_NAME = $_POST['code_name'];
    $TIME1 = $_POST['time1'];
    $TIME2 = $_POST['time2'];
    $WORK= $_POST['work'];
    $OPD_SOCIAL = $_POST['opd_social'];
    $OPD_GENERA = $_POST['opd_genera'];
    $DOCTORFEE = $_POST['doctorfee'];
    $PT_NAME = $_POST['pt_name'];
    $DUTY = $_POST['duty'];
    $type_treat = $_POST['type'];
    $extra = $_POST['ex'];

    switch ($_GET['status']) {
        case "add" :
            $DATE = $_POST['date'];
            $num = $_POST['multiple'];
            
            for($i = 0; $i<$num; $i++) {
                $sql = "INSERT INTO payroll_doctor (DATE, CODE_NAME, TIME1, TIME2, WORK, OPD_SOCIAL, OPD_GENERA, DOCTORFEE, PT_NAME, DUTY, type_treat, extra)
                        VALUES ('$DATE', '$CODE_NAME', '$TIME1', '$TIME2', '$WORK', '$OPD_SOCIAL', '$OPD_GENERA', '$DOCTORFEE', '$PT_NAME', '$DUTY', '$type_treat', '$extra')";
                $result = mysqli_query($connect, $sql);
    
                if($result) {
                    echo "<script type='text/javascript'>";
                    echo "window.location = 'form_ot.php';";
                    echo "</script>";
                }
                else {
                    echo "<script type='text/javascript'>";
                    echo "alert('error!');";
                    echo "window.location = 'form_ot.php';";
                    echo "</script>";
                }
            }
            break;

        case "upd" :
            $DATE = $_POST['date'];
            $id = $_POST['record'];

            $sql = "UPDATE payroll_doctor SET DATE='".$DATE."', CODE_NAME='".$CODE_NAME."', TIME1='".$TIME1."', TIME2='".$TIME2."', WORK='".$WORK."', OPD_SOCIAL='".$OPD_SOCIAL."', OPD_GENERA='".$OPD_GENERA."', DOCTORFEE='".$DOCTORFEE."', PT_NAME='".$PT_NAME."' WHERE RECORD='".$id."' ";

            if($connect->query($sql)==TRUE) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_ot.php';";
                echo "alert('Updated Successfully')"; 
                echo "</script>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_ot.php';";
                echo "alert('Error back to edit again');";
                echo "</script>";
            }
            break;

        case "upd_user_ot" :
            $id = $_POST['record'];

            $sql = "UPDATE dataform_user SET CODE_NAME='".$CODE_NAME."', TIME1='".$TIME1."', TIME2='".$TIME2."', WORK='".$WORK."', OPD_SOCIAL='".$OPD_SOCIAL."', OPD_GENERA='".$OPD_GENERA."', DOCTORFEE='".$DOCTORFEE."', PT_NAME='".$PT_NAME."' WHERE RECORD='".$id."' ";

            if($connect->query($sql)==TRUE) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'form_ot.php';";
                echo "alert('Updated Successfully')"; 
                echo "</script>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'form_ot.php';";
                echo "alert('Error back to edit again');";
                echo "</script>";
            }
            break;

        default:
            $sql = "INSERT INTO dataform_user (CODE_NAME, TIME1, TIME2, WORK, OPD_SOCIAL, OPD_GENERA, DOCTORFEE, PT_NAME, DUTY)
                    VALUES ('$CODE_NAME', '$TIME1', '$TIME2', '$WORK', '$OPD_SOCIAL', '$OPD_GENERA', '$DOCTORFEE', '$PT_NAME', '$DUTY')";
            $result = mysqli_query($connect, $sql);

            if($result) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'form_user_ot.php';";
                echo "</script>";
            }
            else {
                echo "<script type='text/javascript'>";
                echo "alert('error!');";
                echo "window.location = 'form_user_ot.php';";
                echo "</script>";
            }
            break;
    }
    $connect->close();
?>
<?php include 'condb_original.php';

    $CODE_NAME = $_POST['code_name'];
    $WORK= $_POST['work'];
    $OPD_SOCIAL = $_POST['opd_social'];
    $OPD_GENERA = $_POST['opd_genera'];
    $SURGI_SOCI = $_POST['surgi_soci'];
    $SURGI_GENE = $_POST['surgi_gene'];
    $PT_NAME = $_POST['pt_name'];
    $DUTY = $_POST['duty'];
    $type_treat = $_POST['type'];
    $extra = $_POST['ex'];

    switch ($_GET['status']) {
        case "add" :
            $DATE = $_POST['date'];
            $num = $_POST['multiple'];

            for($i = 0; $i<$num; $i++) {
                $sql = "INSERT INTO payroll_doctor (DATE, CODE_NAME, WORK, OPD_SOCIAL, OPD_GENERA, SURGI_SOCI, SURGI_GENE, PT_NAME, DUTY, type_treat, extra)
                        VALUES ('$DATE', '$CODE_NAME', '$WORK', '$OPD_SOCIAL', '$OPD_GENERA', '$SURGI_SOCI', '$SURGI_GENE', '$PT_NAME', '$DUTY', '$type_treat', '$extra')";
                $result = mysqli_query($connect, $sql);

                if ($result){
                    echo "<script type='text/javascript'>";
                    echo "window.location = 'index.php';";
                    echo "</script>";
                }
                else {
                    echo "<script type='text/javascript'>";
                    echo "alert('Error!');";
                    echo "window.location = 'index.php';";
                    echo "</script>";
                }
            }
            break;
        
        case "upd" :
            $DATE = $_POST['date'];    
            $id = $_POST['record'];

            $sql = "UPDATE payroll_doctor SET DATE='".$DATE."', CODE_NAME='".$CODE_NAME."', WORK='".$WORK."', OPD_SOCIAL='".$OPD_SOCIAL."', OPD_GENERA='".$OPD_GENERA."', SURGI_SOCI='".$SURGI_SOCI."', SURGI_GENE='".$SURGI_GENE."', PT_NAME='".$PT_NAME."' WHERE RECORD='".$id."' ";

            if($connect->query($sql)==TRUE){
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_regular.php';";
                echo "alert('Updated Successfully')"; 
                echo "</script>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_regular.php';";
                echo "alert('Error back to edit again');";
                echo "</script>";
            }
            break;

        case "upd_user_reg" :
            $id = $_POST['record'];
    
            $sql = "UPDATE dataform_user SET CODE_NAME='".$CODE_NAME."', WORK='".$WORK."', OPD_SOCIAL='".$OPD_SOCIAL."', OPD_GENERA='".$OPD_GENERA."', SURGI_SOCI='".$SURGI_SOCI."', SURGI_GENE='".$SURGI_GENE."', PT_NAME='".$PT_NAME."' WHERE RECORD='".$id."' ";
    
            if($connect->query($sql)==TRUE) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'index.php';";
                echo "alert('Updated Successfully')"; 
                echo "</script>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'index.php';";
                echo "alert('Error back to edit again');";
                echo "</script>";
            }
            break;

        default:
            $sql = "INSERT INTO dataform_user (CODE_NAME, WORK, OPD_SOCIAL, OPD_GENERA, SURGI_SOCI, SURGI_GENE, PT_NAME, DUTY)
                    VALUES ('$CODE_NAME', '$WORK', '$OPD_SOCIAL', '$OPD_GENERA', '$SURGI_SOCI', '$SURGI_GENE', '$PT_NAME', '$DUTY')";
            $result = mysqli_query($connect, $sql);

            if($result) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'form_user_reg.php';";
                echo "</script>";
            }
            else {
                echo "<script type='text/javascript'>";
                echo "alert('error!');";
                echo "window.location = 'form_user_reg.php';";
                echo "</script>";
            }
            break;
    } 
    $connect->close();
?>
<?php include 'condb.php';

    $di_details_treat = $_POST['details_treat'];
    $di_id_doctor = $_POST['code_name'];
    $di_date_acp = $_POST['date_admin'];
    $di_service_charge = $_POST['service_charge'];
    $di_ssp = $_POST['ssp'];
    $di_cash = $_POST['cash'];
    $di_name_patient = $_POST['name_patient'];
    $di_HN = $_POST['hn'];
    $di_right = $_POST['right'];
    $di_id_bill = $_POST['bill'];
    $di_type_doctor = $_POST['duty'];
    $di_type_file = $_POST['ex'];

    switch ($_GET['status']) {
        case "add" :
            $di_date_df_doctor = $_POST['date'];
            $num = $_POST['multiple'];

            for($i = 0; $i<$num; $i++) {
                $sql = "INSERT INTO dataipd (di_date_df_doctor, di_details_treat, di_id_doctor, di_date_acp, di_service_charge, di_ssp, di_cash, di_name_patient, di_HN, di_right, di_id_bill, di_type_doctor, di_type_file)
                        VALUES ('$di_date_df_doctor', '$di_details_treat', '$di_id_doctor', '$di_date_acp', '$di_service_charge', '$di_ssp', '$di_cash', '$di_name_patient', '$di_HN', '$di_right', '$di_id_bill', '$di_type_doctor', '$di_type_file')";

                if ($connect->query($sql)==TRUE){
                    echo "<script type='text/javascript'>";
                    echo "window.location = 'form_ipd.php';";
                    echo "</script>";
                }
                else {
                    echo "<script type='text/javascript'>";
                    echo "alert('Error!');";
                    echo "window.location = 'form_ipd.php';";
                    echo "</script>";
                }
            }
            break;

        case "upd" :
            $di_date_df_doctor = $_POST['date'];  
            $id = $_POST['record'];

            $sql = "UPDATE dataipd SET di_date_df_doctor='".$di_date_df_doctor."', 
                                       di_details_treat='".$di_details_treat."', 
                                       di_id_doctor='".$di_id_doctor."', 
                                       di_date_acp='".$di_date_acp."', 
                                       di_service_charge='".$di_service_charge."', 
                                       di_ssp='".$di_ssp."', 
                                       di_cash='".$di_cash."', 
                                       di_name_patient='".$di_name_patient."', 
                                       di_HN='".$di_HN."', 
                                       di_right='".$di_right."', 
                                       di_id_bill='".$di_id_bill."',
                                       di_type_doctor='".$di_type_doctor."', 
                                       di_type_file='".$di_type_file."' 
                    WHERE di_id='".$id."' ";

            if($connect->query($sql)==TRUE){
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_ipd.php';";
                echo "alert('Updated Successfully')"; 
                echo "</script>";
            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'show_ipd.php';";
                echo "alert('Error back to edit again');";
                echo "</script>";
            }
            break;
    }
?>
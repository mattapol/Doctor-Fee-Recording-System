<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/287088d0e5.js" crossorigin="anonymous"></script>
        <title>ข้อมูลIPD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-light justify-content-center py-3 shadow">
            <form action="show_ipd.php" class="row g-3" method="POST" name="search">
                <div class="col-auto">
                    <label for="floatingInput" class="btn"><b><sup style="color:red;">*</sup> CODE_NAME </b></label>
                </div>

                <div class="col-auto">
                    <input type="text" class="form-control" size="10" name="coded">
                </div>

                <div class="col-auto">
                    <label for="floatingInput" class="btn"><b><sup style="color:red;">*</sup> DATE </b></label>
                </div>

                <div class="col-auto">
                    <input type="date" class="form-control" size="10" name="dated">
                </div>

                <div class="col-auto">
                    <label for="floatingInput" class="btn"><b><sup style="color:red;">*</sup> DUTY </b></label>
                </div>

                <div class="col-auto">
                    <select class="form-select" name="dutid">
                        <option value="1"> ประจํา </option>
                        <option value="2"> เวร </option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn bg-green400 " aria-current="page"><i class="fas fa-search bg-cyan500"></i></button>
                </div>
            </form>
        </header>
        <hr>
        <center><h2>รายการ IPD </h2></center>

        <?php include 'condb.php';
            $coded = isset($_POST['coded']) ? $_POST['coded'] : '';
            $dated = isset($_POST['dated']) ? $_POST['dated'] : '';
            $dutid = isset($_POST['dutid']) ? $_POST['dutid'] : '';

            $sql = "SELECT * FROM dataipd WHERE di_type_doctor LIKE '%$dutid%' AND di_date_df_doctor LIKE '%$dated%' AND di_id_doctor LIKE '$coded%' ORDER BY di_id DESC";
            $result = mysqli_query($connect, $sql);
                
            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr style='color:green;'>
                <th width='1%'>RECORD#</th>
                <th width='1%'>วันที่</th>
                <th width='1%'>รายการค่าแพทย์</th>
                <th width='1%'>รหัสแพทย์</th>
                <th width='1%'>วันที่_ADMIN</th>
                <th width='1%'>จำนวนเงิน</th>
                <th width='1%'>ปกส.</th>
                <th width='1%'>เงินสด</th>
                <th width='2%'>ชื่อผู้ป่วย</th>
                <th width='1%'>HN</th>
                <th width='1%'>สิทธิ</th>
                <th width='1%'>Bill No.</th>
                <th width='1%'>EDIT</th>
                <th width='1%'>DELETE</th>
                </tr>";
            echo "</thead>";
            echo "<tbody>";
            if($result) {
                while($row = mysqli_fetch_array($result)) {
        ?>
                    <tr>
                    <th scope="row"><?php echo $row["di_id"];?></th>
                    <td><?php echo date("m/d/Y", strtotime($row["di_date_df_doctor"]));?></td>
                    <td><?php echo $row["di_details_treat"];?></td>
                    <td><?php echo $row["di_id_doctor"];?></td>
                    <td><?php echo $row["di_date_acp"];?></td>
                    <td style="text-align:right;"><?php echo number_format((int)$row["di_service_charge"]);?></td>
                    <td style="text-align:right;"><?php echo number_format((int)$row["di_ssp"]);?></td>
                    <td style="text-align:right;"><?php echo number_format((int)$row["di_cash"]);?></td>
                    <td><?php echo $row["di_name_patient"];?></td>
                    <td><?php echo $row["di_HN"];?></td>
                    <td><?php echo $row["di_right"];?></td>
                    <td><?php echo $row["di_id_bill"];?></td>
                    <td style="text-align:center;"><a href ="edit_ipd.php?id=<?php echo $row['di_id'];?>"><i class="far fa-edit"></i></a></td>
                    <td style="text-align:center;"><a href ="del_ipd.php?id=<?php echo $row['di_id'];?>"onclick="return confirm('Do you want to delete this information?')"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
        <?php
                }  
            }
            echo "</tbody>";
            echo "</table>";
        ?>
    </body>
</html>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>
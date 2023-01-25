<?php 
include 'like.php'; 
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
        <script src="js/check.js"></script>
        <script src="js/enter_next.js"></script>
        <title>บันทึกการเงินหมอเวร</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-gray p-6 shadow" style="background-color: #ececec;">
            <form action="form_ot.php" class="row g-3" method="post" name="search" onkeydown="return event.key != 'Enter';">
                <div class="col-auto">
                    <label for="floatingInput" class="btn"><b> SEARCH </b></label>
                </div>

                <div class="col-auto">
                    <input type="text" class="form-control" name="coded" placeholder="ค้นหาบันทึกค่าของผู้ใช้งาน">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn bg-green400 " aria-current="page"><i class="fas fa-search bg-cyan500"></i></button>
                </div>

                <div class="col-auto">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-calendar-check"></i> เพิ่มหมอประจํา </a></li>
                        <li class="nav-item"><a href="form_ot.php" class="nav-link active" style="background-color: #008CBA;"><i class="fas fa-calendar-plus"></i> เพิ่มหมอเวร </a></li>
                        <li class="nav-item"><a href="form_ipd.php" class="nav-link"><i class="fas fa-clock"></i> เพิ่ม IPD </a></li>
                        <li class="nav-item"><a href="result_ot.php" target="_bank" class="nav-link"><i class="fas fa-bullseye"></i> สรุปรายการหมอเวร </a></li>
                        <li class="nav-item"><a href="form_user_ot.php" class="nav-link"><i class="far fa-plus-square"></i> เพิ่มค่าผู้ใช้งาน </a></li>
                        <li class="nav-item"><a href="show_doctor.php" target="_bank" class="nav-link"><i class="fas fa-notes-medical"></i> รายชื่อหมอ </a></li>
                        <li class="nav-item"><a href="uploadDF.php"  class="nav-link" ><i class="fas fa-arrow-alt-circle-down"></i> อัพโหลดข้อมูล</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link" onclick="return confirm('Do you want to Logout?')"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
                    </ul>
                </div>
            </form>
        </header>

        <form action="add_ot.php?status=add" class="row g-3" method="post">
            <?php include 'condb_original.php';
                $id = isset($_GET['id']) ? $_GET['id'] : '';

                if($id!='') {

                    $sql = "SELECT * FROM dataform_user WHERE RECORD='".$id."' ";

                    $result = $connect->query($sql);

                    $row = $result->fetch_assoc();
                }
            ?>

            <hr>
            <center><h2>บันทึกการเงินหมอเวร</h2></center>
            <br>
            <br>
            <input class="form-control" size="5" name="record" value="<?php if($id!='') {echo $row['RECORD'];}?>" type="hidden">

            <div class="col-md-2">
                <div class="col-auto"> 
                    <label for="inputDATE" class="col-sm-2 col-form-label"><b> DATE </b></label>
                    <input class="form-control" name="date" value="" type="date" tabIndex="1" autofocus>
                </div>
            </div>

            <div class="col-md-2">
                <div class="col-auto"> 
                    <label for="inputCODE_NAME" class="col-sm-2 col-form-label"><b> CODE_NAME </b></label>
                    <input class="form-control" size="7" name="code_name" id="code_name" value="<?php if($id!='') {echo $row['CODE_NAME'];}?>" type="text" tabIndex="2">
                </div>
            </div>
            
            <div class="col-auto"> 
                <label for="inputNAME" class="col-sm-2 col-form-label"><b> NAME </b></label>
                <input class="form-control" size="30" name="name" id="name" type="text">
            </div>

            <div class="col-auto"> 
                <label for="inputTIME1" class="col-sm-2 col-form-label"><b> TIME1 </b></label>
                <input list="OptionsTime1" class="form-control" size="5" name="time1" value="<?php if($id!='') {echo $row['TIME1'];}?>" type="text" tabIndex="3">
                <datalist id="OptionsTime1">
                    <option value="08.00">
                    <option value="09.00">
                    <option value="10.00">
                    <option value="11.00">
                    <option value="12.00">
                    <option value="13.00">
                    <option value="14.00">
                    <option value="15.00">
                    <option value="16.00">
                    <option value="17.00">
                    <option value="18.00">
                    <option value="19.00">
                    <option value="20.00">
                    <option value="21.00">
                    <option value="22.00">
                    <option value="23.00">
                    <option value="00.00">
                    <option value="01.00">
                    <option value="02.00">
                    <option value="03.00">
                    <option value="04.00">
                    <option value="05.00">
                    <option value="06.00">
                    <option value="07.00">
                </datalist>
            </div>

            <div class="col-auto"> 
                <label for="inputTIME2" class="col-sm-2 col-form-label"><b> TIME2 </b></label>
                <input list="OptionsTime2" class="form-control" size="5" name="time2" value="<?php if($id!='') {echo $row['TIME2'];}?>" type="text" tabIndex="4">
                <datalist id="OptionsTime2">
                    <option value="08.00">
                    <option value="09.00">
                    <option value="10.00">
                    <option value="11.00">
                    <option value="12.00">
                    <option value="13.00">
                    <option value="14.00">
                    <option value="15.00">
                    <option value="16.00">
                    <option value="17.00">
                    <option value="18.00">
                    <option value="19.00">
                    <option value="20.00">
                    <option value="21.00">
                    <option value="22.00">
                    <option value="23.00">
                    <option value="00.00">
                    <option value="01.00">
                    <option value="02.00">
                    <option value="03.00">
                    <option value="04.00">
                    <option value="05.00">
                    <option value="06.00">
                    <option value="07.00">
                </datalist>
            </div>

            <div class="col-auto"> 
                <label for="inputWORK" class="col-sm-2 col-form-label"><b> WORK </b></label>
                <input list="OptionsWork" class="form-control" size="40" name="work" value="<?php if($id!='') {echo $row['WORK'];}?>" type="text" tabIndex="5">
                 <datalist id="OptionsWork">
                     <option value='"'>
                     <option value="Admit เยี่ยมไข้ หัตถการ">
                     <option value="ตรวจ หัตถการ">
                     <option value="การันตี">
                     <option value="หัตถการ">
                     <option value="ตรวจ">
                     <option value="เยี่ยมไข้">
                     <option value="วันเสาร์">
                     <option value="วันอาทิตย์">
                     <option value="วันหยุด">
                     <option value="Admit">
                 </datalist>
            </div>

            <div class="col-auto"> 
                <label for="inputOPD_SOCIAL" class="col-sm-2 col-form-label"><b> OPD_SOCIAL </b></label>
                <input class="form-control" size="7" name="opd_social" value="<?php if($id!='') {echo $row['OPD_SOCIAL'];}?>" type="text" tabIndex="6">
            </div>

            <div class="col-auto"> 
                <label for="inputOPD_GENERA" class="col-sm-2 col-form-label"><b> OPD_GENERA </b></label>
                <input class="form-control" size="7" name="opd_genera" value="<?php if($id!='') {echo $row['OPD_GENERA'];}?>" type="text" tabIndex="7">
            </div>

            <div class="col-auto"> 
                <label for="inputDOCTORFEE" class="col-sm-2 col-form-label"><b> DOCTORFEE </b></label>
                <input list="OptionsDoctorfee" class="form-control" size="7" name="doctorfee" value="<?php if($id!='') {echo $row['DOCTORFEE'];}?>" type="text" tabIndex="8">
                <datalist id="OptionsDoctorfee">
                    <option value="2500">
                    <option value="3500">
                </datalist>
            </div>
            
            <div class="col-auto"> 
                <label for="inputPT_NAME" class="col-sm-2 col-form-label"><b> PT_NAME </b></label>
                <input list="OptionsPt_name" class="form-control" size="50" name="pt_name" value="<?php if($id!='') {echo $row['PT_NAME'];}?>" type="text" tabIndex="9">
                <datalist id="OptionsPt_name">
                    <option value="1 ราย">
                    <option value="2 ราย">
                    <option value="3 ราย">
                    <option value="4 ราย">
                    <option value="5 ราย">
                    <option value="6 ราย">
                    <option value="7 ราย">
                    <option value="8 ราย">
                    <option value="9 ราย">
                    <option value="10 ราย">
                    <option value="11 ราย">
                    <option value="12 ราย">
                    <option value="13 ราย">
                    <option value="14 ราย">
                    <option value="15 ราย">
                    <option value="16 ราย">
                    <option value="17 ราย">
                    <option value="18 ราย">
                    <option value="19 ราย">
                    <option value="20 ราย">
                </datalist>
            </div>

            <div class="col-auto"> 
                <label for="inputDUTY" class="col-sm-2 col-form-label"><b> DUTY </b></label>
                <select class="form-select" name="duty" tabIndex="10">
                    <option value="2"> เวร </option>
                </select>
            </div>

            <div class="col-auto"> 
                <label for="inputTYPE" class="col-sm-2 col-form-label"><b> ประเภท </b></label>
                <select class="form-select" name="type" tabIndex="11">
                    <option value="1"> IPD </option>
                    <option value="2"> OPD </option>
                </select>
            </div>

            <div class="col-auto"> 
                <label for="inputFILE" class="col-sm-2 col-form-label"><b> ไฟล์ </b></label>
                <select class="form-select" name="ex" tabIndex="12">
                    <option value="1"> IPD </option>
                    <option value="2"> OPD </option>
                    <option value="3"> OT </option>
                </select>
            </div>

            <div class="col-auto"> 
                <label for="inputMultiple" class="col-sm-2 col-form-label"><b> Multiple </b></label>
                <input class="form-control" size="5" name="multiple" value="1" type="number" min="1" max="50" tabIndex="13">
            </div>
            <br>
            <center>
                <button type="submit" style="width:20rem;" class="btn btn-success" id="btn"><b> Save </button>
                <button type="reset" style="width:20rem;" class="btn btn-danger" name="Reset" id="Reset" value="Reset"> Reset </b></button>
            </center>
        </form>
        <hr>
        <div class="container-iframe">
            <iframe class="responsive-iframe" src="show_ot.php" style="border:2px solid red; height:800px; width:100%;"></iframe>
        </div>
        <hr>
        <br>
        <center><h2>บันทึกค่าหมอเวรของผู้ใช้งาน</h2></center>
        <br>

        <?php include 'condb_original.php';
            $coded = isset($_POST['coded']) ? $_POST['coded'] : '';
            
            $sql = "SELECT * FROM dataform_user WHERE DUTY LIKE '%2%' AND (RECORD LIKE '%$coded%' OR CODE_NAME LIKE '%$coded%' OR TIME1 LIKE '%$coded%' OR TIME2 LIKE '%$coded%' OR WORK LIKE '%$coded%' OR OPD_SOCIAL LIKE '%$coded%' OR OPD_GENERA LIKE '%$coded%' OR DOCTORFEE LIKE '%$coded%' OR PT_NAME LIKE '%$coded%') ORDER BY RECORD DESC";
            $result = mysqli_query($connect, $sql);
                
            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr style='color:green;'>
                <th width='1%'>RECORD#</th>
                <th width='1%'>CODE_NAME</th>
                <th width='1%'>TIME1</th>
                <th width='1%'>TIME2</th>
                <th width='5%'>WORK</th>
                <th width='1%'>OPD_SOCIAL</th>
                <th width='1%'>OPD_GENERA</th>
                <th width='1%'>DOCTORFEE</th>
                <th width='10%'>PT_NAME</th>
                <th width='1%'>ADD</th>
                <th width='1%'>EDIT</th>
                <th width='1%'>DELETE</th>
                </tr>";
            echo "</thead>";

            echo "<tbody>";
            if($result) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>      
                    <tr>
                    <th scope="row" style="text-align:right;"><?php echo $row["RECORD"];?></th>
                    <td><?php echo $row["CODE_NAME"];?></td>
                    <td><?php echo $row["TIME1"];?></td>	
                    <td><?php echo $row["TIME2"];?></td>
                    <td><?php echo $row["WORK"];?></td>
                    <td style="text-align:right;"><?php echo $row["OPD_SOCIAL"];?></td>
                    <td style="text-align:right;"><?php echo $row["OPD_GENERA"];?></td>
                    <td style="text-align:right;"><?php echo $row["DOCTORFEE"];?></td>
                    <td><?php echo $row["PT_NAME"];?></td>
                    <td style="text-align:center;"><a href ="form_ot.php?id=<?php echo $row['RECORD'];?>"><i class="fas fa-plus-circle"></i></a></td>
                    <td style="text-align:center;"><a href ="edit_user_ot.php?id=<?php echo $row['RECORD'];?>"><i class="far fa-edit"></i></a></td>
                    <td style="text-align:center;"><a href ="del_user_ot.php?id=<?php echo $row['RECORD'];?>"onclick="return confirm('Do you want to delete this information?')"><i class="far fa-trash-alt"></i></a></td>
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
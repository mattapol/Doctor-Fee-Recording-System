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
        <title>เพิ่มรายการ IPD </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-gray p-6 shadow" style="background-color: #ececec;">
            <form action="form_ipd.php" class="row g-3" method="post" name="search" onkeydown="return event.key != 'Enter';">
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
                        <li class="nav-item"><a href="form_ot.php" class="nav-link"><i class="fas fa-calendar-plus"></i> เพิ่มหมอเวร </a></li>
                        <li class="nav-item"><a href="form_ipd.php" class="nav-link active" style="background-color: #008CBA;"><i class="fas fa-clock"></i> เพิ่ม IPD </a></li>
                        <li class="nav-item"><a href="result_reg.php" target="_bank" class="nav-link"><i class="fas fa-sun"></i> สรุปรายการหมอประจํา </a></li>
                        <li class="nav-item"><a href="show_doctor.php" target="_bank" class="nav-link"><i class="fas fa-notes-medical"></i> รายชื่อหมอ </a></li>
                        <li class="nav-item"><a href="uploadDF.php"  class="nav-link" ><i class="fas fa-arrow-alt-circle-down"></i> อัพโหลดข้อมูล</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link" onclick="return confirm('Do you want to Logout?')"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
                    </ul>
                </div>
            </form>
        </header>

        <form action="add_ipd.php?status=add"  class="row g-3" method="post">

            <hr>
            <center><h2>บันทึกรายการ IPD </h2></center>
            <br>
            <br>

            <div class="col-auto"> 
                <label for="inputDATE"><b> DATE </b></label>
                <input class="form-control" name="date" value="" type="date" tabIndex="1" autofocus>
            </div>

            <div class="col-auto"> 
                <label for="inputDETAIL"><b> ชื่อรายการค่าแพทย์ </b></label>
                <input class="form-control" size="7" name="details_treat" id="details_treat" value="" type="text" tabIndex="2">
            </div>
          
            <div class="col-auto"> 
                <label for="inputCODE_NAME"><b> รหัสแพทย์ </b></label>
                <input class="form-control" size="30" name="code_name" id="code_name" type="text" tabIndex="3">
            </div>

            <div class="col-auto"> 
                <label for="inputNAME"><b> NAME </b></label>
                <input class="form-control" size="30" name="name" id="name" type="text">
            </div>
            
            <div class="col-auto"> 
                <label for="inputDATE_ADMIN"><b> วันที่ ADMIN </b></label>
                <input class="form-control" name="date_admin" id="date_admin" type="text" tabIndex="4">
            </div>
          
            <div class="col-auto"> 
                <label for="inputMONEY"><b> จำนวนเงิน </b></label>
                <input class="form-control" size="7" name="service_charge" value="" type="text" tabIndex="5">
            </div>
            
            <div class="col-auto"> 
                <label for="inputPKS"><b> ปกส </b></label>
                <input class="form-control" size="7" name="ssp" value="" type="text" tabIndex="6">
            </div>

            <div class="col-auto"> 
                <label for="inputCASH"><b> เงินสด </b></label>
                <input class="form-control" size="7" name="cash" value="" type="text" tabIndex="7">
            </div>
            
            <div class="col-auto"> 
                <label for="inputPATIENT"><b> ชื่อผู้ป่วย </b></label>
                <input class="form-control" size="7" name="name_patient" value="" type="text" tabIndex="8">
            </div>

            <div class="col-auto"> 
                <label for="inputHN"><b> HN </b></label>
                <input class="form-control" size="7" name="hn" value="" type="text" tabIndex="9">
            </div>

            <div class="col-auto"> 
                <label for="inputRIGHT"><b> สิทธิ </b></label>
                <input class="form-control" size="7" name="right" value="" type="text" tabIndex="10">
            </div>

            <div class="col-auto"> 
                <label for="inputBILL"><b> Bill No. </b></label>
                <input class="form-control" size="7" name="bill" value="" type="text" tabIndex="11">
            </div>

            <div class="col-auto"> 
                <label for="inputDUTY"><b> DUTY </b></label>
                <select class="form-select" name="duty" tabIndex="12">
                    <option value="1"> ประจํา </option>
                    <option value="2"> เวร </option>
                </select>
            </div>

            <div class="col-auto"> 
                <label for="inputFILE"><b> ไฟล์ </b></label>
                <select class="form-select" name="ex" tabIndex="13">
                    <option value="1"> IPD </option>
                    <!-- <option value="2"> OPD </option> -->
                </select>
            </div>

            <div class="col-auto"> 
                <label for="inputMultiple"><b> Multiple </b></label>
                <input class="form-control" size="5" name="multiple" value="1" type="number" min="1" max="50" tabIndex="14">
            </div>
            <br>
            <center>
                <button type="submit" style="width:20rem;" class="btn btn-success" id="btn"><b> Save </button>
                <button type="reset" style="width:20rem;" class="btn btn-danger" name="Reset" id="Reset" value="Reset"> Reset </b></button>
            </center>
        </form>
        <hr>
        <div class="container-iframe">
            <iframe class="responsive-iframe" src="show_ipd.php" style="border:2px solid red; height:800px; width:100%;"></iframe>
        </div>
    </body>
</html>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>
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
    <script src="js/check.js"></script>
    <title>เเก้ไขตั้งค่าหมอเวร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_ot.php?status=upd_user_ot" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add" class="form-horizontal" id="add">
        <?php include 'condb.php';
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            if($id!='') {

                $sql = "SELECT * FROM dataform_user WHERE RECORD='".$id."' ";

                $result = $connect->query($sql);

                $row = $result->fetch_assoc();
            }
        ?>
      
        <h4 class="h3 mb-3 fw-normal">เเก้ไขตั้งค่าหมอเวร</h4>
        <br>
        <br>
        <input class="form-control" size="7" name="record" value="<?php if($id!='') {echo $row['RECORD'];}?>" type="hidden">

        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input type="text" name="code_name" value="<?php if($id!='') {echo $row['CODE_NAME'];}?>" class="form-control" id="code_name" placeholder="CODE_NAME">
              <label for="floatingInput"> CODE_NAME </label>
            </div>
          </div>

          <div class="col-6">
            <div class="form-floating" >
              <select class="form-select" name="duty">
                <option value="2"> เวร </option>
              </select>
              <label for="floatingInput"> DUTY </label>
            </div>
          </div>
        </div>

        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input list="OptionsTime1" name="time1" value="<?php if($id!='') {echo $row['TIME1'];}?>" class="form-control" id="floatingTime1" placeholder="TIME1">
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
              <label for="floatingInput"> TIME1 </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input list="OptionsTime2" name="time2" value="<?php if($id!='') {echo $row['TIME2'];}?>" class="form-control" id="floatingTime2" placeholder="TIME2">
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
              <label for="floatingInput"> TIME2 </label>
            </div>
          </div>
        </div>

        <div class="form-floating">
          <input list="OptionsWork" name="work" value="<?php if($id!='') {echo $row['WORK'];}?>" class="form-control" id="floatingWork" placeholder="WORK">
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
          <label for="floatingInput"> WORK </label>
        </div>

        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input type="text" name="opd_social" value="<?php if($id!='') {echo $row['OPD_SOCIAL'];}?>" class="form-control" id="floatingOpd_social" placeholder="OPD_SOCIAL">
              <label for="floatingInput"> OPD_SOCIAL </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input type="text" name="opd_genera" value="<?php if($id!='') {echo $row['OPD_GENERA'];}?>" class="form-control" id="floatingOpd_genera" placeholder="OPD_GENERA">
              <label for="floatingInput"> OPD_GENERA </label>
            </div>
          </div>
        </div>

        <div class="form-floating">
          <input list="OptionsDoctorfee" name="doctorfee" value="<?php if($id!='') {echo $row['DOCTORFEE'];}?>" class="form-control" id="floatingDoctorfee" placeholder="DOCTORFEE">
            <datalist id="OptionsDoctorfee">
              <option value="2500">
              <option value="3500">
            </datalist>
          <label for="floatingInput"> DOCTORFEE </label>
        </div>
     
        <div class="form-floating">
          <input list="OptionsPt_name" name="pt_name" value="<?php if($id!='') {echo $row['PT_NAME'];}?>" class="form-control" id="floatingPt_name" placeholder="PT_NAME">
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
          <label for="floatingInput"> PT_NAME </label>
        </div>
        <br>
        <input type="submit" class="btn btn-success" name="Update" id="Update" value="Update">
        <input type="button" class="btn btn-danger" name="Cancel" id="Cancel" value="Cancel" onclick="window.location='form_ot.php' ">
      </form>
    </main>
  </body>
</html>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>
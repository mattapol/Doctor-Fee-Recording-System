<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เเก้ไขข้อมูลหมอประจํา</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_regular.php?status=upd" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add_doctor_regular_db" class="form-horizontal">
        <?php include 'condb.php';
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            if($id!='') {

                $sql = "SELECT * FROM payroll_doctor WHERE RECORD='".$id."' ";

                $result = $connect->query($sql);

                $row = $result->fetch_assoc();
            }
        ?>

        <h4 class="h3 mb-3 fw-normal">เเก้ไขการเงินหมอประจํา</h4>
        <br>
        <br>
        <div class="form-floating">
            <input type="hidden" name="record" value="<?php echo $row['RECORD'];?>" class="form-control">
            <label for="floatingInput"> RECORD# </label>
        </div>

        <div class="form-floating">
          <input type="date" name="date" value="<?php echo $row['DATE'];?>" class="form-control" id="floatingDate">
          <label for="floatingInput"> DATE </label>
        </div>
         
        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">  
              <input type="text" name="code_name" value="<?php echo $row['CODE_NAME'];?>" class="form-control" id="code_name" placeholder="CODE_NAME">
              <label for="floatingInput" style="display: inline;"> CODE_NAME </label>
            </div>
          </div>

          <div class="col-6">
            <div class="form-floating" >
              <select class="form-select" name="duty">
                <option value="1"> ประจํา </option>
              </select>
              <label for="floatingInput"> DUTY </label>
            </div>
          </div>
        </div>

        <div class="form-floating">
          <input list="OptionsWork" name="work" value="<?php echo $row['WORK'];?>" class="form-control" id="floatingWork" placeholder="WORK">
            <datalist id="OptionsWork">
              <option value='"'>
              <option value="Admit เยี่ยมไข้ หัตถการ">
              <option value="ตรวจ หัตถการ">
              <option value="วันเสาร์">
              <option value="วันอาทิตย์">
              <option value="วันหยุด">
              <option value="หัตถการ">
              <option value="ตรวจ">
              <option value="เยี่ยมไข้">
              <option value="Admit">
            </datalist>
          <label for="floatingInput"> WORK </label>
        </div>

        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input type="text" name="opd_social" value="<?php echo $row['OPD_SOCIAL'];?>" class="form-control" id="floatingOpd_social" placeholder="OPD_SOCIAL">
              <label for="floatingInput"> OPD_SOCIAL </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input type="text" name="opd_genera" value="<?php echo $row['OPD_GENERA'];?>" class="form-control" id="floatingOpd_genera" placeholder="OPD_GENERA">
              <label for="floatingInput"> OPD_GENERA </label>
            </div>
          </div>
        </div>

        <div class="row g-1">
          <div class="col-6"> 
            <div class="form-floating">
              <input type="text" name="surgi_soci" value="<?php echo $row['SURGI_SOCI'];?>" class="form-control" id="floatingSurgi_soci" placeholder="SURGI_SOCI">
              <label for="floatingInput"> SURGI_SOCI </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input type="text" name="surgi_gene" value="<?php echo $row['SURGI_GENE'];?>" class="form-control" id="floatingSurgi_gene" placeholder="SURGI_GENE">
              <label for="floatingInput"> SURGI_GENE </label>
            </div>
          </div>
        </div>

        <div class="form-floating">
          <input list="datalistOptions" name="pt_name" value="<?php echo $row['PT_NAME'];?>" class="form-control" id="floatingPt_name" placeholder="PT_NAME">
            <datalist id="datalistOptions">
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
        <input type="button" class="btn btn-danger" name="Cancel" id="Cancel" value="Cancel" onclick="window.location='show_regular.php' ">
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
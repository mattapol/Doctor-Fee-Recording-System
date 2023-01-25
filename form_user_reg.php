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
    <title>เพิ่มตั้งค่าหมอประจํา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_regular.php?status=user_reg" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add" class="form-horizontal" id="add">
        <h4 class="h3 mb-3 fw-normal">ตั้งค่าบันทึกหมอประจํา</h4>
        <br>
        <a class="btn bg-warning" type="button" href="index.php"><i class="fas fa-arrow-circle-left"></i> กลับไปหน้ารวม </a>
        <br>
        <br>
        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input type="text" name="code_name" class="form-control" id="code_name" placeholder="CODE_NAME">
              <label for="floatingInput"> CODE_NAME </label>
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
          <input type="text" name="name" class="form-control" id="name" placeholder="NAME">
          <label for="floatingInput"> NAME </label>
        </div>

        <div class="form-floating">
          <input list="OptionsWork" name="work" class="form-control" id="floatingWork" placeholder="WORK">
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
              <input type="text" name="opd_social" class="form-control" id="floatingOpd_social" placeholder="OPD_SOCIAL">
              <label for="floatingInput"> OPD_SOCIAL </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input type="text" name="opd_genera" class="form-control" id="floatingOpd_genera" placeholder="OPD_GENERA">
              <label for="floatingInput"> OPD_GENERA </label>
            </div>
          </div>
        </div>

        <div class="row g-1">
          <div class="col-6">    
            <div class="form-floating">
              <input type="text" name="surgi_soci" class="form-control" id="floatingOpd_social" placeholder="OPD_SOCIAL">
              <label for="floatingInput"> SURGI_SOCI </label>
            </div>
          </div>

          <div class="col-6">  
            <div class="form-floating">
              <input type="text" name="surgi_gene" class="form-control" id="floatingOpd_genera" placeholder="OPD_GENERA">
              <label for="floatingInput"> SURGI_GENE </label>
            </div>
          </div>
        </div>
     
        <div class="form-floating">
          <input list="OptionsPt_name" name="pt_name" class="form-control" id="floatingPt_name" placeholder="PT_NAME">
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
        <button type="submit" class="btn btn-success" id="btn"> Save </button>
        <input type="reset" class="btn btn-danger" name="Reset" id="Reset" value="Reset">
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
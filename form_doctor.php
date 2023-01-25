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
    <title>เพิ่มรายชื่อหมอ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_doctor.php?status=add" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add" class="form-horizontal" id="add">
        <h4 class="h3 mb-3 fw-normal">เพิ่มรายชื่อหมอ</h4>
        <br>
        <a class="btn bg-warning" type="button" href="show_doctor.php" target="_bank" aria-current="page"><i class="fas fa-arrow-circle-left"></i> กลับไปหน้ารวม </a>
        <br>
        <br>
        <div class="form-floating">
          <input type="text" name="code_name" class="form-control" id="code_name" placeholder="CODE_NAME" required>
          <label for="floatingInput"> CODE_NAME </label>
        </div>

        <div class="form-floating" >
          <input list="OptionsNT" name="name_title" class="form-control" id="name_title" placeholder="NAME_TITLE" required>
            <datalist id="OptionsNT">
              <option value='นพ'>
              <option value="พญ">
              <option value="ทพ">
              <option value="ทพ.ญ">
            </datalist>
          <label for="floatingInput"> NAME_TITLE </label>
        </div>

        <div class="form-floating">  
          <input type="text" name="name" class="form-control" id="name" placeholder="NAME" required>
          <label for="floatingInput"> NAME </label>
        </div>
   
        <div class="form-floating">
          <input type="text" name="last_name" class="form-control" id="floatingLast_name" placeholder="LAST_NAME" required>
          <label for="floatingInput"> LAST_NAME </label>
        </div>

        <div class="form-floating">
          <input type="text" name="w_doctor" class="form-control" id="floatingW_doctor" placeholder="W_DOCTOR" required>
          <label for="floatingInput"> W_DOCTOR </label>
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
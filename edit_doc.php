<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เเก้ไขรายชื่อหมอ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_doctor.php?status=upd" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add_doctor_regular_db" class="form-horizontal">
        <?php include 'condb.php';
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            if($id!='') {

                $sql = "SELECT * FROM name_doctor WHERE ID='".$id."' ";

                $result = $connect->query($sql);

                $row = $result->fetch_assoc();
            }
        ?>

        <h4 class="h3 mb-3 fw-normal">เเก้ไขรายชื่อหมอ</h4>
        <br>
        <br>
        <div class="form-floating">
            <input type="hidden" name="ids" value="<?php echo $row['ID'];?>" class="form-control">
            <label for="floatingInput"> ID </label>
        </div>

        <div class="form-floating">
          <input type="text" name="code_name" value="<?php echo $row['CODE_NAME'];?>" class="form-control" id="code_name" placeholder="CODE_NAME">
          <label for="floatingInput"> CODE_NAME </label>
        </div>

        <div class="form-floating" >
          <input list="OptionsNT" name="name_title" value="<?php echo $row['NAME_TITLE'];?>" class="form-control" id="name_title" placeholder="NAME_TITLE">
            <datalist id="OptionsNT">
              <option value='นพ'>
              <option value="พญ">
            </datalist>
          <label for="floatingInput"> NAME_TITLE </label>
        </div>

        <div class="form-floating">  
          <input type="text" name="name" value="<?php echo $row['NAME'];?>" class="form-control" id="name" placeholder="NAME">
          <label for="floatingInput"> NAME </label>
        </div>
   
        <div class="form-floating">
          <input type="text" name="last_name" value="<?php echo $row['LAST_NAME'];?>" class="form-control" id="floatingLast_name" placeholder="LAST_NAME">
          <label for="floatingInput"> LAST_NAME </label>
        </div>

        <div class="form-floating">
          <input type="text" name="w_doctor" value="<?php echo $row['W_DOCTOR'];?>" class="form-control" id="floatingW_doctor" placeholder="W_DOCTOR">
          <label for="floatingInput"> W_DOCTOR </label>
        </div> 
        <br>
        <input type="submit" class="btn btn-success" name="Update" id="Update" value="Update">
        <input type="button" class="btn btn-danger" name="Cancel" id="Cancel" value="Cancel" onclick="window.location='show_doctor.php' ">
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
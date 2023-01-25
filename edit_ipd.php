<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เเก้ไขรายการ IPD</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="add_ipd.php?status=upd" onkeydown="return event.key != 'Enter';" method="POST" enctype="multipart/form-data" name="add_doctor_regular_db" class="form-horizontal">
        <?php include 'condb.php';
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            if($id!='') {

                $sql = "SELECT * FROM dataipd WHERE di_id='".$id."' ";

                $result = $connect->query($sql);

                $row = $result->fetch_assoc();
            }
        ?>

        <h4 class="h3 mb-3 fw-normal">เเก้ไขรายการ IPD</h4>
        <br>
        <br>
        <div class="form-floating">
            <input type="hidden" name="record" value="<?php echo $row['di_id'];?>" class="form-control">
            <label for="floatingInput"> RECORD# </label>
        </div>
        
        <div class="form-floating">
          <input type="date" name="date" value="<?php echo $row['di_date_df_doctor'];?>" class="form-control" id="date">
          <label for="floatingInput"> DATE </label>
        </div>

        <div class="form-floating">
          <input type="text" name="details_treat" value="<?php echo $row['di_details_treat'];?>" class="form-control" id="details_treat">
          <label for="floatingInput"> ชื่อรายการค่าแพทย์ </label>
        </div>

        <div class="form-floating">
          <input type="text" name="date_admin" value="<?php echo $row['di_date_acp'];?>" class="form-control" id="date_admin">
          <label for="floatingInput"> วันที่ ADMIN </label>
        </div>

        <div class="row g-1">
          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="code_name" value="<?php echo $row['di_id_doctor'];?>" class="form-control" id="id_doctor">
              <label for="floatingInput"> รหัสแพทย์ </label>
            </div>
          </div>

          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="service_charge" value="<?php echo $row['di_service_charge'];?>" class="form-control" id="service_charge">
              <label for="floatingInput"> จำนวนเงิน </label>
            </div>
          </div>
        </div>

        <div class="row g-1">
          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="ssp" value="<?php echo $row['di_ssp'];?>" class="form-control" id="ssp">
              <label for="floatingInput"> ปกส </label>
            </div>
          </div>

          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="cash" value="<?php echo $row['di_cash'];?>" class="form-control" id="cash">
              <label for="floatingInput"> เงินสด </label>
            </div>
          </div>
        </div>
        
        <div class="row g-1">
          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="name_patient" value="<?php echo $row['di_name_patient'];?>" class="form-control" id="name_patient">
              <label for="floatingInput"> ชื่อผู้ป่วย </label>
            </div>
          </div>

          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="hn" value="<?php echo $row['di_HN'];?>" class="form-control" id="hn">
              <label for="floatingInput"> HN </label>
            </div>
          </div>
        </div>
  
        <div class="row g-1">
          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="right" value="<?php echo $row['di_right'];?>" class="form-control" id="right">
              <label for="floatingInput"> สิทธิ </label>
            </div>
          </div>
        
          <div class="col-6">
            <div class="form-floating">
              <input type="text" name="bill" value="<?php echo $row['di_id_bill'];?>" class="form-control" id="bill">
              <label for="floatingInput"> Bill No. </label>
            </div>
          </div>
        </div>

        <div class="row g-1">
          <div class="col-6">
            <div class="form-floating">
              <select class="form-select" name="duty" id="duty">
                <?php 
                  if ($row['di_type_doctor'] == 2) {
                    echo "<option value='2'> เวร </option>";
                    echo "<option value='1'> ประจํา </option>";
                  }else{
                    echo "<option value='1'> ประจํา </option>";
                    echo "<option value='2'> เวร </option>";
                  } 
                ?>
              </select>
              <label for="floatingInput"> DUTY </label>
            </div>
          </div>
        
          <div class="col-6">
            <div class="form-floating">
                <select class="form-select" name="ex" id="ex" value="<?php echo $row['di_type_file'];?>">
                  <option value="1"> IPD </option>
                  <!-- <option value="2"> OPD </option> -->
                </select>
              <label for="floatingInput"> ไฟล์ </label>
            </div>
          </div>
        </div>
        <br>
        <input type="submit" class="btn btn-success" name="Update" id="Update" value="Update">
        <input type="button" class="btn btn-danger" name="Cancel" id="Cancel" value="Cancel" onclick="window.location='show_ipd.php'">
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
<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/287088d0e5.js" crossorigin="anonymous"></script>
        <title>ข้อมูลรวมหมอเวร</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-light justify-content-center py-3 shadow">
            <form action="show_ot.php" class="row g-3" method="post" name="search">
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
                    <button type="submit" class="btn bg-green400 " aria-current="page"><i class="fas fa-search bg-cyan500"></i></button>
                </div>
            </form>
        </header>
        <hr>
        <center><h2>รายการหมอเวร</h2></center>
        
        <?php include 'condb.php';
            $coded = isset($_POST['coded']) ? $_POST['coded'] : '';
            $dated = isset($_POST['dated']) ? $_POST['dated'] : '';

            $sql = "SELECT * FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%' ORDER BY RECORD DESC";
            $result = mysqli_query($connect, $sql);
                
            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr style='color:green;'>
                <th width='1%'>RECORD#</th>
                <th width='1%'>DATE</th>
                <th width='1%'>CODE_NAME</th>
                <th width='1%'>TIME1</th>
                <th width='1%'>TIME2</th>
                <th width='5%'>WORK</th>
                <th width='1%'>OPD_SOCIAL</th>
                <th width='1%'>OPD_GENERA</th>
                <th width='1%'>DOCTORFEE</th>
                <th width='10%'>PT_NAME</th>
                <th width='1%'>EDIT</th>
                <th width='1%'>DELETE</th>
                </tr>";
            echo "</thead>";
            echo "<tbody>";
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>      
                    <tr>
                    <th scope="row"><?php echo $row["RECORD"];?></th>
                    <td><?php echo date("m/d/Y", strtotime($row["DATE"]));?></td>
                    <td><?php echo $row["CODE_NAME"];?></td>
                    <td><?php echo $row["TIME1"];?></td>	
                    <td><?php echo $row["TIME2"];?></td>
                    <td><?php echo $row["WORK"];?></td>
                    <td style="text-align:right;"><?php echo number_format($row["OPD_SOCIAL"]);?></td>
                    <td style="text-align:right;"><?php echo number_format($row["OPD_GENERA"]);?></td>
                    <td style="text-align:right;"><?php echo number_format($row["DOCTORFEE"]);?></td>
                    <td><?php echo $row["PT_NAME"];?></td>
                    <td style="text-align:center;"><a href ="edit_ot.php?id=<?php echo $row['RECORD'];?>"><i class="far fa-edit"></i></a></td>
                    <td style="text-align:center;"><a href ="del_ot.php?id=<?php echo $row['RECORD'];?>"onclick="return confirm('Do you want to delete this information?')"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
        <?php
                }
            }
            else {
                echo "0 records";
            }
            echo "</tbody>";
            echo "</table>";
        ?>
    </body>
</html>
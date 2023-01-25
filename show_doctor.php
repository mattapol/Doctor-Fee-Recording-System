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
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css'>
        <title>รายชื่อหมอ</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <style>
            html {
                max-width: 145ch;
                padding: 3em 1em;
                margin: auto;
                line-height: 2;
                font-size: 0.91em;
            }
        </style>
        <script>
            $(document).ready( function () {
                var table = $('#payroll').DataTable( {
                    dom: 'lrtip',
                    paging: false
                } );
            } );
	    </script>
    </head>
    <body>
        <div class="nonprint">
            <form action="show_doctor.php" class="row g-3" method="POST" name="search">
                <div class="col-auto">
                    <a href="index.php"><button type="button" class="btn bg-warning" aria-current="page"><i class="fas fa-home"></i></button></a>
                </div>

                <div class="col-auto">
                    <label for="floatingInput" class="btn"><b> SEARCH </b></label>
                </div>

                <div class="col-auto">
                    <input type="text" class="form-control" size="25" name="coded" placeholder="Code, Title, Name, Last, W_doc">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn bg-green400 " aria-current="page"><i class="fas fa-search bg-cyan500"></i></button>
                    <button type="button" class="btn bg-orange500" onclick="window.print();" aria-current="page"><i class="fas fa-print bg-orange500"></i></button>
                </div>

                <div class="col-auto">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="show_doctor.php" class="nav-link active"><i class="fas fa-notes-medical"></i> รายชื่อหมอ </a></li>
                        <li class="nav-item"><a href="form_doctor.php" class="nav-link"><i class="far fa-plus-square"></i> เพิ่มหมอ </a></li>
                        <li class="nav-item nav-link" style="color:black"> | </li>
                        <li class="nav-item nav-link" style="color:red"><span style="background-color: #FFFF00"><b><i><u> <?php echo $_SESSION['name']; ?> </u></i></b></span></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link" onclick="return confirm('Do you want to Logout?')"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
                    </ul>
                </div>
            </form>
            <hr>
            <br>
            <center><h2>รายชื่อหมอ</h2></center>
            <br>
        </div>

        <?php include 'condb.php';
            $coded = isset($_POST['coded']) ? $_POST['coded'] : '';

            $sql = "SELECT * FROM name_doctor WHERE CODE_NAME LIKE '%$coded%' OR NAME_TITLE LIKE '%$coded%' OR NAME LIKE '%$coded%' OR LAST_NAME LIKE '%$coded%' OR W_DOCTOR LIKE '%$coded%'";
            $result = $connect->query($sql);

            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr>
                <th width='1%'>ID</th>
                <th width='1%'>CODE_NAME</th>
                <th width='2%'>TITLE</th>
                <th width='5%'>NAME</th>
                <th width='10%'>LAST_NAME</th>
                <th width='1%'>W_DOCTOR</th>
                <th data-orderable='false' width='1%'>EDIT</th>
                <th data-orderable='false' width='1%'>DELETE</th>
                </tr>";
            echo "</thead>";
            echo "<tbody>";
            if($result) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
                    <tr>
                    <td style="text-align:center;"><?php echo $row["ID"];?></td>
                    <td style="text-align:center;"><?php echo $row["CODE_NAME"];?></td>
                    <td style="text-align:center;"><?php echo $row["NAME_TITLE"];?></td>
                    <td><?php echo $row["NAME"];?></td>
                    <td><?php echo $row["LAST_NAME"];?></td>
                    <td style="text-align:center;"><?php echo $row["W_DOCTOR"];?></td>
                    <td style="text-align:center;"><a href ="edit_doc.php?id=<?php echo $row['ID'];?>"<i class="far fa-edit"></i></a></td>
                    <td style="text-align:center;"><a href="del_doc.php?id=<?php echo $row['ID'];?>"onclick="return confirm('Do you want to delete this information?')"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
        <?php
                }
            } 
            else {
                echo "0 records";
            }
            echo "</tbody>";
            echo "</table>";
            $connect->close();
        ?> 
    </body>
</html>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>
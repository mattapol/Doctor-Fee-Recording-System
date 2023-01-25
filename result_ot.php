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
        <title>สรุปข้อมูลหมอเวร</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style2.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <style>
        @media print {
            html, body {    
                font-size: 10pt;
                white-space: nowrap;
            }
            .nonprint {
                display: none;
            }
        }
        </style> 
    </head>
    <body>
    <div class="nonprint">
        <header class="navbar navbar-dark sticky-top bg-light p-6 shadow">
            <form action="result_ot.php" class="row g-3" method="post" name="search">
                <div class="col-auto">
                    <a href="form_ot.php"><button type="button" class="btn bg-warning" aria-current="page"><i class="fas fa-home"></i></button></a>
                </div>

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
                    <input type="month" class="form-control" size="10" name="dated">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn bg-green400 " aria-current="page"><i class="fas fa-search bg-cyan500"></i></button>
                    <button type="button" class="btn bg-orange500" onclick="window.print();" aria-current="page"><i class="fas fa-print bg-orange500"></i></button>
                </div>

                <div class="col-auto">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="result_reg.php" class="nav-link" style="color:red"><i class="fas fa-sun"></i> สรุปรายการหมอประจํา </a></li>
                        <li class="nav-item"><a href="result_ot.php" class="nav-link active"><i class="fas fa-bullseye"></i> สรุปรายการหมอเวร </a></li>
                        <li class="nav-item nav-link" style="color:black"> | </li>
                        <li class="nav-item nav-link" style="color:red"><span style="background-color: #FFFF00"><b><i><u> <?php echo $_SESSION['name']; ?> </u></i></b></span></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link" onclick="return confirm('Do you want to Logout?')"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
                     </ul>
                </div>
            </form>
        </header>
        <hr>
        <br>
        <center><h2>สรุปรายการหมอเวร</h2></center>
        <br>
    </div>
        <?php include 'condb.php';
            $coded = isset($_POST['coded']) ? $_POST['coded'] : '';
            $dated = isset($_POST['dated']) ? $_POST['dated'] : '';

            $d_name = "SELECT CODE_NAME, NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME LIKE '$coded%'";
            $show_name = $connect->query($d_name);
            $d = mysqli_fetch_array($show_name);
            if($d['CODE_NAME'] != '') {echo "<b> List For Code_Name = " .$d['CODE_NAME'] . "<br>" .$d['NAME_TITLE'] . ". " .$d['NAME'] . " " .$d['LAST_NAME'] . "<br>";} else{echo "ไม่พบรายชื่อในฐานข้อมูล<br> ";}

            echo "<div class='nonprint'>";
                $record = "SELECT COUNT(RECORD) AS records FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $show_record = $connect->query($record);
                $rec = mysqli_fetch_array($show_record);
                echo "" .$rec['records'] . " Records Summed";
                echo "<br>";
                echo "<br>";

                $sum1 = "SELECT SUM(OPD_SOCIAL) AS opds FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $sum2 = "SELECT SUM(OPD_GENERA) AS opdg FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $sum3 = "SELECT SUM(DOCTORFEE) AS docfee FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $sumd = "SELECT SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE) AS summer FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $vat = "SELECT ((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3 AS vat3 FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";
                $sum = "SELECT SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3 AS summed FROM payroll_doctor WHERE DUTY LIKE '%2%' AND DATE LIKE '%$dated%' AND CODE_NAME LIKE '$coded%'";

                $summed1 = $connect->query($sum1);
                $summed2 = $connect->query($sum2);
                $summed3 = $connect->query($sum3);
                $summed = $connect->query($sumd);
                $vat3 = $connect->query($vat);
                $sums = $connect->query($sum);

                $r1 = mysqli_fetch_array($summed1);
                $r2 = mysqli_fetch_array($summed2);
                $r3 = mysqli_fetch_array($summed3);
                $r = mysqli_fetch_array($summed);
                $v = mysqli_fetch_array($vat3);
                $s = mysqli_fetch_array($sums);

                echo "<a> | OPD_SOCIAL = " .number_format($r1['opds']) . "</a>"; 
                echo "<a> | OPD_GENERA = " .number_format($r2['opdg']) . "</a>";
                echo "<a> | DOCTORFEE = " .number_format($r3['docfee']) . "</a>";  
                echo "<a> | TOTAL = " .number_format($r['summer']) . " | </a></b>"; 
                echo "<br>";
                echo "<br>";
            echo "</div>";

            $sql = "SELECT * FROM payroll_doctor 
                    WHERE DUTY LIKE '%2%' 
                    AND DATE LIKE '%$dated%' 
                    AND CODE_NAME LIKE '$coded%'
                    ORDER BY type_treat ASC, extra ASC, DATE ASC";
            $result = $connect->query($sql);

            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr>
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
                </tr>";
            echo "</thead>";
            echo "<tbody>";
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo"<tr>";
                    echo "<th scope='row'>" .$row["RECORD"]. "</th>";
                    echo "<td>" .date("m/d/Y", strtotime($row["DATE"])) . "</td>";
                    echo "<td>" .$row["CODE_NAME"]. "</td>";
                    echo "<td>" .$row["TIME1"] .  "</td>";	
                    echo "<td>" .$row["TIME2"] .  "</td>";
                    echo "<td>" .$row["WORK"]. "</td>";
                    echo "<td style='text-align:right;'>" .number_format($row["OPD_SOCIAL"]). "</td>";
                    echo "<td style='text-align:right;'>" .number_format($row["OPD_GENERA"]). "</td>";
                    echo "<td style='text-align:right;'>" .number_format($row["DOCTORFEE"]).  "</td>";
                    echo "<td>" .$row["PT_NAME"]. "</td>";
                    echo "</b></tr>";
                }
            } 
            else {
                echo "0 records";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<br>";

            if($d['CODE_NAME'] != '') {echo "<b> List For Code_Name = " .$d['CODE_NAME'] . "<br>" .$d['NAME_TITLE'] . ". " .$d['NAME'] . " " .$d['LAST_NAME'] . "<br>";} else{echo "ไม่พบรายชื่อในฐานข้อมูล<br> ";}
            echo "" .$rec['records'] . " Records Summed";
            echo '<table class="table table-striped table-hover" id="payroll">';
            echo "<thead>";
            echo "<tr style='text-align:center;'>
                <th width='1%'>OPD_SOCIAL</th>
                <th width='1%'>OPD_GENERA</th>
                <th width='1%'>DOCTORFEE</th>
                <th width='10%'>TOTAL</th>
                <th width='10%'>VAT3%</th>
                <th width='10%'>SUMMARIZE</th>
                </tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr style='text-align:center;'>";
            echo "<td>" .number_format($r1['opds']). "</td>";
            echo "<td>" .number_format($r2['opdg']). "</td>";
            echo "<td>" .number_format($r3['docfee']). "</td>";
            echo "<td>" .number_format($r['summer']). "</td>";
            echo "<td>" .number_format($v['vat3'], 2). "</td>";
            echo "<td>" .number_format($s['summed'], 2). "</td>";
            echo "</b></tr>";
            echo "</tbody>";
            echo "</table>";
        $connect->close();
    ?>
        <!-- echo "<div id='corner'>";
            if($d['CODE_NAME'] != '') {echo "<br><u>" .$d['NAME_TITLE'] . ". " .$d['NAME'] . " " .$d['LAST_NAME'] . "</u></br>";} else{echo "ไม่พบรายชื่อในฐานข้อมูล<br> ";}
    ?><br>
            <div style="display: inline;"> ยอดรวม </div>
            <div style="display: inline;">&#160;&#160;&#160;&#160;&#160;&#160;<input type="text" size="7" style="text-align:right;" value="<?php echo $r['summer'];?>"></div><br>
            <div style="display: inline;"> หัก ภาษี3% </div>
            <div style="display: inline;">&#160;<input type="text" size="7" style="text-align:right;" value="<?php echo number_format($v['vat3'], 2);?>"></div><br>
            <div style="display: inline;"> จ่ายสุทธิ </div>
            <div style="display: inline;">&#160;&#160;&#160;&#160;&#160;<input type="text" size="7" style="text-align:right;" value="<?php echo number_format($s['summed'], 2);?>"></b></div><br>
        </div> -->
    </body>
</html>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>
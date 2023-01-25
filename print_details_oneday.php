<?php
include 'condb_original.php';
require_once('tcpdf/tcpdf.php');
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

class MYPDF extends TCPDF {
  public function Header() {
    $this->SetFont('thsarabun', '', 10);
    $headerData = $this->getHeaderData();
    $this->writeHTML($headerData['string']);

  }
  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('thsarabun', '', 10);
    $this->Cell(200, 15, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

if ($_GET['duty'] == 1) {
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (รายละเอียดหมอประจํา)');

  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT COUNT(RECORD) AS records FROM payroll_doctor WHERE DUTY = '1' and DATE ='".$_GET['dat']."'and CODE_NAME='".$_GET['id']."' ORDER BY DATE ASC";
  $show_record = $connect->query($record);
  $rec = mysqli_fetch_array($show_record);
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
    <tr>
    <td width="200px">List For Code_Name = '.$_GET['id'].'</td>
    </tr>
    <tr>
    <td width="200px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
    </tr>
    <tr>
    <td width="200px">'.$rec['records'].' Records Summed</td>
    </tr>
    </table>', $tc=array(0,0,0), $lc=array(0,0,0));

  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  $pdf->SetFont('thsarabun', '', 10);
  $pdf->AddPage();

  $htmlH ='<table border="1px">
  <tr style="text-align:center;">
  <th width="35px">RECORD#</th>
  <th width="40px">DATE</th>
  <th width="45px">CODE_NAME</th>
  <th width="90px">WORK</th>
  <th width="45px">OPD_SOCIAL</th>
  <th width="45px">OPD_GENERA</th>
  <th width="45px">SURGI_SOCI</th>
  <th width="45px">SURGI_GENE</th>
  <th width="130px">PT_NAME</th>
  </tr>';

  $sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '1' and DATE ='".$_GET['dat']."'and CODE_NAME='".$_GET['id']."' ORDER BY DATE ASC";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.$row["RECORD"].'</td>
    <td style="text-align:center;">'.date("Y/m/d", strtotime($row["DATE"])).'</td>
    <td style="text-align:center;">'.$row["CODE_NAME"].'</td>
    <td style="text-align:center;">'.$row["WORK"].'</td>
    <td style="text-align:center;">'.number_format($row["OPD_SOCIAL"]).'</td>
    <td style="text-align:center;">'.number_format($row["OPD_GENERA"]).'</td>
    <td style="text-align:center;">'.number_format($row["SURGI_SOCI"]).'</td>
    <td style="text-align:center;">'.number_format($row["SURGI_GENE"]).'</td>
    <td>&#160;&#160;'.$row["PT_NAME"].'</td>
    </tr>';
  }
  $htmlH .='</table>'; 
$pdf->Ln();
$pdf->writeHTML($htmlH, true, false, true, false, '');
$pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Details Regularly)');
}else{
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (รายละเอียดหมอเวร)');

  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT COUNT(RECORD) AS records FROM payroll_doctor WHERE DUTY = '2' and DATE ='".$_GET['dat']."'and CODE_NAME='".$_GET['id']."' ORDER BY DATE ASC";
  $show_record = $connect->query($record);
  $rec = mysqli_fetch_array($show_record);
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
    <tr>
    <td width="200px">List For Code_Name = '.$_GET['id'].'</td>
    </tr>
    <tr>
    <td width="200px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
    </tr>
    <tr>
    <td width="200px">'.$rec['records'].' Records Summed</td>
    </tr>
    </table>', $tc=array(0,0,0), $lc=array(0,0,0));

  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  $pdf->SetFont('thsarabun', '', 10);
  $pdf->AddPage();

  $htmlH ='<table border="1px">
  <tr style="text-align:center;">
  <th width="35px">RECORD#</th>
  <th width="40px">DATE</th>
  <th width="45px">CODE_NAME</th>
  <th width="30px">TIME1</th>
  <th width="30px">TIME2</th>
  <th width="80px">WORK</th>
  <th width="45px">OPD_SOCIAL</th>
  <th width="45px">OPD_GENERA</th>
  <th width="45px">DOCTORFEE</th>
  <th width="125px">PT_NAME</th>
  </tr>';

  $sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '2' and DATE ='".$_GET['dat']."'and CODE_NAME='".$_GET['id']."' ORDER BY DATE ASC";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.$row["RECORD"].'</td>
    <td style="text-align:center;">'.date("Y/m/d", strtotime($row["DATE"])).'</td>
    <td style="text-align:center;">'.$row["CODE_NAME"].'</td>
    <td style="text-align:center;">'.$row["TIME1"].'</td>
    <td style="text-align:center;">'.$row["TIME2"].'</td>
    <td style="text-align:center;">'.$row["WORK"].'</td>
    <td style="text-align:center;">'.number_format($row["OPD_SOCIAL"]).'</td>
    <td style="text-align:center;">'.number_format($row["OPD_GENERA"]).'</td>
    <td style="text-align:center;">'.number_format($row["DOCTORFEE"]).'</td>
    <td>&#160;&#160;'.$row["PT_NAME"].'</td>
    </tr>';
  }
  $htmlH .='</table>';
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Details OverTime)');
}
}else{
  header("Location: login.php");
  exit();
}
?>
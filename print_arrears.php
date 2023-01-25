<?php
include 'condb.php';
require_once('tcpdf/tcpdf.php');
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

class MYPDF extends TCPDF {
    public function Header() {
        $this->SetFont('thsarabun', '', 10);
        $headerData = $this->getHeaderData();
        $this->writeHTML($headerData['string']);
    }
    protected $last_page_flag = false;

    public function Close() {
      $this->last_page_flag = true;
      parent::Close();
    }
    function Footer(){
      $this->SetY(-30);
      $this->SetFont('thsarabun', '', 10);
      $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      if($this->last_page_flag){
          $footer_html = '<table style="font-size:11px;">
          <tr>
            <td width="230px"></td>
            <td width="290px">ลงชื่อ...............................................................พนักงานบัญชี</td>
          </tr><br/>
          <tr>
            <td width="230px"></td>
            <td width="290px">ลงชื่อ...............................................................รองผู้อํานวยการฝ่ายการเงินเเละบัญชี</td>
          </tr><br/>
          <tr>
            <td width="230px"></td>
            <td width="290px">ลงชื่อ...............................................................ผู้อํานวยการโรงพยาบาล</td>
          </tr>
          </table>'; //HTML for the footer on the last page
      }
      else{
          $this->SetY(-15);
          $footer_html = $this->Cell(200, 15, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M'); //HTML for the rest of the pages
      }
      $this->writeHTML($footer_html);
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

if($_GET['status'] == 0) { // 0 เท่ากับ เอาข้อมูลทั้งหมด 1 ปี | นอกนั้นเป็นเลือกปีกับเดือน

  $dats = isset($_GET['dat']) ? $_GET['dat'] : '';
  $ids = isset($_GET['id']) ? $_GET['id'] : '';

  $pdf->SetTitle($ids. '-'. $dats. '(ยอดค้างจ่าย 1 ปี เต็ม)');
  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT COUNT(af_id) AS records
             FROM arrearedfdoctor 
             WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $show_record = $connect->query($record);
  $rec = mysqli_fetch_array($show_record);
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
  <tr>
    <td width="220px"></td>
    <td width="200px"><h1>รายการค้างชําระ</h1></td>
  </tr>
  <tr>
    <td width="200px">List For Code_Name = '.$ids.'</td>
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
  <th width="70px">ลงวันที่</th>
  <th width="70px">รหัสเเพทย์</th>
  <th width="150px">รายละเอียดการรักษา</th>
  <th width="70px">ประกันอื่นๆ</th>
  <th width="150px">ชื่อคนไข้</th>
  </tr>';

  $sqld = "SELECT af_date_df_doctor, af_cash, af_id_doctor, af_name_patient
           FROM arrearedfdoctor 
           WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.$row["af_date_df_doctor"].'</td>
    <td style="text-align:center;">'.$row["af_id_doctor"].'</td>
    <td style="text-align:center;">Admit เยี่ยมไข้ หัตถการ</td>
    <td style="text-align:center;">'.number_format($row["af_cash"]).'</td>
    <td style="text-align:center;">'.$row["af_name_patient"].'</td>
    </tr>';
  }
  $sum = "SELECT SUM(af_cash)
          FROM arrearedfdoctor 
          WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $summed = $connect->query($sum);
  while($rox = $summed->fetch_assoc()) { 
    $htmlH .='</table>
    <table>
    <tr style="text-align:center;">
    <th width="220px"></th>
    <th width="140px" border="1px">ยอดค้างชําระทั้งหมด = '.number_format($rox["SUM(af_cash)"], 2).'</th>
    </tr>
    <tr style="text-align:center;">
    <th></th>
    <th></th>
    </tr>';
  }
  $htmlH .='</table>';
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Arrears 1 Year)');
} else { 
  // เลือกตามปี / เดือน
  $dats = isset($_GET['dat']) ? $_GET['dat'] : '';
  $ids = isset($_GET['id']) ? $_GET['id'] : '';

  $pdf->SetTitle($ids. '-'. $dats. ' (ค้างจ่าย)');
  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT COUNT(af_id) AS records
             FROM arrearedfdoctor 
             WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $show_record = $connect->query($record);
  $rec = mysqli_fetch_array($show_record);
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
  <tr>
    <td width="220px"></td>
    <td width="200px"><h1>รายการค้างชําระ</h1></td>
  </tr>
  <tr>
    <td width="200px">List For Code_Name = '.$ids.'</td>
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
  <th width="70px">ลงวันที่</th>
  <th width="70px">รหัสเเพทย์</th>
  <th width="150px">รายละเอียดการรักษา</th>
  <th width="70px">ประกันอื่นๆ</th>
  <th width="150px">ชื่อคนไข้</th>
  </tr>';

  $sqld = "SELECT af_date_df_doctor, af_cash, af_id_doctor, af_name_patient
           FROM arrearedfdoctor
           WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.$row["af_date_df_doctor"].'</td>
    <td style="text-align:center;">'.$row["af_id_doctor"].'</td>
    <td style="text-align:center;">Admit เยี่ยมไข้ หัตถการ</td>
    <td style="text-align:center;">'.number_format($row["af_cash"]).'</td>
    <td style="text-align:center;">'.$row["af_name_patient"].'</td>
    </tr>';
  }

  $sum = "SELECT SUM(af_cash)
          FROM arrearedfdoctor 
          WHERE af_date_df_doctor LIKE '%$dats%' and af_id_doctor LIKE '%$ids%' and af_status_pay LIKE '%0%'";
  $summed = $connect->query($sum);
  while($rox = $summed->fetch_assoc()) { 
    $htmlH .='</table>
    <table>
    <tr style="text-align:center;">
    <th width="220px"></th>
    <th width="140px" border="1px">ยอดค้างชําระทั้งหมด = '.number_format($rox["SUM(af_cash)"], 2).'</th>
    </tr>
    <tr style="text-align:center;">
    <th></th>
    <th></th>
    </tr>';
  }
  $htmlH .='</table>';
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Arrears)');
}
}else{
     header("Location: login.php");
     exit();
}
?>
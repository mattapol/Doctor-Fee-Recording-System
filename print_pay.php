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
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (จ่ายเเล้ว 1 ปี เต็ม)');
  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT CAST(af_status_pay_date AS date), SUM(CAST(af_cash AS INT)), af_id_doctor, af_name_patient
             FROM arrearedfdoctor 
             WHERE YEAR(af_status_pay_date)='".$_GET['dat']."' and af_id_doctor='".$_GET['id']."' 
             GROUP BY af_status_pay_date, af_name_patient";
  $show_record = $connect->query($record);
  $row_count = $show_record->num_rows;
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
  <tr>
    <td width="215px"></td>
    <td width="200px"><h1>รายการจ่ายชําระเเล้ว</h1></td>
  </tr>
  <tr>
    <td width="200px">List For Code_Name = '.$_GET['id'].'</td>
  </tr>
  <tr>
    <td width="200px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
  </tr>
  <tr>
    <td width="200px">'.$row_count.' Records Summed</td>
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

  $sqld = "SELECT CAST(af_status_pay_date AS date), SUM(CAST(af_cash AS INT)), af_id_doctor, af_name_patient
           FROM arrearedfdoctor 
           WHERE YEAR(af_status_pay_date)='".$_GET['dat']."' and af_id_doctor='".$_GET['id']."' 
           GROUP BY af_status_pay_date, af_name_patient";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.date("Y/m/d", strtotime($row["CAST(af_status_pay_date AS date)"])).'</td>
    <td style="text-align:center;">'.$row["af_id_doctor"].'</td>
    <td style="text-align:center;">Admit เยี่ยมไข้ หัตถการ</td>
    <td style="text-align:center;">'.number_format($row["SUM(CAST(af_cash AS INT))"]).'</td>
    <td style="text-align:center;">'.$row["af_name_patient"].'</td>
    </tr>';
  }
  $sum = "SELECT SUM(CAST(af_cash AS int)) AS cash
          FROM arrearedfdoctor 
          WHERE YEAR(af_date_df_doctor)='".$_GET['dat']."' and af_id_doctor='".$_GET['id']."'";
  $summed = $connect->query($sum);
  $rox = $summed->fetch_assoc();

  $setup = "SELECT sf_id, CAST(sf_setup AS int) AS vat 
            FROM setupdf
            ORDER BY sf_id DESC
            LIMIT 1";
  $set = $connect->query($setup);
  $ros = $set->fetch_assoc();

  $vats = ($rox["cash"] / 100) * $ros["vat"];
  $cashvat = $rox["cash"] - $vats;
  $htmlH .='</table>
  <table>
  <tr style="text-align:center;">
    <th width="220px"></th>
    <th width="140px" border="1px">ยอดจ่ายชําระเเล้วทั้งหมด = '.number_format($rox["cash"], 2).'</th>
  </tr>
  <tr style="text-align:center;">
    <th></th>
    <th></th>
  </tr>
  </table><br/>
  <table style="font-size:12px;">
  <tr>
    <td width="360px"></td>
    <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="'.number_format($rox["cash"], 2).'" size="15"/></td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">หักภาษี '.$ros['vat'].'% : &#160;<input type="text" name="vat" value="'.number_format($vats, 2).'" size="15"/></td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="'.number_format($cashvat, 2).'" size="15"/></td>
  </tr>
  </table>';
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Paid 1 Year)');
} else { 
  // เลือกตามปี / เดือน
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (จ่ายเเล้ว)');
  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT CAST(af_status_pay_date AS date), SUM(CAST(af_cash AS INT)), af_id_doctor, af_name_patient
             FROM arrearedfdoctor
             WHERE af_status_pay_date BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and af_id_doctor='".$_GET['id']."' 
             GROUP BY af_status_pay_date, af_name_patient";
  $show_record = $connect->query($record);
  $row_count = $show_record->num_rows;
  $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
  <tr>
    <td width="215px"></td>
    <td width="200px"><h1>รายการจ่ายชําระเเล้ว</h1></td>
  </tr>
  <tr>
    <td width="200px">List For Code_Name = '.$_GET['id'].'</td>
  </tr>
  <tr>
    <td width="200px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
  </tr>
  <tr>
    <td width="200px">'.$row_count.' Records Summed</td>
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

  $sqld = "SELECT CAST(af_status_pay_date AS date), SUM(CAST(af_cash AS INT)), af_id_doctor, af_name_patient
           FROM arrearedfdoctor
           WHERE af_status_pay_date BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and af_id_doctor='".$_GET['id']."' 
           GROUP BY af_status_pay_date, af_name_patient";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $htmlH .='<tr>
    <td style="text-align:center;">'.date("Y/m/d", strtotime($row["CAST(af_status_pay_date AS date)"])).'</td>
    <td style="text-align:center;">'.$row["af_id_doctor"].'</td>
    <td style="text-align:center;">Admit เยี่ยมไข้ หัตถการ</td>
    <td style="text-align:center;">'.number_format($row["SUM(CAST(af_cash AS INT))"]).'</td>
    <td style="text-align:center;">'.$row["af_name_patient"].'</td>
    </tr>';
  }

  $sum = "SELECT SUM(CAST(af_cash AS int)) AS cash
          FROM arrearedfdoctor 
          WHERE af_status_pay_date BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and af_id_doctor='".$_GET['id']."'";
  $summed = $connect->query($sum);
  $rox = $summed->fetch_assoc();

  $setup = "SELECT sf_id, CAST(sf_setup AS int) AS vat 
            FROM setupdf
            ORDER BY sf_id DESC
            LIMIT 1";
  $set = $connect->query($setup);
  $ros = $set->fetch_assoc();

  $vats = ($rox["cash"] / 100) * $ros["vat"];
  $cashvat = $rox["cash"] - $vats;
 
  $htmlH .='</table>
  <table>
  <tr style="text-align:center;">
    <th width="220px"></th>
    <th width="140px" border="1px">ยอดจ่ายชําระเเล้วทั้งหมด = '.number_format($rox["cash"], 2).'</th>
  </tr>
  <tr style="text-align:center;">
    <th></th>
    <th></th>
  </tr>
  </table><br/>
  <table style="font-size:12px;">
  <tr>
    <td width="360px"></td>
    <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="'.number_format($rox["cash"], 2).'" size="15"/></td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">หักภาษี '.$ros['vat'].'% : &#160;<input type="text" name="vat" value="'.number_format($vats, 2).'" size="15"/></td>
  </tr>
  <tr>
    <td width="360px"></td>
    <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="'.number_format($cashvat, 2).'" size="15"/></td>
  </tr>
  </table>';
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Paid)');
} 
}else{
     header("Location: login.php");
     exit();
}
?>
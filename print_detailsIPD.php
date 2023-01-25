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

$pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (รายละเอียด)');
$name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
$show_name = $connect->query($name);
$sn = mysqli_fetch_array($show_name);
$record = "SELECT *
           FROM dataipd
           WHERE di_date_df_doctor BETWEEN '".$_GET['dat']."' and '".$_GET['dat']."' and di_id_doctor='".$_GET['id']."' 
           ORDER BY di_date_df_doctor";
$show_record = $connect->query($record);
$row_count = $show_record->num_rows;
$pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='<table>
<tr>
  <td width="220px"></td>
  <td width="200px"><h1>รายละเอียด IPD</h1></td>
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
<th width="40px">ลงวันที่</th>
<th width="35px">รหัสเเพทย์</th>
<th width="110px">รายละเอียดการรักษา</th>
<th width="50px">วันที่_ADMIN</th>
<th width="50px">ประกันอื่นๆ</th>
<th width="50px">เงินสด</th>
<th width="60px">ชื่อผู้ป่วย</th>
<th width="40px">HN</th>
<th width="20px">สิทธิ</th>
<th width="55px">Bill No.</th>
</tr>';
$sqld = "SELECT *
         FROM dataipd
         WHERE di_date_df_doctor BETWEEN '".$_GET['dat']."' and '".$_GET['dat']."' and di_id_doctor='".$_GET['id']."' 
         ORDER BY di_date_df_doctor";
$resultd = $connect->query($sqld);
while($row = $resultd->fetch_assoc()) { 
  $htmlH .='<tr>
  <td style="text-align:center;">'.date("Y/m/d", strtotime($row["di_date_df_doctor"])).'</td>
  <td style="text-align:center;">'.$row["di_id_doctor"].'</td>
  <td style="text-align:center;">'.$row["di_details_treat"].'</td>
  <td style="text-align:center;">'.$row["di_date_acp"].'</td>
  <td style="text-align:center;">'.number_format((int)$row["di_ssp"]).'</td>
  <td style="text-align:center;">'.number_format((int)$row["di_cash"]).'</td>
  <td style="text-align:center;">'.$row["di_name_patient"].'</td>
  <td style="text-align:center;">'.$row["di_HN"].'</td>
  <td style="text-align:center;">'.$row["di_right"].'</td>
  <td style="text-align:center;">'.$row["di_id_bill"].'</td>
  </tr>';
}
$htmlH .='</table>';
$pdf->Ln();
$pdf->writeHTML($htmlH, true, false, true, false, '');
$pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Details_IPD)');
}else{
  header("Location: login.php");
  exit();
}
?>
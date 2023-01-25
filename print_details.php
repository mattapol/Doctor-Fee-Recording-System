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
      $this->SetY(-80);
      $this->SetFont('thsarabun', '', 10);
      $this->SetAutoPageBreak(TRUE, 65);
      
      include 'condb_original.php';
      $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
      $show_name = $connect->query($name);
      $sn = mysqli_fetch_array($show_name);
      if($this->last_page_flag){

      
          $footer_html = '<table style="font-size:13px;">
          <tr>
            <td width="360px"></td>
            <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
          </tr>
          <tr>
            <td width="360px"></td>
            <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="999999" size="15"/></td>
          </tr>
          <tr>
            <td width="360px"></td>
            <td width="160px">หัก การันตี&#160; : &#160;<input type="text" name="karuntee" value="" size="15"/></td>
          </tr>
          <tr>
            <td width="360px"></td>
            <td width="160px">คงเหลือ&#160;&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total2" value="" size="15"/></td>
          </tr>
          <tr>
            <td width="360px"></td>
            <td width="160px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="15"/></td>
          </tr>
          <tr>
            <td width="360px"></td>
            <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="15"/></td>
          </tr><br/><br/>
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


if ($_GET['duty'] == 1) {
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (หมอประจํา)');

  $name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $record = "SELECT COUNT(RECORD) AS records FROM payroll_doctor WHERE DUTY = '1' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."' ORDER BY type_treat ASC, extra ASC, DATE ASC";
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

  $sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '1' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."' ORDER BY type_treat ASC, extra ASC, DATE ASC";
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $text = explode(",",$row["PT_NAME"]);
    $t1 = '';
    $array = count($text);
    for($i=0; $i<3; $i++){
        if($t1==''){
          $t1=$text[$i];
        }
        else{
          if(isset($text[$i])){
            $t1 .=$text[$i];
          }
        }
    }
    $htmlH .='<tr>
    <td style="text-align:center;">'.$row["RECORD"].'</td>
    <td style="text-align:center;">'.date("Y/m/d", strtotime($row["DATE"])).'</td>
    <td style="text-align:center;">'.$row["CODE_NAME"].'</td>
    <td style="text-align:center;">'.$row["WORK"].'</td>
    <td style="text-align:center;">'.number_format($row["OPD_SOCIAL"]).'</td>
    <td style="text-align:center;">'.number_format($row["OPD_GENERA"]).'</td>
    <td style="text-align:center;">'.number_format($row["SURGI_SOCI"]).'</td>
    <td style="text-align:center;">'.number_format($row["SURGI_GENE"]).'</td>
    <td>&#160;&#160;'.$t1.'</td>
    </tr>';
  }
  $htmlH .='</table>
  <table border="1px">
  <tr style="text-align:center;">
  <th width="100px">OPD_SOCIAL</th>
  <th width="100px">OPD_GENERA</th>
  <th width="95px">SURGI_SOCI</th>
  <th width="95px">SURGI_GENE</th>
  <th width="130px">TOTAL</th>
  </tr>';

  $sum = "SELECT SUM(OPD_SOCIAL), SUM(OPD_GENERA), SUM(SURGI_SOCI), SUM(SURGI_GENE), SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE) 
          FROM payroll_doctor 
          WHERE DUTY = '1' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."'";
  $summed = $connect->query($sum);
  while($roww = $summed->fetch_assoc()) { 
    $htmlH .='<tr style="text-align:center;">
    <th>'.number_format($roww["SUM(OPD_SOCIAL)"]).'</th>
    <th>'.number_format($roww["SUM(OPD_GENERA)"]).'</th>
    <th>'.number_format($roww["SUM(SURGI_SOCI)"]).'</th>
    <th>'.number_format($roww["SUM(SURGI_GENE)"]).'</th>
    <th>'.number_format($roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"]).'</th>
    </tr>
    </table><br/><br/><br/>';
    if ($_GET['id'] != '09909') {
      $htmlH .='<table style="font-size:13px;">
      <tr>
        <td width="360px"></td>
        <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
      </tr>
      <tr>
        <td width="360px"></td>
        <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="'.number_format($roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"]).'" size="15"/></td>
      </tr>
      <tr>
        <td width="360px"></td>
        <td width="160px">หัก การันตี&#160; : &#160;<input type="text" name="karuntee" value="" size="15"/></td>
      </tr>
      <tr>
        <td width="360px"></td>
        <td width="160px">คงเหลือ&#160;&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total2" value="" size="15"/></td>
      </tr>
      <tr>
        <td width="360px"></td>
        <td width="160px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="15"/></td>
      </tr>
      <tr>
        <td width="360px"></td>
        <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="15"/></td>
      </tr><br/><br/>
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
      </table>';
    }else{
      $htmlH .='<table style="font-size:13px;">
      <tr>
        <td width="40px"></td>
        <td width="120px">* '.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
        <td width="120px"></td>
        <td width="120px"></td>
        <td width="120px"></td>
      </tr>
      <tr>
        <td width="40px"></td>
        <td width="120px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="'.number_format($roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"]).'" size="12"/></td>
        <td width="120px"></td>
        <td width="120px"></td>
        <td width="120px"></td>
      </tr>
      <tr>
        <td width="40px"></td>
        <td width="120px">หัก การันตี&#160; : &#160;<input type="text" name="karuntee" value="" size="12"/></td>
        <td width="120px">* <input type="text" name="name" value="" size="20"/></td>
        <td width="120px">* <input type="text" name="name" value="" size="20"/></td>
        <td width="120px">* <input type="text" name="name" value="" size="20"/></td>
      </tr>
      <tr>
        <td width="40px"></td>
        <td width="120px">คงเหลือ&#160;&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total2" value="" size="12"/></td>
        <td width="120px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="" size="12"/></td>
        <td width="120px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="" size="12"/></td>
        <td width="120px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="" size="12"/></td>
      </tr>
      <tr>
        <td width="40px"></td>
        <td width="120px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="12"/></td>
        <td width="120px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="12"/></td>
        <td width="120px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="12"/></td>
        <td width="120px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="" size="12"/></td>
      </tr>
      <tr>
        <td width="40px"></td>
        <td width="120px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="12"/></td>
        <td width="120px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="12"/></td>
        <td width="120px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="12"/></td>
        <td width="120px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="" size="12"/></td>
      </tr><br/><br/>
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
      </table>';
    }
  }
  $pdf->Ln();
  $pdf->writeHTML($htmlH, true, false, true, false, '');
  $pdf->Cell(0, 15, 'ข้อความที่จะแสดง', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  $pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (Regularly)');
}else{
$pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (หมอเวร)');

$name = "SELECT NAME_TITLE, NAME, LAST_NAME FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
$show_name = $connect->query($name);
$sn = mysqli_fetch_array($show_name);

$record = "SELECT COUNT(RECORD) AS records FROM payroll_doctor WHERE DUTY = '2' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."' ORDER BY type_treat ASC, extra ASC, DATE ASC";
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

$sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '2' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."' ORDER BY type_treat ASC, extra ASC, DATE ASC";
$resultd = $connect->query($sqld);
while($row = $resultd->fetch_assoc()) { 
  $text = explode(",",$row["PT_NAME"]);
  $t1 = '';
  $array = count($text);
  for($i=0; $i<3; $i++){
      if($t1==''){
        $t1=$text[$i];
      }
      else{
        if(isset($text[$i])){
          $t1 .=$text[$i];
        }
      }
  }
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
  <td>&#160;&#160;'.$t1.'</td>
  </tr>';
}
$htmlH .='</table>
<table border="1px">
<tr style="text-align:center;">
<th width="70px">OPD_SOCIAL</th>
<th width="70px">OPD_GENERA</th>
<th width="70px">DOCTORFEE</th>
<th width="90px">TOTAL</th>
<th width="95px">VAT3%</th>
<th width="125px">SUMMARIZE</th>
</tr>';

$sum = "SELECT SUM(OPD_SOCIAL), SUM(OPD_GENERA), SUM(DOCTORFEE), SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE), ((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3, SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3 
        FROM payroll_doctor 
        WHERE DUTY = '2' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."'";
$summed = $connect->query($sum);
while($rox = $summed->fetch_assoc()) { 
  $htmlH .='<tr style="text-align:center;">
  <th>'.number_format($rox["SUM(OPD_SOCIAL)"]).'</th>
  <th>'.number_format($rox["SUM(OPD_GENERA)"]).'</th>
  <th>'.number_format($rox["SUM(DOCTORFEE)"]).'</th>
  <th>'.number_format($rox["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE)"]).'</th>
  <th>'.number_format($rox["((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3"], 2).'</th>
  <th>'.number_format($rox["SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3"], 2).'</th>
  </tr>';
$htmlH .='</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<table style="font-size:13px;">
<tr>
  <td width="360px"></td>
  <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
</tr>
<tr>
  <td width="360px"></td>
  <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;<input type="text" name="total" value="'.number_format($rox["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE)"], 2).'" size="15"/></td>
</tr>
<tr>
  <td width="360px"></td>
  <td width="160px">หัก ภาษี3% : &#160;<input type="text" name="vat" value="'.number_format($rox["((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3"], 2).'" size="15"/></td>
</tr>
<tr>
  <td width="360px"></td>
  <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;<input type="text" name="sum" value="'.number_format($rox["SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3"], 2).'" size="15"/></td>
</tr><br/><br/>
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
</table>';
}
$pdf->Ln();
$pdf->writeHTML($htmlH, true, false, true, false, '');
$pdf->Output($_GET['id']. '-'. $_GET['dat']. ' (OverTime)');
}
}else{
  header("Location: login.php");
  exit();
}
?>
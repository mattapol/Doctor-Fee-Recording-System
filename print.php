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
  $pdf->SetTitle($_GET['id']. '-'. $_GET['dat']. ' (หมอประจํา)');
  $sqlper = "SELECT * FROM setupdf WHERE sf_id = '1'";
  $sedper = $connect->query($sqlper);
  $per = mysqli_fetch_array($sedper);

  $name = "SELECT NAME_TITLE, NAME, LAST_NAME ,salary,guarantee  FROM name_doctor WHERE CODE_NAME='".$_GET['id']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);

  $sqlarreare = "SELECT sum(af_cash) as cach  FROM arrearedfdoctor WHERE af_id_doctor='".$_GET['id']."'and af_date_df_doctor BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31'";
  $show_arreare = $connect->query($sqlarreare);
  $arreare = mysqli_fetch_array($show_arreare);
  if ($arreare['cach'] == '') {
    $arr = 0;
  }else{
    $arr = $arreare['cach'];
  }
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
    if ($array > 3 ) {

      $runt = 3;

    }else{
      $runt = $array;

    }
    for($i=0; $i<$runt; $i++){
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

  $sum = "SELECT SUM(OPD_SOCIAL),  SUM(OPD_GENERA), SUM(SURGI_SOCI), SUM(SURGI_GENE), SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE) 
  FROM payroll_doctor 
  WHERE DUTY = '1' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."'";
  //echo $sum; die;
  $summed = $connect->query($sum);
  $remaining  = 0;
  $perchen = 0;
  $conghern = 0 ;
  $perchen1 = 0;
  $sumDF = 0;
  $arrearsDF = 0 ;
  if ($sn['guarantee']) {
   $sumrumty = $sn['guarantee'];
 }else{
  $sumrumty = 0;
}
$suning = 0;
while($roww = $summed->fetch_assoc()) { 
  $sumDF = $roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"] +$arr;
    //echo $sumDF; die;
    //$sumrumty การันตี
    //$sumDF ยอดรวมทั้งหมด
     //$sumreainig ยอดคงเหลือ
    // $arr ค้างจ่าย
    //$arrearsDF ยอดจ่าย
    //$perchen1 ยอดหักภาษี
    //$conghern จ่ายสุทธิ  
    //print_r($_GET['id']); die;
  if ($_GET['id'] != '32253' && $_GET['id'] != '37142'&& $_GET['id'] != '21944' && $_GET['id'] != '5916'  ) {

    if ($sumrumty != 0) {
      if ($sumDF > $sumrumty) {
        $remaining = $sumDF -$sumrumty;
        $arrearsDF = $remaining - $arr;
        $suning = $remaining;    
        $sumreainig = number_format($suning,2, '.', ',');      
        $perchen = ($per['sf_setup']/100) *$arrearsDF;
        $perchen1 =  number_format($perchen,2, '.', ',');
        $conghern = $arrearsDF - $perchen;


        if ($arr > $remaining) {

          $arr = $remaining;
          $arrearsDF = 0;
          $perchen1 = 0;
          $conghern = 0;        
        }    
      }else{
      //echo 1 ; die;
        $sumreainig = 0;
      }
    }else{
      $arrearsDF = $sumDF ;
      $remaining = $arrearsDF;
      $perchen = ($per['sf_setup']/100) * $remaining;
      $perchen1 =  number_format($perchen,2, '.', ',');
      $sumreainig = number_format($remaining,2, '.', ',');
      $conghern = $remaining - $perchen;
    }
  }else{
    $arrearsDF = $sumDF ;
    $remaining = $arrearsDF;
    $perchen = ($per['sf_setup']/100) * $remaining;
    $perchen1 =  number_format($perchen,2, '.', ',');
    $sumreainig = number_format($remaining,2, '.', ',');
    $conghern = $remaining - $perchen;

    if ($sumrumty > $sumDF  ) {
      $arrearsDF = $sumrumty ;
      $remaining = $arrearsDF;
      $perchen = ($per['sf_setup']/100) * $remaining;
      $perchen1 =  number_format($perchen,2, '.', ',');
      $sumreainig = number_format($remaining,2, '.', ',');
      $conghern = $remaining - $perchen;

    }
    //print_r($_GET['id']); die;
    if ($_GET['id'] == '32253' || $_GET['id'] == '37142'|| $_GET['id'] == '21944') {
      //echo '2'; die;
     if ($sumDF > $sumrumty) {
      $sumrumty = 0;
    }
  }


  if ($_GET['id'] == '5916') {

    if ($sumDF > $sumrumty) {

      $remaining = $sumDF -$sumrumty;
      $arrearsDF = $remaining ;

      $arrearsDF = $arrearsDF/2;
      $perchen = ($per['sf_setup']/100) * $arrearsDF;
      $perchen1 =  number_format($perchen,2, '.', ',');
      $sumreainig = number_format($remaining,2, '.', ',');
      $conghern = $arrearsDF - $perchen;

    }else{
     $sumreainig = 0;
     $sumrumty = 85000;
     $arrearsDF = 0;
     $perchen1 = 0;
     $conghern = 0; 
   }

 }


}
$htmlH .='<tr style="text-align:center;">
<th>'.number_format($roww["SUM(OPD_SOCIAL)"]).'</th>
<th>'.number_format($roww["SUM(OPD_GENERA)"]).'</th>
<th>'.number_format($roww["SUM(SURGI_SOCI)"]).'</th>
<th>'.number_format($roww["SUM(SURGI_GENE)"]).'</th>
<th>'.number_format($roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"]).'</th>
</tr>
</table><br/><br/><br/>';

$htmlH .='<table style="font-size:13px;">
<tr>
<td width="360px"></td>
<td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;'.number_format( $sumDF,2, '.', ',').'</td>
</tr>

<tr>
<td width="360px"></td>
<td width="160px">หัก การันตี&#160; : &#160;'.number_format($sumrumty,2, '.', ',').'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">คงเหลือ&#160;&#160;&#160;&#160;&#160;&#160;: &#160;'.$sumreainig.'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">ค้างจ่าย&#160;&#160;&#160;&#160;&#160; : &#160;'.number_format($arr,2, '.', ',').'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">ยอดจ่าย&#160;&#160;&#160;&#160;&#160;: &#160;'.number_format( $arrearsDF,2, '.', ',').'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">หัก ภาษี'.$per['sf_setup'].'%&#160;: &#160;'.$perchen1.'</td>
</tr>
<tr>
<td width="360px"></td>
<td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160;&#160;&#160;: &#160;'.number_format($conghern,2, '.', ',').'</td>
</tr>

<br/><br/>
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
// echo $sqld;
// die;
  $resultd = $connect->query($sqld);
  while($row = $resultd->fetch_assoc()) { 
    $text = explode(",",$row["PT_NAME"]);
    $t1 = '';

    $array = count($text);
    if ($array > 3 ) {

      $runt = 3;

    }else{
      $runt = $array;

    }
    for($i=0; $i< $runt; $i++){
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

  $sum = "SELECT SUM(OPD_SOCIAL),  SUM(OPD_GENERA), SUM(DOCTORFEE), SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE), ((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3, SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3 
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
    $htmlH .='</table><br/><br/><br/>
    <table style="font-size:13px;">
    <tr>
    <td width="360px"></td>
    <td width="160px">'.$sn['NAME_TITLE'].'.'.$sn['NAME'].' '.$sn['LAST_NAME'].'</td>
    </tr>
    <tr>
    <td width="360px"></td>
    <td width="160px">ยอดรวม&#160;&#160;&#160;&#160; : &#160;'.number_format($rox["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE)"]).'</td>
    </tr>
    <tr>
    <td width="360px"></td>
    <td width="160px">หัก ภาษี3% : &#160;'.number_format($rox["((SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(DOCTORFEE))/100)*3"], 2).'</td>
    </tr>
    <tr>
    <td width="360px"></td>
    <td width="160px">จ่ายสุทธิ&#160;&#160;&#160;&#160; : &#160;'.number_format($rox["SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE) - (SUM(OPD_SOCIAL + OPD_GENERA + DOCTORFEE)/100)*3"], 2).'</td>
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
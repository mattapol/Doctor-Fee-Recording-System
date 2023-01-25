$(document).ready(function(){

  seachListDoctor();
  listmonthdoctor();
  printPost();
  Editlist();
  Editregular();
  detailsIPD();
  EditIPD();
  deleteDetailIPD();
  deleteDetailOPDA();
  delIpddate();
  EditDoctorName();
  EditDoctorS();
  deleDoctorN();
  addDoctorName();
  addDoctorS();
  setupDoctorS();
  moveDF();
  seachListstale();
  PrintListstale();
  Prant_Listsarr();
  seachListDoctor1();
  uturdD();
  listPay();
  Payone();
  listPaybill();
  Payonebill();
  seachListstalepay();
  printPostconcludeDetieat();
  print_details();
  printPostconclude();
  print_details2();
  Prant_Listsarrpay();

});


function printPostconcludeDetieat(){
  $(document).on('click','#printPostconcludeDetieat',function(e){
    e.stopImmediatePropagation();
    var id = $(this).attr('data-id');
    var classPreview = 'listEdit';
    var hasder = 'เลือกวันเดือนปี';
    var linkModal = lines+'concludePrint.php?id='+id;
    var styModal = '';
    var bt = 'searchDate';
    var TextTb = 'ปริ้น';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}
function print_details(){
   $(document).on('click','#searchDate',function(e){
    e.stopImmediatePropagation();
    var id = $('#id').val();
    var day = $('#dayconclude').val();
    var month = $('#monthsconclude').val();
    var year = $('#yearsconclude').val();
    if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;
    }
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    if (day == '') {
      swal("กรุณาเลือกวัน");
      return false;

    }
    var DMY = year+'-'+month+'-'+day;
    var link = lines+'print_detailsIPD.php?id='+id+'&dat='+DMY;
    window.open(link);
    closeModalAutos();

  });


}

function printPostconclude(){
  $(document).on('click','#printPostconclude',function(e){
    e.stopImmediatePropagation();
    var id = $(this).attr('data-id');
    var classPreview = 'listEdit';
    var hasder = 'เลือกวันเดือนปี';
    var linkModal = lines+'concludePrintD.php?id='+id;
    var styModal = '';
    var bt = 'searchDate2';
    var TextTb = 'ปริ้น';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}
function print_details2(){
   $(document).on('click','#searchDate2',function(e){
    e.stopImmediatePropagation();
    var id = $('#id').val();
    var day = $('#dayconclude').val();
    var month = $('#monthsconclude').val();
    var year = $('#yearsconclude').val();
    if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;
    }
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    if (day == '') {
      swal("กรุณาเลือกวัน");
      return false;

    }
    var DMY = year+'-'+month+'-'+day;
    var duty = '1';
    var link = lines+'print_details_oneday.php?id='+id+'&dat='+DMY+'&duty='+duty;
    window.open(link);
    closeModalAutos();

  });


}





function seachListDoctor(){
  $(document).on('click','#listDoctorRegular',function(e){
    e.stopImmediatePropagation();
    
    var idstatusDoctor = $(this).attr('data-id');
    if (idstatusDoctor == '2') {

      var m = 'months';
      var y = 'years';
    }else{
      var m = 'month';
      var y = 'year';

    }
    var month = $('#'+m).val();
    var year = $('#'+y).val();
    if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;
    }
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    var ln = lines+'processListdoctor.php?d=1';
    $.post(ln,{'month':month,'year':year,'idstatusDoctor':idstatusDoctor},function(data){
     if (data == '0') {
      swal("ไม่พบข้อมูลที่ระบุ");
    }else{

      $('.listDoctorRegulard').html('');
      $('.listDoctorRegulard').html(data);
    }
  });


  });

}

function seachListDoctor1(){
  $(document).on('click','#listDoctorRegularss',function(e){
    e.stopImmediatePropagation();
    
    var idstatusDoctor = $(this).attr('data-id');
    if (idstatusDoctor == '2') {

      var m = 'months';
      var y = 'years';
    }else{
      var m = 'month';
      var y = 'year';

    }
    var month = $('#'+m).val();
    var year = $('#'+y).val();
    if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;
    }
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    var ln = lines+'processListdoctor.php?d=1';
    $.post(ln,{'month':month,'year':year,'idstatusDoctor':idstatusDoctor},function(data){
     if (data == '0') {
      swal("ไม่พบข้อมูลที่ระบุ");
    }else{

      $('.listDoctorRegular1').html('');
      $('.listDoctorRegular1').html(data);
    }
  });


  });

}



function seachListstale(){
  $(document).on('click','#liststale',function(e){
    e.stopImmediatePropagation();
    
    var idstatusDoctor = $('#searchNaDoctor').val();
    var monthsDoctor = $('#monthsDoctor').val();
    var yearsdortor = $('#yearsdortor').val();
    if (idstatusDoctor == '') {
      swal("กรุณาเลือกแพทย์ที่ต้องการตรวจสอบข้อมูล");
      return false;

    }
    if (monthsDoctor == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (yearsdortor == '') {
      swal("กรุณาเลือกปี");
      return false;

    }

    var ln = lines+'processListdoctor.php?d=liserselt';
    $.post(ln,{'idstatusDoctor':idstatusDoctor,'monthsDoctor':monthsDoctor,'yearsdortor':yearsdortor},function(data){
     //debugger;
     if (data == '0') {
      swal("ไม่พบข้อมูลที่ระบุ");
    }else{
      $('.listDoctorRegular2').html('');
      $('.listDoctorRegular2').html(data);
    }
  });


  });

}

function seachListstalepay(){
  $(document).on('click','#liststalepay',function(e){
    e.stopImmediatePropagation();
    
    var idstatusDoctor = $('#searchNaDoctorpay').val();
    var monthsDoctor = $('#monthsDoctdpay').val();
    var yearsdortor = $('#yearsdortorpay').val();
    if (idstatusDoctor == '') {
      swal("กรุณาเลือกแพทย์ที่ต้องการตรวจสอบข้อมูล");
      return false;

    }
    if (monthsDoctor == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (yearsdortor == '') {
      swal("กรุณาเลือกปี");
      return false;

    }

    var ln = lines+'processListdoctor.php?d=liserseltpay';
    $.post(ln,{'idstatusDoctor':idstatusDoctor,'monthsDoctor':monthsDoctor,'yearsdortor':yearsdortor},function(data){
     //debugger;
     if (data == '0') {
      swal("ไม่พบข้อมูลที่ระบุ");
    }else{

      $('.listDoctorRegular3').html('');
      $('.listDoctorRegular3').html(data);
    }
  });


  });

}


function Prant_Listsarr(){
  $(document).on('click','#Printlistss',function(e){
    e.stopImmediatePropagation();
    var idstatusDoctor = $('#searchNaDoctor').val();
    var monthsDoctor = $('#monthsDoctor').val();
    var yearsdortor = $('#yearsdortor').val();
    if (idstatusDoctor == '') {
      swal("กรุณาเลือกแพทย์ที่ต้องการตรวจสอบข้อมูล");
      return false;

    }
    if (monthsDoctor == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (yearsdortor == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    if (monthsDoctor == '0') {
      var y = yearsdortor;
    }else{
      var y = yearsdortor+'-'+monthsDoctor;
    }
    var link = lines+'print_arrears.php?status='+monthsDoctor+'&id='+idstatusDoctor+'&dat='+y;
    window.open(link);

  });

}

function Prant_Listsarrpay(){
  $(document).on('click','#Printlistsspay',function(e){
    e.stopImmediatePropagation();
    var idstatusDoctor = $('#searchNaDoctorpay').val();
    var monthsDoctor = $('#monthsDoctdpay').val();
    var yearsdortor = $('#yearsdortorpay').val();
    if (idstatusDoctor == '') {
      swal("กรุณาเลือกแพทย์ที่ต้องการตรวจสอบข้อมูล");
      return false;

    }
    if (monthsDoctor == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (yearsdortor == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
    if (monthsDoctor == '0') {
      var y = yearsdortor;
    }else{
      var y = yearsdortor+'-'+monthsDoctor;
    }
    var link = lines+'print_pay.php?status='+monthsDoctor+'&id='+idstatusDoctor+'&dat='+y;
    window.open(link);

  });

}

function PrintListstale(){
  $(document).on('click','#Printlist',function(e){
    e.stopImmediatePropagation();
    
    var idstatusDoctor = $('#searchNaDoctor').val();
    var monthsDoctor = $('#monthsDoctor').val();
    var yearsdortor = $('#yearsdortor').val();
    if (idstatusDoctor == '') {
      swal("กรุณาเลือกแพทย์ที่ต้องการตรวจสอบข้อมูล");
      return false;

    }
    if (monthsDoctor == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (yearsdortor == '') {
      swal("กรุณาเลือกปี");
      return false;

    }

    var link = lines+'print_arrears.php?duty='+typeDoctor+'&id='+iddoctor+'&dat='+dateDF;
    window.open(link);


  });

}



function listmonthdoctor(){
  $(document).on('click','#listmonthdoctor',function(e){
    e.stopImmediatePropagation();
    var dateDF = $(this).attr('data-monthrun');
    var iddoctor = $(this).attr('data-id');
    var idtypeDoctor = $(this).attr('data-typedoctor');
    var extra = $(this).attr('data-extra');

    var classPreview = 'listDetalM';
    var hasder = 'รายละเอียดรายการ';
    var linkModal = lines+'listDFdoctor.php?dat='+dateDF+'&id='+iddoctor+'&idtypeDoctor='+idtypeDoctor;
    var styModal = '';
    var bt = '';
    var TextTb = '';
    
    previewModal(linkModal,classPreview,hasder,styModal,TextTb,bt);

  });

}

function printPost(){
  $(document).on('click','#printPost',function(e){
    e.preventDefault();
    var dateDF = $(this).attr('data-monthrun');
    var iddoctor = $(this).attr('data-id');
    var typeDoctor = $(this).attr('data-typedoctor');
    var link = lines+'print.php?duty='+typeDoctor+'&id='+iddoctor+'&dat='+dateDF;
    window.open(link);
    
    

  });

}

function Editlist(){
  $(document).on('click','#editD',function(e){
    e.stopImmediatePropagation();
    var statudEdit = $(this).attr('data-statusedit');
    var id = $(this).attr('data-id');
    var numberD = $(this).attr('data-number');
    var dateDFdoctor = $(this).attr('data-date');
    var typedoctor = $(this).attr('data-typedoctor');
    var classPreview = 'listEdit';
    var hasder = 'แก้ไขรายการ';
    var linkModal = lines+'listEditregular.php?id='+id+'&statudEdit='+statudEdit+'&numberD='+numberD+'&dateDFdoctor='+dateDFdoctor+'&typedoctor='+typedoctor;
    var styModal = '';
    var bt = 'editDF';
    var TextTb = 'แก้ไข';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}

function listPay(){
  $(document).on('click','#pay',function(e){
    e.stopImmediatePropagation();
    var id = $(this).attr('data-id');
    var total = $(this).attr('data-total');
    var classPreview = 'listEdit';
    var hasder = 'เลือกเดือนที่จ่าย';
    var linkModal = lines+'payDate.php?id='+id+'&total='+total;
    var styModal = 'mini';
    var bt = 'payDates';
    var TextTb = 'จ่าย';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}

function listPaybill(){
  $(document).on('click','#paybill',function(e){
    e.stopImmediatePropagation();
    var total = $(this).attr('data-total');
    var classPreview = 'listEdit';
    var hasder = 'จ่ายตามบิล Bill No.';
    var linkModal = lines+'paybill.php?total='+total;
    var styModal = 'mini';
    var bt = 'payDatesBill';
    var TextTb = 'จ่าย';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}

function Payonebill(){
  $(document).on('click','#payDatesBill',function(e){
    e.stopImmediatePropagation();
    var month = $('#monthspaybill').val();
    var year = $('#yearspayBill').val();
    var billpay = $('#billpay').val();
    var total = $('#total').val();
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
     if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    if (billpay == '') {
      swal("กรุณาใส่ ID Bill");
      return false;

    }

    var link = lines+'processEditRE.php?status=paybill';
    $.post(link,{'total':total,'month':month,'year':year,'billpay':billpay},function(data){
      debugger;
      var mydata = JSON.parse(data);
      if (mydata.succeed == '1') {
        closeModalAutos();
        for (var i in mydata){
          if (i != 'succeed') {
            $(".D-"+mydata[i].id).hide();
          }
          
        }
        swal({
          title: "โอนค้างจ่ายเรียบร้อย",
          text: "",
          icon: "success",
          button: "OK",
        });

        
      }else{
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถแก้ไขข้อมูลได้",
          icon: "error",
          button: "OK",
        });


      }

    });
    
    

  });

}

function Payone(){
  $(document).on('click','#payDates',function(e){
    e.stopImmediatePropagation();
    var month = $('#monthspay').val();
    var year = $('#yearspay').val();
    var id = $('#id').val();
    var total = $('#total').val();
    if (total == '0') {
      swal("ไม่สามารถจ่ายยอดที่ค้างได้ เนื่องจำนวนที่จ่ายครบเรียบร้อยแล้ว");
      return false;

    }
    if (year == '') {
      swal("กรุณาเลือกปี");
      return false;

    }
     if (month == '') {
      swal("กรุณาเลือกเดือน");
      return false;

    }
    var link = lines+'processEditRE.php?status=pay';
    $.post(link,{'total':total,'month':month,'year':year,'id':id},function(data){
      debugger;
      var mydata = JSON.parse(data);
      if (mydata.succeed == '1') {
        closeModalAutos();
        swal({
          title: "โอนค้างจ่ายเรียบร้อย",
          text: "",
          icon: "success",
          button: "OK",
        });
        $(".D-"+mydata.id).hide();
        $(".btEpa").attr('data-total',mydata.total);
        debugger;
      }else{
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถแก้ไขข้อมูลได้",
          icon: "error",
          button: "OK",
        });


      }

    });
    
    

  });

}


function detailsIPD(){
  $(document).on('click','#detailsIPD',function(e){
    e.stopImmediatePropagation();
    var statudEdit = $(this).attr('data-statusedit');
    var id = $(this).attr('data-id');
    var numberD = $(this).attr('data-number');
    var dateDF = $(this).attr('data-date');
    var iddoctor= $(this).attr('data-iddoctor');
    var typefile = $(this).attr('data-typeFile');
    var tpyedoctor = $(this).attr('data-typeDoctor');
    var classPreview = 'listEdit';
    var hasder = 'รายละเอียด IPD';
    var linkModal = lines+'detailsIPD.php?st=show&id='+id+'&statudEdit='+statudEdit+'&numberD='+numberD+'&dateDF='+dateDF+'&iddoctor='+iddoctor+'&typefile='+typefile+'&tpyedoctor='+tpyedoctor;
    var styModal = 'full';
    var bt = '';
    var TextTb = '';

    previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
    
    

  });

}

function delIpddate(){
  $(document).on('click','#delIpddate',function(e){
    e.stopImmediatePropagation();
    var statudEdit = $(this).attr('data-statusedit');
    var id = $(this).attr('data-id');
    var numberD = $(this).attr('data-number');
    var dateDF = $(this).attr('data-date');
    var iddoctor= $(this).attr('data-iddoctor');
    var typefile = $(this).attr('data-typeFile');
    var tpyedoctor = $(this).attr('data-typeDoctor');
    var lk = lines+'detailsIPD.php?st=del';

    $.post(lk,{'tpyedoctor':tpyedoctor,'typefile':typefile,'iddoctor':iddoctor,'statudEdit':statudEdit,'id':id,'numberD':numberD,'dateDF':dateDF},function(data){
      var mydata = JSON.parse(data);
      $(".O-"+mydata.id).hide();
      calculateDF(mydata.dateDF,mydata.iddoctor,mydata.tpyedoctor);
      swal({
        title: "ลบข้อมูลสำเร็จ",
        text: "",
        icon: "success",
        button: "OK",
      });

    });


    
    

  });

}

function Editregular(){
  $(document).on('click','#editDF',function(e){
    e.stopImmediatePropagation();
    var Dateregular =$('#Dateregular').val();
    var Coderegular =$('#Coderegular').val();
    var time1 =$('#time1').val();
    var time2 =$('#time2').val();
    var typeCoderegular =$('#typeCoderegular').val();
    var Workregular =$('#Workregular').val();
    var Socialregular =$('#Socialregular').val();
    var Generaregular =$('#Generaregular').val();
    var sociregular =$('#sociregular').val();
    var Generegular =$('#Generegular').val();
    var Ptregular =$('#Ptregular').val();
    var DOCTORFEE =$('#DOCTORFEE').val();
    var typedoctor =$('#typedoctor').val();
    var id = $('#id').val();
    var numberD = $('#numberD').val();
    var dateDFdoctor = $('#dateDFdoctor').val();
    var link = lines+'processEditRE.php?status=Edit';
    $.post(link,{'typedoctor':typedoctor,'DOCTORFEE':DOCTORFEE,'time1':time1,'time2':time2,'dateDFdoctor':dateDFdoctor,'numberD':numberD,'id':id,'Ptregular':Ptregular,'Generegular':Generegular,'sociregular':sociregular,'Generaregular':Generaregular,'Socialregular':Socialregular,'Workregular':Workregular,'Dateregular':Dateregular,'Coderegular':Coderegular,'typeCoderegular':typeCoderegular},function(data){
      var mydata = JSON.parse(data);
      if (mydata.succeed == '1') {
        $('.D1-'+mydata.numberD).text(mydata.Dateregular);
        $('.D3-'+mydata.numberD).text(mydata.Workregular);
        $('.D4-'+mydata.numberD).text(mydata.Socialregular);
        $('.D5-'+mydata.numberD).text(mydata.Generaregular);
        $('.D6-'+mydata.numberD).text(mydata.sociregular);
        $('.D7-'+mydata.numberD).text(mydata.Generegular);
        $('.D8-'+mydata.numberD).text(mydata.Ptregular);
        $('.D9-'+mydata.numberD).text(mydata.time1);
        $('.D10-'+mydata.numberD).text(mydata.time2);
        $('.D11-'+mydata.numberD).text(mydata.DOCTORFEE);
        calculateDF(mydata.dateDFdoctor,mydata.iddoctor,mydata.typedoctor);
        closeModalAutos();
        swal({
          title: "แก้ไขข้อมูลสำเร็จ",
          text: "",
          icon: "success",
          button: "OK",
        });
        

      }



    });
    
    

  });

}



function calculateDF(dateDF,iddoctor,tpyedoctor){
  var ln = lines+'processListdoctor.php?d=sumEdit';
  $.post(ln,{'dateDF':dateDF,'iddoctor':iddoctor,'tpyedoctor':tpyedoctor},function(data){
    var mydata = JSON.parse(data);
    $('.v3-'+mydata.idDoctor).text(mydata.SOCIAL);
    $('.v4-'+mydata.idDoctor).text(mydata.GENERA);
    $('.v5-'+mydata.idDoctor).text(mydata.SOCI);
    $('.v6-'+mydata.idDoctor).text(mydata.GENE);
    $('.v7-'+mydata.idDoctor).text(mydata.SUM);
    $('.v9-'+mydata.idDoctor).text(mydata.DOCTORFEE);
    aggregate(mydata.dateDF,tpyedoctor);
    //closeModalAuto(); 


  });
}

function aggregate(dateDF,tpyedoctor){

  var ln = lines+'processListdoctor.php?d=aggregate';
  $.post(ln,{'dateDF':dateDF,'tpyedoctor':tpyedoctor},function(data){
    var mydata = JSON.parse(data);
    $('.hg').text(mydata.SUM);


  });
}





function openmenu(evt, cityName) {
  var i, tabcontent, tablinks;
  $('.listDoctorRegular').html('');
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


function EditIPD(){
  $(document).on('click','#editDe',function(e){
    e.stopImmediatePropagation();
    var iddoctor = $(this).attr('data-iddoctor');
    var dateEdit = $(this).attr('data-date');
    var id = $(this).attr('data-id');
    var idDF = $(this).attr('data-idDF');
    var dateDF = $('#dateDF-'+id).val();
    var servicecharge = $('#servicecharge-'+id).val();
    var ssp = $('#ssp-'+id).val();
    var cash = $('#cash-'+id).val();
    var tpyedoctor = $(this).attr('data-typedoctor');
    var ln = lines+'processListdoctor.php?d=editIPD';
    $.post(ln,{'tpyedoctor':tpyedoctor,'idDF':idDF,'iddoctor':iddoctor,'dateEdit':dateEdit,'cash':cash,'ssp':ssp,'dateDF':dateDF,'id':id,'dateDF':dateDF,'servicecharge':servicecharge},function(data){

      var mydata = JSON.parse(data);

      if (mydata.status == '1') {
        $('#service').text(mydata.service);
        $('#ssp').text(mydata.ssp);
        $('#cash').text(mydata.cash);
        $('#sumssp').text(mydata.ssp);
        $('#sumcash').text(mydata.cash);
        calculateDF(mydata.dateDF,mydata.iddoctor,mydata.tpyedoctor);

        swal({
          title: "แก้ไขข้อมูลสำเร็จ",
          text: "",
          icon: "success",
          button: "OK",
        });
      }else{
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถแก้ไขข้อมูลได้",
          icon: "error",
          button: "OK",
        });

      }


    });
  });
}

function deleteDetailIPD(){
  $(document).on('click','#deleteDetailIPD',function(e){
    e.stopImmediatePropagation();
    swal({
      title: "ยืนยันการลบข้อมูล",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        var id = $(this).attr('data-id');
        var iddoctor = $(this).attr('data-iddoctor');
        var dateM = $(this).attr('data-date');
        var ssp = $(this).attr('data-ssp');
        var idDF = $(this).attr('data-idDF');
        var tpyedoctor = $(this).attr('data-typedoctor');
        if (ssp == '') {
          ssp = 0;
        }
        var cash = $(this).attr('data-cash');
        if (cash == '') {
          cash = 0;
        }
        var ln = lines+'processListdoctor.php?d=deletedetailIPD';
        $.post(ln,{'tpyedoctor':tpyedoctor,'idDF':idDF,'id':id,'iddoctor':iddoctor,'dateM':dateM,'ssp':ssp,'cash':cash},function(data){
         var mydata = JSON.parse(data);
         if (mydata.succeed == '1'){
           $(".D-"+mydata.id).hide();
           $('#service').text(mydata.service);
           $('#ssp').text(mydata.ssp);
           $('#cash').text(mydata.cash);
           $('#sumssp').text(mydata.ssp);
           $('#sumcash').text(mydata.cash);
           calculateDF(mydata.dateDF,mydata.iddoctor,mydata.tpyedoctor);
           swal({
            title: "ลบข้อมูลสำเร็จ",
            text: "",
            icon: "success",
            button: "OK",
          });

         }else{
          swal({
            title: "เกิดข้อผิดพลาด",
            text: "ไม่สามารถลบข้อมูลได้",
            icon: "error",
            button: "OK",
          });

        }


      });


      }

    });
    
    

  });

}

function moveDF(){
  $(document).on('click','#moveDe',function(e){
    e.stopImmediatePropagation();
    swal({
      title: "ยืนยันการไม่จ่าย",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        var id = $(this).attr('data-id');
        var iddoctor = $(this).attr('data-iddoctor');
        var dateM = $(this).attr('data-date');
        var ssp = $(this).attr('data-ssp');
        var idDF = $(this).attr('data-idDF');
        var tpyedoctor = $(this).attr('data-typedoctor');
        if (ssp == '') {
          ssp = 0;
        }
        var cash = $(this).attr('data-cash');
        if (cash == '') {
          cash = 0;
        }
        var ln = lines+'processListdoctor.php?d=moveDF';
        $.post(ln,{'tpyedoctor':tpyedoctor,'idDF':idDF,'id':id,'iddoctor':iddoctor,'dateM':dateM,'ssp':ssp,'cash':cash},function(data){

         var mydata = JSON.parse(data);
         if (mydata.succeed == '1'){
           $(".D-"+mydata.id).hide();
           $('#service').text(mydata.service);
           $('#ssp').text(mydata.ssp);
           $('#cash').text(mydata.cash);
           $('#sumssp').text(mydata.ssp);
           $('#sumcash').text(mydata.cash);
           calculateDF(mydata.dateDF,mydata.iddoctor,mydata.tpyedoctor);
           swal({
            title: "ย้ายข้อมูลสำเร็จ",
            text: "",
            icon: "success",
            button: "OK",
          });

         }else{
          swal({
            title: "เกิดข้อผิดพลาด",
            text: "ไม่สามารถลบข้อมูลได้",
            icon: "error",
            button: "OK",
          });

        }


      });


      }

    });
    
    

  });

}

function deleteDetailOPDA(){
  $(document).on('click','#deleteOpd',function(e){
    e.stopImmediatePropagation();
    swal({
      title: "ยืนยันการลบข้อมูล",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        var id = $(this).attr('data-id');
        var number = $(this).attr('data-number');
        var dateM = $(this).attr('data-date');
        var iddoctor = $(this).attr('data-iddoctor');
        var typedoctor = $(this).attr('data-typedoctor');
        var ln = lines+'processListdoctor.php?d=deletedetailOPDA';
        $.post(ln,{'typedoctor':typedoctor,'iddoctor':iddoctor,'id':id,'number':number,'dateM':dateM},function(data){
         var mydata = JSON.parse(data);
         if (mydata.succeed == '1') {
          $(".O-"+mydata.id).hide();
          calculateDF(mydata.dateDF,mydata.iddoctor,mydata.typedoctor);
          swal({
            title: "ลบข้อมูลสำเร็จ",
            text: "",
            icon: "success",
            button: "OK",
          });
        }else{
          swal({
            title: "เกิดข้อผิดพลาด",
            text: "ไม่สามารถลบข้อมูลได้",
            icon: "error",
            button: "OK",
          });

        }


      });


      }

    });
    
    

  });

}

function EditDoctorName(){

 $(document).on('click','#editDoctorname',function(e){
  e.stopImmediatePropagation();
  var id = $(this).attr('data-id');
  var classPreview = 'listEdit';
  var hasder = 'แก้ไขข้อมูลส่วนตัวหมอ';
  var linkModal = lines+'editDoctorname.php?id='+id+'&status=edit';
  var styModal = '';
  var bt = 'EditDotoe';
  var TextTb = 'แก้ไข';
  previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
});
}

function addDoctorName(){

 $(document).on('click','#addDoctor',function(e){
  e.stopImmediatePropagation();
  var id = $(this).attr('data-id');
  var classPreview = 'listEdit';
  var hasder = 'เพิ่มข้อมูลส่วนตัวแพทย์';
  var linkModal = lines+'editDoctorname.php?id='+id+'&status=add';
  var styModal = '';
  var bt = 'addDotoe';
  var TextTb = 'เพิ่ม';
  previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
});
}

function EditDoctorS(){

 $(document).on('click','#EditDotoe',function(e){
  e.stopImmediatePropagation();
  var idDoctor = $('#iddoctor').val();
  var nameTitle = $('#nameTitle').val();
  var name = $('#name').val();
  var fname = $('#fname').val();
  var salary = $('#salary').val();
  var guarantee = $('#guarantee').val();
  var id = $('#id').val();
  var link = lines+'processListdoctor.php?d=idedit';
  $.post(link,{'id':id,'guarantee':guarantee,'salary':salary,'idDoctor':idDoctor,'nameTitle':nameTitle,'name':name,'fname':fname},function(data){
    var mydata = JSON.parse(data);
    if (mydata.succeed == '1') {
      swal({
        title: "แก้ไขข้อมูลสำเร็จ",
        text: "",
        icon: "success",
        button: "OK",
      });
      var line = lines+'salary.php';
      $('.list').html('');
      $('.from-list').load(line);
      closeModalAutos();
    }else{

      swal({
        title: "เกิดข้อผิดพลาด",
        text: "ไม่สามารถแก้ไขข้อมูลได้",
        icon: "error",
        button: "OK",
      });
    }

  });
});
}
function addDoctorS(){

 $(document).on('click','#addDotoe',function(e){
  e.stopImmediatePropagation();
  var idDoctor = $('#iddoctor').val();
  var nameTitle = $('#nameTitle').val();
  var name = $('#name').val();
  var fname = $('#fname').val();
  var salary = $('#salary').val();
  var guarantee = $('#guarantee').val();
  var id = $('#id').val();
  var link = lines+'processListdoctor.php?d=addDotoe';
  $.post(link,{'id':id,'guarantee':guarantee,'salary':salary,'idDoctor':idDoctor,'nameTitle':nameTitle,'name':name,'fname':fname},function(data){
    var mydata = JSON.parse(data);
    if (mydata.succeed == '1') {
      swal({
        title: "เพิ่มข้อมูลสำเร็จ",
        text: "",
        icon: "success",
        button: "OK",
      });
      var line = lines+'salary.php';
      $('.list').html('');
      $('.from-list').load(line);
      closeModalAutos();
    }else{

      swal({
        title: "เกิดข้อผิดพลาด",
        text: "ไม่สามารถเพิ่มข้อมูลได้",
        icon: "error",
        button: "OK",
      });
    }

  });
});
}

function setupDoctorS(){

 $(document).on('click','#setupDoctor',function(e){
  e.stopImmediatePropagation();
  var tax = $('#tax').val();
  var id = $('#id').val();
  var link = lines+'processListdoctor.php?d=updateT';
  $.post(link,{'id':id,'tax':tax},function(data){
    var mydata = JSON.parse(data);
    if (mydata.succeed == '1') {
      swal({
        title: "แก้ไขข้อมูลสำเร็จ",
        text: "",
        icon: "success",
        button: "OK",
      });

    }else{

      swal({
        title: "เกิดข้อผิดพลาด",
        text: "ไม่สามารถเพิ่มข้อมูลได้",
        icon: "error",
        button: "OK",
      });
    }

  });
});
}


function deleDoctorN(){

 $(document).on('click','#deletnamDoct',function(e){
  e.stopImmediatePropagation();
  var id = $(this).attr('data-id');
  var idDoctor = $(this).attr('data-iddoctor');

  swal({
    title: "ยืนยันการลบข้อมูล",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if(willDelete){



      var link = lines+'processListdoctor.php?d=delnamDoctor';
      $.post(link,{'id':id,'idDoctor':idDoctor},function(data){

        var mydata = JSON.parse(data);
        if (mydata.succeed == '1') {

          swal({
            title: "ลบข้อมูลสำเร็จ",
            text: "",
            icon: "success",
            button: "OK",
          });
          var line = lines+'salary.php';
          $('.list').html('');
          $('.from-list').load(line);
        }else{

          swal({
            title: "ไม่สามารถลบข้อมูลได้ ",
            text: "เนื่องจากมีข้อมูลอยู่ในรายการ DF",
            icon: "error",
            button: "OK",
          });

        }
        

      });


    }
  });


});
}


function uturdD(){
  $(document).on('click','#retrd',function(e){
    e.stopImmediatePropagation();
    var id = $(this).attr('data-id');
    var link = lines+'processListdoctor.php?d=uturdD';
    $.post(link,{'id':id},function(data){
      //debugger;
      var mydata = JSON.parse(data);
      if (mydata.succeed == '1') {
        swal({
          title: "คืนข้อมูลสำเร็จ",
          text: "",
          icon: "success",
          button: "OK",
        });

        $('.D-'+mydata.id).hide(300);
        $('#service').html(mydata.serviceCharge);
        $('#cash').html(mydata.cash);


      }

    });



  });




}





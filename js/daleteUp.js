$(document).ready(function(){

	datepicker1();
    listDetaiaUpload();
    listDeleteDoctor();
});
function datepicker1(){
	$(function(){

    $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    // กรณีใช้แบบ input

    $("#testdate6").datetimepicker({

    	timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        onSelectDate:function(dp,$input){
        	var yearT=new Date(dp).getFullYear()-0;  
        	var yearTH=yearT;
        	var fulldate=$input.val();
        	var fulldateTH=fulldate.replace(yearT,yearTH);
        	$input.val(fulldateTH);
        },
    });       
    // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
    $("#testdate6").on("mouseenter mouseleave",function(e){
    	var dateValue=$(this).val();

    	if(dateValue!=""){
                var arr_date=dateValue.split("-"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
                // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
                //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
                if(e.type=="mouseenter"){
                	var yearT=arr_date[2];
                }       
                if(e.type=="mouseleave"){
                	var yearT=parseInt(arr_date[2]);
                }   
                dateValue=dateValue.replace(arr_date[2],yearT);
                $(this).val(dateValue);                                                 
            }       
        });


});
}


function listDetaiaUpload(){
    $(document).on('click','#listuploadDelete',function(e){

     var testdate6 = $('#testdate6').val();
     var typefiles = $('#typefiles').val();
     var typedoctor = $('#typedoctor').val();
     var numberDoctor =$('#numberDoctor').val();
     if (testdate6 == '') {
        swal("กรุณาเลือกวันที่ต้องการลบ");
        return false;
    }
    if (typefiles == '') {
        swal("กรุณาเลือกประเภทไฟล์ที่อัพโหลด");
        return false;
    }
    if (typedoctor == '') {
        swal("กรุณาเลือกประเภทหมอที่ต้องการลบ");
        return false;
    }
    var link = lines+'uploadDelete.php?mode=lestdoctor';
    $.post(link,{'testdate6':testdate6,'typefiles':typefiles,'typedoctor':typedoctor,'numberDoctor':numberDoctor},function(data){

        $('.listDeleteUp').html('');
        $('.listDeleteUp').html(data);
    });



});

}

function listDeleteDoctor(){
    $(document).on('click','#deletup',function(e){

     var testdate6 = $('#testdate6').val();
     var typefiles = $('#typefiles').val();
     var typedoctor = $('#typedoctor').val();
     var numberDoctor =$('#numberDoctor').val();
     if (testdate6 == '') {
        swal("กรุณาเลือกวันที่ต้องการลบ");
        return false;
    }
    if (typefiles == '') {
        swal("กรุณาเลือกประเภทไฟล์ที่อัพโหลด");
        return false;
    }
    if (typedoctor == '') {
        swal("กรุณาเลือกประเภทหมอที่ต้องการลบ");
        return false;
    }
    var link = lines+'uploadDelete.php?mode=deleteDoctor';
    $.post(link,{'testdate6':testdate6,'typefiles':typefiles,'typedoctor':typedoctor,'numberDoctor':numberDoctor},function(data){
        var mydata = JSON.parse(data);
        if (mydata.succeed == '1') {
            closeModalAutos();
            swal({
                title: "ลบข้อมูลสำเร็จ",
                text: "",
                icon: "success",
                button: "OK",
            });


        }

    });



});

}
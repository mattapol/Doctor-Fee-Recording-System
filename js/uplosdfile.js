$(document).ready(function(){

	addDFOPD();
	listdoctor();
	listDetailsDoctor();
	datepicker();
	listsalaryDoctor();
	setDoctor();
	
	checkuploaddelete();
});

function addDFOPD(){

	$("form#frmUpdload").submit(function() {
		var typefile =  $('#typefile').val();
		var typeDoctor = $('#typeDoctor').val();
		var dateUp = $('#testdate5').val();
		var formData = new FormData();
		if (typefile == '') {

			swal("กรุณาเลือกประเภทไฟล์อัพโหลด");
			return false;
		}
		if (typeDoctor == '') {

			swal("กรุณาเลือกประเภทหมอ");
			return false;
		}
		if ($('#file')[0].files[0] == undefined) {
			swal("กรุณาอัพโหลดไฟล์");
			return false;
		}
		var typefilsDoctor = $('#typefilsDoctor').val();
		if (typefile == '2') {
			if (typefilsDoctor == '') {
				swal("กรุณาเลือกรูปแบบไฟล์");
				return false;

			}

		}
		if (typefile == '1') {
			if (dateUp == '') {
				swal("กรุณากำหนดวันที่อัพโหลดไฟล์");
				return false;
			}
		}
		formData.append('file', $('#file')[0].files[0]); 
		formData.append('typefile', typefile);
		formData.append('typeDoctor', typeDoctor);
		formData.append('typefilsDoctor', typefilsDoctor);
		formData.append('dateUp', dateUp);
		loading();
		$.ajax({
			url: lines+'processUpload.php',
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(data){
				if (data == '\r\n0') {
					closeLoading();
					swal({
						title: "รูปแบบไฟล์ไม่ถูกต้อง",
						text: "",
						icon: "error",
					});
					
				}else if (data == '\r\n1') {
					closeLoading();
					swal({
						title: "ไม่สามารถบันทึกข้อมูลได้",
						text: "เนื่องจากมีการนำเข้าข้อมูลของวันนี้เข้าแล้ว",
						icon: "error",
					});

				} else {
					$('.list').html('');
					$('.list').html(data);
					closeLoading();
				}
				
				
				
			}
		});
		$('#frmUpdload')[0].reset();
		return false;
	});
}

function listdoctor(){
	$(document).on('click','#listdocyor',function(e){
		e.preventDefault();
		var iddoctor = $(this).attr('data-id');
		var tpyedoctor =$(this).attr('data-tpyedoctor');
		var typefile = $(this).attr('data-typefile');
		var dateDF = $(this).attr('data-date-doctor');
		var classPreview = 'bill-VS';
		var hasder = 'รายละเอียดรายการ';
		var linkModal = lines+'detailsDF.php?iddoctor='+iddoctor+'&tpyedoctor='+tpyedoctor+'&typefile='+typefile+'&dateDF='+dateDF;
		var styModal = '';
		var bt = '';
		var TextTb = '';
		
		previewModal(linkModal,classPreview,hasder,styModal,TextTb,bt);

	});

}

function listDetailsDoctor(){
	$(document).on('click','#list-details-doctor',function(e){
		$("#activess").removeClass("activess");
		$("#list-set").removeClass("activess");
		$("#list-salary-doctor").removeClass("activess");
		$("#list-details-doctor").addClass("activess");
		$('.listDoctorRegular').html('');
		var line = lines+'listDetailDoctor.php';
		$('.list').html('');
		$('.listDoctorRegular').html('');
		$('.from-list').load(line);
	});

}

function listsalaryDoctor(){
	$(document).on('click','#list-salary-doctor',function(e){
		$("#activess").removeClass("activess");
		$("#list-details-doctor").removeClass("activess");
		$("#list-set").removeClass("activess");
		$("#list-salary-doctor").addClass("activess");
		$('.listDoctorRegular').html('');
		var line = lines+'salary.php';
		$('.list').html('');
		
		$('.from-list').load(line);
	});

}

function setDoctor(){
	$(document).on('click','#list-set',function(e){
		$("#activess").removeClass("activess");
		$("#list-details-doctor").removeClass("activess");
		$("#list-salary-doctor").removeClass("activess");
		$("#list-set").addClass("activess");
		$('.listDoctorRegular').html('');
		var line = lines+'set.php';
		$('.list').html('');

		$('.from-list').load(line);
	});

}

function checkuploaddelete(){
	$(document).on('click','#deleteUploadText',function(e){
		// var statudEdit = $(this).attr('data-statusedit');
		// var id = $(this).attr('data-id');
		// var numberD = $(this).attr('data-number');
		// var dateDFdoctor = $(this).attr('data-date');
		// var typedoctor = $(this).attr('data-typedoctor');
		var classPreview = 'listEdit';
		var hasder = 'ลบไฟล์ที่อัพโหลด';
		var linkModal = lines+'deleflieup.php';
		var styModal = '';
		var bt = 'deletup';
		var TextTb = 'ลบข้อมูลทั้งหมด';

		previewModalmini(linkModal,classPreview,hasder,styModal,TextTb,bt);
	});

}




function datepicker(){
	$(function(){

    $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    // กรณีใช้แบบ input
    $("#testdate5").datetimepicker({
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
    $("#testdate5").on("mouseenter mouseleave",function(e){
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

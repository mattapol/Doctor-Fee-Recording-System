// การเรียกใช้ function previewModal 
// linkModal = ไฟล์หน้าที่ต้องการแสดงข้อมูลใน modal  
//classPreview = class ที่แสดงไฟล์ modal
// hasder = หัวข้อที่ต้องการแสดงใน modal
// styModal = เลือกขนาดของ modal

function previewModal(linkModal,classPreview,hasder,styModal,Texttb,tb){

	if (styModal == 'mini') {

		var modalmini = 'modal-content-mini';
	}else{

		var modalmini = 'modal-content';
	}
	
	if (tb != "") {
		var btt = '<div class="modal-footer"><div class="tbA" id="'+tb+'">'+Texttb+'</div></div>';
	}else{
		var btt = '';

	}

	$('.'+classPreview).html('<div id="myModal" class="modal"><div class="'+modalmini+'"><div class="modal-header"><span class="close">&times;</span><h2>'+hasder+'</h2>'+
		'</div><div class="modal-body"></div>'+btt);

	$('.modal-body').load(linkModal);
	closeModal();

}

function closeModal(){
var modal = document.getElementById("myModal");
	$(document).on('click','.close',function(){

		$('#myModal').hide();
		$('#myModal').html('');
		$('.modal-body').html('');

	});
	window.onclick = function(event) {

  if (event.target == modal) {
    $('#myModal').hide();
    $('#myModal').html('');
    $('.modal-body').html('');
  }
}

}

function closeModalAuto(){

	$('#myModal').hide();
	$('#myModal').html('');
	$('.modal-body').html('');
}
///-----------------------------------------------modalmini

function previewModalmini(linkModal,classPreview,hasder,styModal,Texttb,tb){

	if (styModal == 'full') {

		var modalmini = 'modal-contents-full';
	}else{

		var modalmini = 'modal-contents';
	}
	
	if (tb != "") {
		var btt = '<div class="modal-footers"><div class="tbA" id="'+tb+'">'+Texttb+'</div></div>';
	}else{
		var btt = '';

	}

	$('.'+classPreview).html('<div id="myModals" class="modals"><div class="'+modalmini+'"><div class="modal-header"><span class="closes">&times;</span><h2>'+hasder+'</h2>'+
		'</div><div class="modal-bodys"></div>'+btt);

	$('.modal-bodys').load(linkModal);
	closeModals();

}

function closeModals(){
var modal = document.getElementById("myModals");
	$(document).on('click','.closes',function(){

		$('#myModals').hide();
		$('#myModals').html('');
		$('.modal-bodys').html('');

	});
	window.onclick = function(event) {

  if (event.target == modal) {
    $('#myModals').hide();
    $('#myModals').html('');
    $('.modal-bodys').html('');
  }
}

}

function closeModalAutos(){

	$('#myModals').hide();
	$('#myModals').html('');
	$('.modal-bodys').html('');
}
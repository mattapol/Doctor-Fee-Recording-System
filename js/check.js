$(document).ready(function(){
  searchCN();
  formupload();

});
function searchCN(){
  $('#code_name').keyup(function(e){
    if (e.keyCode == 13) {
      var ling = 'http://127.0.0.1/payroll_system/';
      var code_name = $('#code_name').val();
      $.post(ling,{'code_name':code_name},function(data){ 
        $('#name').val(data);  
      });
    }  
  });
}

function formupload(){
  $(document).on('click','#loadupfile',function(){
    var line = lines+'uploadDF.php';
    $('.listform').load(line);

  });
}


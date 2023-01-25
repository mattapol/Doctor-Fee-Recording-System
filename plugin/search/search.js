//classDiv = class ของ input ที่ค้นหา
//classTable = class ของตารางที่ต้องการหา
//searchdiv = class ช่องที่ต้องการหา

function createSearch(classDiv,classTable,searchdiv){
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById(classDiv);
	filter = input.value;
	table = document.getElementById(classTable);
	 tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[searchdiv];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toLowerCase().indexOf(filter.toLowerCase()) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }




}

// function createSearchSS(classDiv,classTable,searchdiv,trr,tdd){
//   var input, filter, table, tr, td, i, txtValue;
//   input = document.getElementById(classDiv);
//   filter = input.value;
//   table = document.getElementById(classTable);
//    tr = table.getElementsByClassName(trr);
//   for (i = 0; i < tr.length; i++) {
//     td = tr[i].getElementsByClassName(tdd)[searchdiv];
//     if (td) {
//       txtValue = td.textContent || td.innerText;
//       if (txtValue.toLowerCase().indexOf(filter.toLowerCase()) > -1) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }       
//   }




// }
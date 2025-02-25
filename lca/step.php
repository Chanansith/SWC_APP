
<?php
// Start session
session_start();
include "config.php";

// Retrieve data from session
$projectname = $_SESSION['projectname'] ?? 'No data';
$description = $_SESSION['description'] ?? 'No data';

$step=$_GET["step"];
$stepno=0;

if ($step=="1"){
    $stepno=1;
}else {
    $stepno=$_SESSION['STEP'];
}

if ($step=="next"){
    $stepno++;
}
if ($step=="prv"){
    $stepno--;
}

$_SESSION['STEP']=$stepno;

if (isset($_SESSION['tableData'])){
$savedata=$_SESSION['tableData'];
   // print_r($savedata);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LCA Web App</title>
    <!-- เพิ่ม Bootstrap CSS จาก CDN -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            min-width:100px;
        }
        th {
            background-color: #f2f2f2;
        }
        input {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="container">

<h2>LCA Project <?php echo($_SESSION['STEP'])?></h2>

<label for="projectname">Project Name:</label>
    <span id="projectname"><?php echo htmlspecialchars($projectname); ?></span><br>

    <label for="description">Description:</label>
    <span id="description"><?php echo htmlspecialchars($description); ?></span><br>




<div class="mb-3"></div>
<label for="material-select" class="form-label">Select Phase</label>
<select>
    <option value="1">Construction and installation phase</option>
    <option value="2">Operation phase</option>
    <option value="3">Decommissioning phase</option>
</select>
</div>
<!-- ใช้ Bootstrap สำหรับ Select -->
<div class="mb-3">
    <label for="material-select" class="form-label">Select Group</label>
    <select id="material-select1">
      <option value="">--Select Group--</option>
    </select>
</div>

<div class="mb-3">
    <label for="material-select" class="form-label">Select substance</label>
    <select id="substance">
      
    </select>
</div>


<div class="mt-3">
    <button class="btn btn-primary" onclick="addRow()">เพิ่มรายการ</button>
  
</div>
<!-- ใช้ Bootstrap สำหรับตาราง -->
<table id="excelTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Raw Group</th>
            <th>Raw Type</th>
            <th>Substance</th>
            <th>Amount</th>
            <th>Unit</th>
                <th>CC</th>
                <th>OD</th>
                <th>pmf</th>
                <th>TA</th>
                <th>FE</th>
                <th>ME</th>
                <th>HT</th>
                <th>TET</th>
                <th>FET</th>
                <th>MET</th>  
                <th>MD</th>
                <th>FD</th>
                <th>POF</th>
                <th>IR</th>
                <th>ALO</th>
                <th>ULO</th>
                <th>NLO</th>
                <th>WD</th>
               
              
                <th>CC</th>
                <th>OD</th>
                <th>pmf</th>
                <th>TA</th>
                <th>FE</th>
                <th>ME</th>
                <th>HT</th>
                <th>TET</th>
                <th>FET</th>
                <th>MET</th>
                <th>MD</th>
                <th>FD</th>
                <th>POF</th>
                <th>IR</th>
                <th>ALO</th>
                <th>ULO</th>
                <th>NLO</th>
                <th>WD</th>
        </tr>
    </thead>
    <tbody>
      
    </tbody>
</table>

<a  class="btn btn-success" href="#" id="nextButton" >Next</a>
<a  class="btn btn-success" href="#" >Previous</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#nextButton').on('click', function(event) {
        event.preventDefault(); // หยุดการเปลี่ยนเส้นทางทันที
alert("click");
        // อ่านข้อมูลจากตาราง
        let tableData = [];
        $('#excelTable tbody tr').each(function() {
            let rowData = {
                substance: $(this).find('td:eq(3)').text(),
                rawamount: $(this).find('td:eq(4) input').val(),
              
            };
            tableData.push(rowData);
        });

        // ส่งข้อมูลไปยังเซิร์ฟเวอร์ผ่าน AJAX
        $.ajax({
            url: 'savedata.php', // ไฟล์ PHP สำหรับเก็บข้อมูลใน session
            type: 'POST',
            data: { tableData: tableData },
            success: function(response) {
                // เมื่อเซิร์ฟเวอร์ตอบกลับ ให้เปลี่ยนเส้นทางไปยังหน้าถัดไป
                //window.location.href = 'step.php?step=next';
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>

<!-- เพิ่มปุ่มเพื่อเพิ่มแถวและคอลัมน์ -->


<script>

    var currentrow=0;
   

    function getRawDropdown(id){
        const select = document.getElementById(id);

        
      
        // วนลูปเพื่อเพิ่ม <option> ใน <select>
        raw_group.forEach(material => {
            const option = document.createElement('option');
            option.value = material.raw_group;
            option.textContent = material.raw_group;
            select.appendChild(option);
        });


        select.addEventListener('change', function(event) {
    // ค่าที่ถูกเลือกใน dropdown
              const selectedValue = event.target.value;
              getRawDropdownType(selectedValue);

            });
        
    
    }
    function getRawDropdownType(raw_group){
        const select = document.getElementById("substance");
        select.innerHTML = ''; 
        // วนลูปเพื่อเพิ่ม <option> ใน <select>
        raw_json.forEach(material => {
            if (raw_group==material.raw_group){
            const option = document.createElement('option');
            option.value = material.idraw;
            option.textContent = material.substance;
            select.appendChild(option);
            }
        });
    
    }
    var col_count = 36;
    function updateCell(input) {
        const cell = input.parentElement;
        const row = cell.parentElement;
        const rowIndex = row.rowIndex - 1; // Subtract 1 to account for the header row
        const cellIndex = cell.cellIndex;

        console.log(`Updated cell at row ${rowIndex}, column ${cellIndex}: ${input.value}`);
    }

    // Function to add a new row
    function addRow() {
        currentrow++;
        const table = document.getElementById('excelTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        idraw=parseInt(document.getElementById('substance').value)

  
        const raw_item =raw_json.find(item => item.idraw === idraw);

        console.log(raw_item)

        const newCell1 = newRow.insertCell(0);
        newCell1.innerHTML = currentrow;
        const newCell2 = newRow.insertCell(1);
        newCell2.innerHTML = raw_item.raw_group;

        const newCell3 = newRow.insertCell(2);
        newCell3.innerHTML = raw_item.rawtype;
        const newCell4 = newRow.insertCell(3);
        newCell4.innerHTML = raw_item.substance;

        const newCell5 = newRow.insertCell(4);
        var amount_id="amount_"+currentrow;
        newCell5.innerHTML = `<input id="${amount_id}" type="text" oninput="calculate(${currentrow})">`;

        const newCell6 = newRow.insertCell(5);
        newCell6.innerHTML = "kg";

        const min_group1=6
        const max_group1=24
        let col_no=1;
        for (let i = min_group1; i < max_group1; i++) {
            const newCell = newRow.insertCell(i);
          
                    var cal_data=0;
                    var row_id="";
                    if (col_no==1)
                    {
                        cal_data=raw_item.cc;
                        
                        row_id=`cc_${currentrow}`;
                    }
                    if (col_no==2)
                    {
                        cal_data=raw_item.od;
                        row_id=`od_${currentrow}`;
                    }
                    if (col_no==3)
                    {
                        cal_data=raw_item.pmf;
                        row_id=`pmf_${currentrow}`;
                    }
                    
                    if (col_no==4)
                    {
                        cal_data=raw_item.ta;
                        row_id=`ta_${currentrow}`;
                    }
                    if (col_no==5)
                    {
                        cal_data=raw_item.fe;
                        row_id=`fe_${currentrow}`;
                    }
                    if (col_no==6)
                    {
                        cal_data=raw_item.me;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==7)
                    {
                        cal_data=raw_item.ht;
                        row_id=`ht_${currentrow}`;
                    }
                 
                    if (col_no==8)
                    {
                        cal_data=raw_item.tet;
                        row_id=`tet_${currentrow}`;
                    }
                 
                    if (col_no==9)
                    {
                        cal_data=raw_item.fet;
                        row_id=`fet_${currentrow}`;
                    }
                 
                    if (col_no==10)
                    {
                        cal_data=raw_item.met;
                        row_id=`met_${currentrow}`;
                    }
                 
                    if (col_no==11)
                    {
                        cal_data=raw_item.md;
                        row_id=`md_${currentrow}`;
                    }
                 
                    if (col_no==12)
                    {
                        cal_data=raw_item.fd;
                        row_id=`fd_${currentrow}`;
                    }
                 
                    if (col_no==13)
                    {
                        cal_data=raw_item.pof;
                        row_id=`pof_${currentrow}`;
                    }
                    if (col_no==14)
                    {
                        cal_data=raw_item.ir;
                        row_id=`ir_${currentrow}`;
                    }
                    if (col_no==15)
                    {
                        cal_data=raw_item.alo;
                        row_id=`alo_${currentrow}`;
                    }
                    if (col_no==16)
                    {
                        cal_data=raw_item.ulo;
                        row_id=`ulo_${currentrow}`;
                    } 
                    if (col_no==17)
                    {
                        cal_data=raw_item.nlo;
                        row_id=`nlo_${currentrow}`;
                    }
                    if (col_no==18)
                    {
                        cal_data=raw_item.wd;
                        row_id=`wd_${currentrow}`;
                    }
                 
                    
                    newCell.style.backgroundColor = 'pink';
                    newCell.innerHTML = `<input id="${row_id}" type="text" value="${cal_data}" readonly  >`;
                
                    col_no++;
          
        }
        const min_group2=24
        const max_group2=42

        for (let i = min_group2; i < max_group2; i++) {
            const newCell = newRow.insertCell(i);
               var result_id="result_"+currentrow+"_"+i;
                newCell.style.backgroundColor = 'green';
                newCell.innerHTML = `<input type="text" id="${result_id}" value="0" readonly>`;
          
          
        }
    }

    function testAddRow(){
        for (let i = 0; i < 36; i++) {
            addRow();
        }
    }

    // Function to add a new column
    function addColumn() {
        const table = document.getElementById('excelTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const newCell = rows[i].insertCell(-1);
            if (i === 0) {
                newCell.innerHTML = String.fromCharCode(65 + rows[i].cells.length - 1);

             
            } else {
                newCell.innerHTML = '<input type="text" oninput="updateCell(this)" >';
            }
        }
    }

    function calculate(row_id) {
      
        // Get values from Amount (column 3) and CC (column 5)
        const amountInput =parseFloat(document.getElementById("amount_"+row_id).value);
        
        const cc = parseFloat(document.getElementById("cc_" + row_id).value);
       
       

//const pmf = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const ta = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const fe = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const me = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const ht = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const tet = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const fet = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const met = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const md = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
// const fd = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
// const pof = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
// const ir = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const alo = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
// const ulo = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const nlo = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
//const wd = 1; // เปลี่ยนค่าเริ่มต้นเป็น 1
        const od = parseFloat(document.getElementById("od_" + row_id).value);
        const pmf = parseFloat(document.getElementById("pmf_" + row_id).value);
        const ta = parseFloat(document.getElementById("ta_" + row_id).value);
        const fe = parseFloat(document.getElementById("fe_" + row_id).value);
        const me = parseFloat(document.getElementById("me_" + row_id).value);
        const ht = parseFloat(document.getElementById("ht_" + row_id).value);
        const tet = parseFloat(document.getElementById("tet_" + row_id).value);
        const fet = parseFloat(document.getElementById("fet_" + row_id).value);
        const met = parseFloat(document.getElementById("met_" + row_id).value);
        const md = parseFloat(document.getElementById("md_" + row_id).value);
        const fd = parseFloat(document.getElementById("fd_" + row_id).value);
         const pof = parseFloat(document.getElementById("pof_" + row_id).value);
         const ir = parseFloat(document.getElementById("ir_" + row_id).value);
         const alo = parseFloat(document.getElementById("alo_" + row_id).value);
       const ulo = parseFloat(document.getElementById("ulo_" + row_id).value);
      const nlo = parseFloat(document.getElementById("nlo_" + row_id).value);
       const wd = parseFloat(document.getElementById("wd_" + row_id).value);

        console.log(amountInput)
        console.log(cc)
        // Calculate the product
        const result_cc = amountInput * cc;
        const result_od = amountInput * od;
        const result_pmf = amountInput * pmf;
        const result_ta = amountInput * ta;
        const result_fe = amountInput * fe;
        const result_me = amountInput * me;
        const result_ht = amountInput * ht;
        const result_tet = amountInput * tet;
        const result_fet = amountInput * fet;
        const result_met = amountInput * met;
        const result_md = amountInput * md;
        const result_fd = amountInput * fd;
        const result_pof = amountInput * pof;
        const result_ir = amountInput * ir;
        const result_alo = amountInput * alo;
        const result_ulo = amountInput * ulo;
        const result_nlo = amountInput * nlo;
        const result_wd = amountInput * wd;
                
        


       console.log(result_cc)
        // Display the result in column 6 (or any other column)
 

       // CC
    var result_id_cc = "result_" + row_id + "_24";
    document.getElementById(result_id_cc).value = result_cc;

    // OD
    var result_id_od = "result_" + row_id + "_25";
    document.getElementById(result_id_od).value = result_od;

    // pmf
    var result_id_pmf = "result_" + row_id + "_26";
    document.getElementById(result_id_pmf).value = result_pmf;

    // TA
    var result_id_ta = "result_" + row_id + "_27";
    document.getElementById(result_id_ta).value = result_ta;

    // FE
    var result_id_fe = "result_" + row_id + "_28";
    document.getElementById(result_id_fe).value = result_fe;

// ME
    var result_id_me = "result_" + row_id + "_29";
    document.getElementById(result_id_me).value = result_me;

    // HT
    var result_id_ht = "result_" + row_id + "_30";
    document.getElementById(result_id_ht).value = result_ht;

    // TET
    var result_id_tet = "result_" + row_id + "_31";
    document.getElementById(result_id_tet).value = result_tet;

    // FET
    var result_id_fet = "result_" + row_id + "_32";
    document.getElementById(result_id_fet).value = result_fet;

    var result_id_met = "result_" + row_id + "_33";
    document.getElementById(result_id_met).value = result_met;
    // MD
    var result_id_md = "result_" + row_id + "_34";
    document.getElementById(result_id_md).value = result_md;

// FD
    var result_id_fd = "result_" + row_id + "_35";
    document.getElementById(result_id_fd).value = result_fd;

    // POF
    var result_id_pof = "result_" + row_id + "_36";
    document.getElementById(result_id_pof).value = result_pof;

    // IR
    var result_id_ir = "result_" + row_id + "_37";
    document.getElementById(result_id_ir).value = result_ir;

    // ALO
    var result_id_alo = "result_" + row_id + "_38";
    document.getElementById(result_id_alo).value = result_alo;

    // ULO
    var result_id_ulo = "result_" + row_id + "_39";
    document.getElementById(result_id_ulo).value = result_ulo;

    // NLO
    var result_id_nlo = "result_" + row_id + "_40";
    document.getElementById(result_id_nlo).value = result_nlo;

    // WD
    var result_id_wd = "result_" + row_id + "_41";
    document.getElementById(result_id_wd).value = result_wd;

       
    }

    var raw_json;
    var raw_group;
    
    window.onload = function () {
       
          loadRaw(function(){

            getRawDropdown('material-select1');
          })
     
      };
   
      var api_url="<?php echo($api_url)?>";
  
      function loadRaw(onsuccess){
       
        async function fetchGroup() {
          
          const url = api_url+"api.php?act=group";
          try {
            const response = await fetch(url);
        
            if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
            }
        
            const data = await response.json(); // รอการแปลง JSON
            raw_group=data
            console.log(raw_group);
            // สมมติว่า data เป็น array
          

            var func=onsuccess()
          } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
          }
        }
        async function fetchData() {
          
           
            const url = api_url+"api.php?act=factor";
            try {
              const response = await fetch(url);
          
              if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }
          
              const data = await response.json(); // รอการแปลง JSON
              raw_json=data
              // สมมติว่า data เป็น array
              const firstItem = raw_json[0].idraw; // ดึงตัวแรกของ array
              console.log('First item:', firstItem);

             // var func=onsuccess()
            } catch (error) {
              console.error('There was a problem with the fetch operation:', error);
            }
          }
          
          // เรียกฟังก์ชัน
          fetchGroup();
          fetchData();
         
      }

</script>



</body>
</html>

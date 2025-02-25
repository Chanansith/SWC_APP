
<?php
// Start session
session_start();
include "config.php";

// Retrieve data from session
$projectname = $_SESSION['projectname'] ?? 'No data';
$description = $_SESSION['description'] ?? 'No data';
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

<h2>LCA Project</h2>

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
                <th>TMF</th>
                <th>TA</th>
                <th>FE</th>
                <th>ME</th>
                <th>HT</th>
                <th>TET</th>
                <th>FET</th>
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
                <th>TMF</th>
                <th>TA</th>
                <th>FE</th>
                <th>ME</th>
                <th>HT</th>
                <th>TET</th>
                <th>FET</th>
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

<button  class="btn btn-success" >Next</button>



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
        const max_group1=23
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
                        cal_data=raw_item.ta;
                        row_id=`ta_${currentrow}`;
                    }
                    
                    if (col_no==4)
                    {
                        cal_data=raw_item.fe;
                        row_id=`fe_${currentrow}`;
                    }
                    if (col_no==5)
                    {
                        cal_data=raw_item.me;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==6)
                    {
                        cal_data=raw_item.ht;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==7)
                    {
                        cal_data=raw_item.tet;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==8)
                    {
                        cal_data=raw_item.tet;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==9)
                    {
                        cal_data=raw_item.tet;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==10)
                    {
                        cal_data=raw_item.met;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==11)
                    {
                        cal_data=raw_item.md;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==12)
                    {
                        cal_data=raw_item.fd;
                        row_id=`me_${currentrow}`;
                    }
                 
                    if (col_no==13)
                    {
                        cal_data=raw_item.pof;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==14)
                    {
                        cal_data=raw_item.ir;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==15)
                    {
                        cal_data=raw_item.alo;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==16)
                    {
                        cal_data=raw_item.ulo;
                        row_id=`me_${currentrow}`;
                    } 
                    if (col_no==17)
                    {
                        cal_data=raw_item.nlo;
                        row_id=`me_${currentrow}`;
                    }
                    if (col_no==18)
                    {
                        cal_data=raw_item.wd;
                        row_id=`me_${currentrow}`;
                    }
                 
                    
                    newCell.style.backgroundColor = 'pink';
                    newCell.innerHTML = `<input id="${row_id}" type="text" value="${cal_data}" readonly  >`;
                
                    col_no++;
          
        }
        const min_group2=23
        const max_group2=40

        for (let i = min_group2; i < max_group2; i++) {
            const newCell = newRow.insertCell(i);
         
                newCell.style.backgroundColor = 'green';
                newCell.innerHTML = '<input type="text" value="0" readonly>';
          
          
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
        const cc =parseFloat(document.getElementById("cc_"+row_id).value)

        // Calculate the product
        const result = amount * cc;

        // Display the result in column 6 (or any other column)
      //  const resultCell = row.cells[22]; // Column 6 (OD)
       // resultCell.innerHTML = result.toFixed(2); // Show result with 2 decimal places

       
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

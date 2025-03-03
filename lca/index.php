<?php
session_start();
include "config.php";
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
<body class="container mt-4">

<h2>LCA </h2>
<form action="addproject.php" method="post">
        <label for="projectname">Project name:</label>
        <input type="text" id="projectname" name="projectname" placeholder="กรอกชื่อโครงการ">
        <label for="projectname">description:</label>
        <input type="text" id="description" name="description">
        <label for="projectname">Quantity:</label>
        <input type="text" id="qty" name="qty" >
        <label for="projectname">Unit</label>
        <input type="text" id="unit" name="unit" >

        <label for="projectname">Lifetime of the system (N)</label>
        <input type="text" id="midpoint" name="midpoint" >

        <label for="projectname">Unit</label>
        <input type="text" id="midpoint_unit" name="midpoint_unit" >

        <label for="projectname">Net output from the system (WPd,Total)</label>
        <input type="text" id="netoutput" name="netoutput" >
      

        <button type="submit" class="btn btn-primary" >Next</button>
    </form>




</body>
</html>

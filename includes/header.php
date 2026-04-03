<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AY25 IWD2 - Protein Conservation Explorer</title>

    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;}

        .example-card,.analysis-card {
            max-width: 1100px;
            margin: 20px auto;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 3px solid #1f2a44;
            background-color: white;}

        .card-body {
            padding: 36px 40px;}

        table, .table {
            border-collapse: collapse !important;
            margin-top: 20px !important;}
            
        th, td {
            border: 1px solid;
            padding: 12px 15px ;
            text-align: ;
            vertical-align: middle ;}
            
        th {
            background: #0f3460;
            color: white;
            font-weight: bold;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f8 ;
        }

        .plot-container, 
        .report-pre {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #dee2e6;
        }
    </body>
</head>

<body>
    <div class="container">
        <h1 style="color:#1e3a8a; margin-top:20px;">Protein Conservation Explorer</h1>
        
        <nav style="background:#0f3460; padding:18px 30px; border-radius:8px; margin-bottom:25px;">
            <a href="index.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">Home</a>
            <a href="example.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">Example Dataset</a>
            <a href="new_analysis.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">New Analysis</a>
            <a href="revisit.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">Revisit</a>
            <a href="about.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">About</a>
            <a href="help.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">Help</a>
            <a href="credits.php" style="color:#fff; margin-right:22px; text-decoration:none; font-weight:bold;">Statement of Credits</a>
        </nav>
        
        <hr style="border:0; height:1px; background:#ddd; margin:0 30px 30px 30px;">
    </div>
</body>
</html>

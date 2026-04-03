<?php 
require_once 'includes/header.php'; 
?>

<!-- Homepage -->

<!-- Page Title & Introduction -->
<div style="
    max-width: 900px;
    margin: 50px auto;
    text-align: center;
    padding: 40px 20px;
    background: #f8f8f8;
    border-radius: 16px;
">
    <h1 style="font-size: 32px; color: #222; margin-bottom: 16px;">
        Protein Conservation Explorer
    </h1>
    <p style="font-size: 18px; color: #555; line-height: 1.6; max-width: 700px; margin: 0 auto 40px;">
        Explore, align, and analyze protein sequences across any species.
        Run conservation analysis, view motifs, and revisit your results through access code.
    </p>

    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <!-- Button to example dataset page -->
        <a href="example.php" style="
            background: #2d8b75;
            color: white;
            padding: 16px 36px;
            text-decoration: none;
            font-size: 17px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: 0.2s;
        "
        onmouseover="this.style.transform='translateY(-3px)'"
        onmouseout="this.style.transform='translateY(0)'">
             Load Example Dataset
        </a>

        <!-- Button to new analysis creation page -->
        <a href="new_analysis.php" style="
            background: #3b66af;
            color: white;
            padding: 16px 36px;
            text-decoration: none;
            font-size: 17px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: 0.2s;
        "
        onmouseover="this.style.transform='translateY(-3px)'"
        onmouseout="this.style.transform='translateY(0)'">
             Start New Analysis
        </a>
    </div>
</div>


<?php require_once 'includes/footer.php'; ?>
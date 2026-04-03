<?php
// about.php
// Overview of the website

require_once 'includes/header.php';
?>

<div style="padding:20px;">
    <i class="bi bi-question-circle me-3"><h2>About This Website</h2>

    <h3>Project Overview</h3>
    <p>This project has been developed as part of In-Course Assessment 2 for AY25, titled 'Introduction to Website and Database Design' (IWD2).</p>
    <p>It is a fully functional bioinformatics web application that allows users to retrieve protein sequences from a taxonomic group of their choice, perform multiple biological queries, and view their results at any time.</p>

    <h3>Technical Architecture</h3>
    <p>The system is based on a hybrid approach with PHP as the primary backend language. </p>
    <p>Computationally intensive bioinformatics tasks are executed using Bash and Python scripts, which allow for integration with professional tools installed on the server (e.g., NCBI EDirect, EMBOSS, Clustal Omega, etc.).</p>

    <h3>Core Features</h3>
    <ul>
        <li>Dynamic retrieval of protein sequences from any protein family and taxonomic group from NCBI.</li>
        <li>Multiple Sequence Alignment and conservation analysis.</li>
        <li>PROSITE motif scanning using the EMBOSS patmatmotifs tool.</li>
        <li>EMBOSS pepstats and amino acid composition visualisation.</li>
        <li>Pre-loaded example dataset (Glucose-6-phosphatase from Aves) that demonstrates all functionalities.</li>
        <li>Storage of all user-generated analyses, allowing users to revisit results anytime.</li>
    </ul>

    <h3>Database Design</h3>
    <p>The database consists of three core tables:</p>
    <ul>
        <li><strong>example_g6p_aves</strong> – Contains the pre-loaded example dataset (Glucose-6-phosphatase from Aves) for functions demonstration.</li>
        <li><strong>user_analyses</strong> – Metadata table that records each user analysis (analysis name, protein family, taxonomic group, access code, creation time, etc.).</li>
        <li><strong>user_sequences</strong> – Detail table that stores the actual protein sequences.</li>
    </ul>

    <div style="margin-top:40px; padding-top:20px; border-top:1px solid #ddd; text-align:center; color:#666;">
        <p>This project demonstrates a complete web development workflow.</p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<?php
// credits.php - Statement of Credits

require_once 'includes/header.php';
?>

<div style="padding:20px;">
    <h2>Statement of Credits</h2>

    <h3>Sources of Code Used</h3>
    <ul>
        <li>PDO database connection and query structure: Based on official PHP PDO documentation and examples from class notes.</li>
        <li>Bootstrap 5: Used for responsive layout, cards, buttons, and icons throughout the entire website. 
            <a href="https://getbootstrap.com/docs/5.3/components/card/" target="_blank">Bootstrap Cards</a></li>
        <li>NCBI EDirect: Used to fetch protein sequences from NCBI Protein database. 
            <a href="https://www.ncbi.nlm.nih.gov/books/NBK179288/" target="_blank">NCBI EDirect Documentation</a></li>
        <li>EMBOSS tools (patmatmotifs, pepstats): Used for motif scanning and physicochemical property analysis. 
            <a href="https://emboss.sourceforge.net/" target="_blank">EMBOSS</a></li>
        <li>Clustal Omega: Used for Multiple Sequence Alignment. 
            <a href="https://www.ebi.ac.uk/tools/msa/clustalo/" target="_blank">Clustal Omega Official</a></li>
        <li>Biopython: Used for generating conservation plots.</li>
        <li>Table display, responsive design, and Bootstrap Icons: Modified from Bootstrap 5 official examples and class notes.</li>
    </ul>

    <h3>AI Tools and What They Were Used For</h3>
    <ul>
        <li><a href="https://grok.com" target="_blank">Grok (XAI)</a>:
            <ul>
                <li>Responsible for debugging of the New Analysis search interface (new_analysis.php).</li>
                <li>Refined the fetch_sequence script (including the recommendation for usage of edirect and sequence import logic).</li>
                <li>Organized and curated reference materials for commonly used CSS design.</li>
            </ul>
        </li>
    </ul>

    <p>Entire project is hosted on GitHub: 
        <a href="https://github.com/ILOVEYUZUSOFT/B295709_ICA2" target="_blank">https://github.com/ILOVEYUZUSOFT/B295709_ICA2</a>
    </p>

    <div style="margin-top:40px; padding-top:20px; border-top:1px solid #ddd; text-align:center; color:#666;">
        <p>AY25 IWD2 – Introduction to Website and Database Design</p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

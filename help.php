<?php
// help.php 

require_once 'includes/header.php';
?>

<div style="padding:20px;">
    <i class="bi bi-question-circle me-3"><h2>Help & Biological Context</h2>

    <p>This website helps biologists explore protein sequence conservation, functional motifs, and physicochemical properties across different taxonomic groups.</p>
    <p>It provides insights into protein similarity, functional prediction, and evolutionary relationships. These are valuable for pathological research, drug development, and related studies.</p>

    <h3>Example Dataset (Glucose-6-phosphatase from Aves)</h3>
    <p>Glucose-6-phosphatase is a key enzyme in glucose metabolism. The example dataset contains 90 real G6PC protein sequences from birds (Aves).</p>
    <p>By examining how conserved this enzyme is across different avian species, you can quickly understand how evolutionary conservation reflects the core biological function of the protein.</p>

    <h3>New Analysis Features</h3>
    <p>You can select any protein family (e.g. G6PC, kinases, ABC transporters) and any taxonomic group (e.g. Mammalia, Aves, Homo sapiens).</p>
    <p>The website automatically retrieves the latest sequences from NCBI and performs multiple sequence alignment, conservation analysis, motif detection, physicochemical property analysis, and amino acid composition visualisation.</p>

    <h3>Multiple Sequence Alignment and Conservation Visualisation</h3>
    <p>Multiple sequence alignment reveals highly conserved regions across species. These regions often correspond to critical functional sites such as catalytic residues or binding pockets.</p>
    <p>This is important for coevolution studies, protein structure analysis, and drug target identification.</p>

    <h3>Functional Motif and Domain Detection</h3>
    <p>By scanning against the PROSITE database, this website can rapidly identify known functional motifs and domains.</p>
    <p>This helps determine binding properties, active site characteristics, and supports protein family classification.</p>

    <h3>Physicochemical Properties and Amino Acid Composition</h3>
    <p>The analysis includes molecular weight, isoelectric point, net charge, physicochemical properties for each residue, and an overall amino acid composition distribution.</p>
    <p>These properties influence protein solubility, stability, localisation, and interactions, revealing evolutionary adaptation patterns.</p>

    <h3>Usage Workflow</h3>
    <ul>
        <li>Use the <strong>Example Dataset</strong> first to quickly explore the full analysis pipeline.</li>
        <li>Use <strong>New Analysis</strong> to study proteins you are interested in.</li>
        <li>Return to any previous dataset via <strong>My Previous Analyses</strong>.</li>
    </ul>
</div>

<?php require_once 'includes/footer.php'; ?>
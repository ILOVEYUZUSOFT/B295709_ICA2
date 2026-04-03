<?php
// view_example_seq.php
// Display sequence details for example dataset

require_once 'includes/header.php';

// Get id from URL
$id = 0;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

// Query the database
$stmt = $pdo->prepare("SELECT accession, description, organism, sequence, seq_length FROM example_g6p_aves WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo '<div style="padding:20px;">';

if ($row == false) {
    echo "<h2>Sequence not found</h2>";
} 
else {
    $accession = htmlspecialchars($row['accession']);
    $description = htmlspecialchars($row['description']);
    $organism = htmlspecialchars($row['organism']);
    $sequence = htmlspecialchars($row['sequence']);
    $length = (int)$row['seq_length'];
    $ncbi = "https://www.ncbi.nlm.nih.gov/protein/" . $accession;
?>

    <h2>Full Sequence: <?php echo $accession; ?></h2>
    
    <p>
        <strong>Organism:</strong> <?php echo $organism; ?><br>
        <strong>Description:</strong> <?php echo $description; ?><br>
        <strong>Length:</strong> <?php echo $length; ?> amino acids<br><br>
        <strong>View on NCBI:</strong> 
        <a href="<?php echo $ncbi; ?>" target="_blank">
            <?php echo $accession; ?> (Open in NCBI Protein)
        </a>
    </p>

    <h3>Protein Sequence:</h3>
    <pre style="background: #f8f8f8; padding:15px; overflow:auto; font-family:monospace; border:1px solid #ccc;">
<?php 
    // show sequence 60 letters each line
    for ($i = 0; $i < strlen($sequence); $i = $i + 60) {
        echo substr($sequence, $i, 60) . "\n";
    }
?>
    </pre>

    <h3>FASTA Format</h3>
    <pre style="background: #f8f8f8; padding:15px; overflow:auto; font-family:monospace; border:1px solid #ccc;">
<?php
    echo ">" . $accession . " " . $description . " | Organism: " . $organism . "\n";
    for ($i = 0; $i < strlen($sequence); $i = $i + 60) {
        echo substr($sequence, $i, 60) . "\n";
    }
?>
    </pre>

    <p>
        <a href="example.php">Back to Example Dataset</a>
    </p>

<?php
} 

echo '</div>';

require_once 'includes/footer.php';
?>
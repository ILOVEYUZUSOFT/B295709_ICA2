<?php
require_once 'includes/header.php';
// run_motif_scan.php 
// Run PROSITE motif scan using EMBOSS patmatmotifs

// Get analysis_id 
$is_example = !empty($_GET['example']);
$analysis_id = (int)($_GET['analysis_id'] ?? 0);

$analysis_name = '';
$back_url = '';
$fasta_path = '';
$motif_file = '';

if ($is_example) {
    $analysis_name = "Example Dataset: Glucose-6-phosphatase from Aves";
    $back_url = "example.php";
    $fasta_path = __DIR__ . "/data/g6p_aves.fasta";
    $motif_file = "outputs/motifs_example.txt";
} 
elseif ($analysis_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM user_analyses WHERE id = ?");
    $stmt->execute([$analysis_id]);
    $analysis = $stmt->fetch();

    if (!$analysis) {
        echo "<h2>Analysis not found</h2>";
    }

    $analysis_name = $analysis['analysis_name'];
    $back_url = "results.php?id=$analysis_id";
    $fasta_path = __DIR__ . '/' . $analysis['fasta_file'];
    $motif_file = "outputs/motifs_{$analysis_id}.txt";
}

$full_motif = __DIR__ . '/' . $motif_file;

// Run motif scan
exec("scripts/run_motif_scan.sh " . escapeshellarg($analysis_id ?: 'example') . " " .
     escapeshellarg($fasta_path) . " " . escapeshellarg($full_motif));

?>

<div style="padding:20px;">
    <h2>PROSITE Motif Scan</h2>
    <p><a href="<?php echo $back_url; ?>"> Back</a></p>
    <h3><?php echo htmlspecialchars($analysis_name); ?></h3>

    <p>PROSITE motif scan completed!</p>

    <?php if (file_exists($full_motif)): 
        $content = file_get_contents($full_motif);
        $count = substr_count($content, 'Motif = ');
    ?>
        <h3>Motif Summary</h3>
        <p><strong><?= $count ?></strong> motifs detected</p>

        <h3>Motif Scan Report</h3>
        <pre style="background:#f8f8f8; padding:15px; overflow:auto; font-family:monospace; border:1px solid #ccc;">
<?= htmlspecialchars($content) ?>
        </pre>

        <p style="margin-top:30px;">
            <a href="<?= $motif_file ?>" download>Download Full Motif Report (.txt)</a>
        </p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
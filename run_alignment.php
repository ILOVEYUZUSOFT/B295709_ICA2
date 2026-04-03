<?php
// run_alignment.php
// Perform Multiple Sequence Alignment (using Clustal Omega) and generate conservation plot

require_once 'includes/header.php';

$is_example = !empty($_GET['example']);
$analysis_id = (int)($_GET['analysis_id'] ?? 0);

$analysis_name = '';
$back_url = '';
$fasta_path = '';
$aln_path = '';
$plot_path = '';

if ($is_example) {
    $analysis_name = "Example Dataset: Glucose-6-phosphatase from Aves";
    $back_url = "example.php";
    $fasta_path = __DIR__ . "/data/g6p_aves.fasta";
    $aln_path   = "outputs/alignment_example.aln";
    $plot_path  = "outputs/conservation_example.png";
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
    $aln_path   = "outputs/alignment_{$analysis_id}.aln";
    $plot_path  = "outputs/conservation_{$analysis_id}.png";
} 
else {
    echo "<h2>parameters not found</h2>";
}

$full_aln  = __DIR__ . '/' . $aln_path;
$full_plot = __DIR__ . '/' . $plot_path;



exec("scripts/run_alignment.sh " . escapeshellarg($analysis_id ?: 'example') . " " .
     escapeshellarg($fasta_path) . " " . escapeshellarg($full_aln));

exec("scripts/conservation_plot.py " . escapeshellarg($full_aln) . " " .
    escapeshellarg($full_plot));

?>

<div style="padding:20px;">
    <h2>Multiple Sequence Alignment + Conservation Plot</h2>
    <p><a href="<?php echo $back_url; ?>"> Back</a></p>
    <h3><?php echo htmlspecialchars($analysis_name); ?></h3>

    <?php if (file_exists($full_plot)): ?>
        <h3>Conservation Plot</h3>
        <p>
            <img src="<?php echo $plot_path; ?>" 
                 style="max-width:100%; height:auto; border:1px solid #ddd;" 
                 alt="Conservation Plot">
        </p>

        <h3>Alignment</h3>
        <pre style="background:#f8f8f8; padding:15px; overflow:auto; font-family:monospace; border:1px solid #ccc; max-height:500px;">
<?php echo htmlspecialchars(file_get_contents($full_aln)); ?>
        </pre>

        <p style="margin-top:30px;">
            <a href="<?php echo $aln_path; ?>" download>Download Full Alignment (.aln)</a>
        </p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
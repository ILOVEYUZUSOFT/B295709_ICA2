<?php
// run_emboss_analysis.php 
// Pepstats analysis and amino acid composition plot

// Get analysis_id
require_once 'includes/header.php';

$is_example = !empty($_GET['example']);
$analysis_id = (int)($_GET['analysis_id'] ?? 0);

$analysis_name = '';
$back_url = '';
$fasta_path = '';
$pepstats_file = '';
$plot_file = '';

if ($is_example) {
    $analysis_name = "Example Dataset: Glucose-6-phosphatase from Aves";
    $back_url = "example.php";
    $fasta_path = __DIR__ . "/data/g6p_aves.fasta";
    $pepstats_file = "outputs/pepstats_example.txt";
    $plot_file = "outputs/aac_plot_example.png";
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
    $pepstats_file = "outputs/pepstats_{$analysis_id}.txt";
    $plot_file = "outputs/aac_plot_{$analysis_id}.png";
}

$full_pepstats = __DIR__ . '/' . $pepstats_file;
$full_plot = __DIR__ . '/' . $plot_file;

exec("scripts/run_pepstats.sh " . escapeshellarg($analysis_id ?: 'example') . " " .
     escapeshellarg($fasta_path) . " " . escapeshellarg($full_pepstats));

exec("scripts/aac_plot.py " . escapeshellarg($fasta_path) . " " . escapeshellarg($full_plot));

?>

<div style="padding:20px;">
    <h2>Additional EMBOSS Analysis</h2>
    <p><a href="<?php echo $back_url; ?>"> Back</a></p>
    <h3><?php echo htmlspecialchars($analysis_name); ?></h3>

    <p>Pepstats analysis completed!</p>

    <?php if (file_exists($full_plot)): 
        $content = file_get_contents($full_pepstats);
    ?>
        <h3>Amino Acid Composition (%)</h3>
        <p>
            <img src="<?php echo $plot_file; ?>" 
                 style="max-width:100%; height:auto; border:1px solid #ddd;" 
                 alt="Amino Acid Composition Plot">
        </p>

        <h3>pepstats Report (Physicochemical Properties)</h3>
        <pre style="background: #f8f8f8; padding:15px; overflow:auto; font-family:monospace; border:1px solid #ccc;">
<?= htmlspecialchars($content) ?>
        </pre>

        <p style="margin-top:30px;">
            <a href="<?= $pepstats_file ?>" download>Download Full pepstats Report</a>
        </p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
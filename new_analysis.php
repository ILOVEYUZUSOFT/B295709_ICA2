<?php
// new_analysis.php

require_once 'includes/header.php';

$message = '';
$debug = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $family = trim($_POST['protein_family'] ?? '');
    $taxon = trim($_POST['taxonomic_group'] ?? '');
    $name = trim($_POST['analysis_name']) ?: "$family in $taxon";
    $max_seq = max(10, min(500, (int)($_POST['max_sequences'] ?? 200)));

    if ($family && $taxon) {
        $timestamp = date('Ymd_His');
        $run_id = strtolower(str_replace([' ', '/', '\\'], '_', $family . '_' . $taxon));
        $fasta_path = "outputs/{$run_id}_{$timestamp}.fasta";
        $full_path = __DIR__ . '/' . $fasta_path;

        $access_code = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));

        $dir = dirname($full_path);
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        touch($full_path);
        chmod($full_path, 0666);

        $command = "python3 scripts/fetch_sequences.py " . escapeshellarg($family) . " " . escapeshellarg($taxon) . " " . escapeshellarg($full_path) . " " . escapeshellarg($max_seq);
        $output = [];
        exec($command . " 2>&1", $output, $return_var);

        $num_seq = 0;
        foreach ($output as $line) {
            if (preg_match('/SEQUENCES_FOUND=(\d+)/', $line, $m)) {
                $num_seq = (int)$m[1];
                break;
            }
        }

        if ($num_seq > 0 && file_exists($full_path) && filesize($full_path) > 0) {
            $stmt = $pdo->prepare("INSERT INTO user_analyses (analysis_name, access_code, protein_family, taxonomic_group, num_sequences, fasta_file, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $access_code, $family, $taxon, $num_seq, $fasta_path]);
            $new_id = $pdo->lastInsertId();

            require_once 'import_user_sequences.php';
            $imported_count = importFastaToDB($new_id, $full_path);

            $message = "
                <h4>Success</h4>
                <p>Found <strong>$num_seq</strong> sequences.</p>
                <p><strong>Your Access Code: <span style='font-size:1.35em; color:#d32f2f;'>$access_code</span></strong><br>
                <small class='text-muted'>Please save this code. You can use it to revisit your results later.</small></p>
                <a href='results.php?id=$new_id' class='btn btn-success btn-lg mt-3'>View Analysis Results</a>
            </div>";
        } else {
            $message = "<div class='alert alert-danger'>Fetch failed. Please check your input or try again.</div>";
        }
    }
}
?>

<div style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
    <div class="analysis-card">

        <div class="card-body">
            <p class="lead text-muted mb-4">
                Fetch custom protein sequences from NCBI
            </p>

            <form method="post">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-bold">Analysis Name (optional)</label>
                        <input type="text" name="analysis_name" placeholder="e.g. Kinases in Humans">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Protein Family <span class="text-danger">*</span></label>
                        <input type="text" name="protein_family" placeholder="e.g. kinase, G6PC" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Taxonomic Group <span class="text-danger">*</span></label>
                        <input type="text" name="taxonomic_group" placeholder="e.g. Homo sapiens, Mammalia" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Maximum sequences to fetch</label>
                        <input type="number" name="max_sequences" value="200" min="10" max="500" required>
                        <small class="text-muted">Recommended: 50-200</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-fetch btn-lg w-100 mt-4 text-white">
                    Fetch Sequences from NCBI
                </button>
            </form>
        </div>
    </div>

    <?php echo $message; ?>

    <?php if ($debug): ?>
        <div class="mt-4 p-4 bg-light border rounded" style="max-width: 1100px; margin: 0 auto;">
            <h5>Debug Information</h5>
            <?php echo $debug; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
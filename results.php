<?php
// results.php
// Displays query results and provides navigation to further analysis tools

require_once 'includes/header.php';

$analysis_id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM user_analyses WHERE id = ?");
$stmt->execute([$analysis_id]);
$analysis = $stmt->fetch();

if (!$analysis) {
    echo "<h2>Analysis not found</h2>";
}
?>

<div style="padding:20px;">
    <i class="bi bi-clipboard-data me-3"><h2>Analysis Results</h2>
    <p><a href="revisit.php">← Back to My Analyses</a></p>

    <h3><?php echo htmlspecialchars($analysis['analysis_name']); ?></h3>

    <p><strong>Protein Family:</strong> <?php echo htmlspecialchars($analysis['protein_family']); ?></p>
    <p><strong>Taxonomic Group:</strong> <?php echo htmlspecialchars($analysis['taxonomic_group']); ?></p>
    <p><strong>Sequences Found:</strong> <?php echo $analysis['num_sequences']; ?></p>

    <h3>Start Further Analysis</h3>
    <p>
        <a href="run_alignment.php?analysis_id=<?php echo $analysis_id; ?>">Run Multiple Sequence Alignment + Conservation Plot</a>
    </p>
    <p>
        <a href="run_motif_scan.php?analysis_id=<?php echo $analysis_id; ?>">Scan PROSITE Motifs</a>
    </p>
    <p>
        <a href="run_emboss_analysis.php?analysis_id=<?php echo $analysis_id; ?>">Additional EMBOSS Analysis</a>
    </p>

    <h3>Sequence List</h3>
    <table style="width:100%; border-collapse:collapse; font-size:0.9em;">
        <thead>
            <tr>
                <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Accession</th>
                <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Organism</th>
                <th style="text-align:center; padding:8px; border-bottom:2px solid #ccc;">Length</th>
                <th style="width:120px; padding:8px; border-bottom:2px solid #ccc;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $seq_stmt = $pdo->prepare("SELECT id, accession, organism, seq_length
                                   FROM user_sequences WHERE analysis_id = ? ORDER BY accession");
        $seq_stmt->execute([$analysis_id]);
        while ($row = $seq_stmt->fetch()):
        ?>
            <tr>
                <td style="padding:8px; border-bottom:1px solid #ddd;"><strong><?php echo htmlspecialchars($row['accession']); ?></strong></td>
                <td style="padding:8px; border-bottom:1px solid #ddd;"><?php echo htmlspecialchars($row['organism']); ?></td>
                <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;"><?php echo $row['seq_length']; ?></td>
                <td style="padding:8px; border-bottom:1px solid #ddd;">
                    <a href="view_user_seq.php?id=<?php echo $row['id']; ?>">View Sequence</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
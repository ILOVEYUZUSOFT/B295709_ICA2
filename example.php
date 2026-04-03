<?php
// Example Dataset Viewer
require_once 'includes/header.php';
?>

<div style="padding:20px;">
    <h2><i class="bi bi-table me-3"></i>Example Dataset</h2>
    <p><a href="new_analysis.php">← Start My Own Analysis</a></p>

    <h3>Glucose-6-phosphatase proteins from Aves (90 sequences)</h3>

    <p><strong>Protein Family:</strong> G6PC</p>
    <p><strong>Taxonomic Group:</strong> Aves</p>
    <p><strong>Total Sequences:</strong> 90</p>

    <h3>Try ALL Website Features with This Example Dataset</h3>

    <p>
        <a href="run_alignment.php?example=1">Multiple Sequence Alignment + Conservation Plot</a>
    </p>
    <p>
        <a href="run_motif_scan.php?example=1">Scan PROSITE Motifs</a>
    </p>
    <p>
        <a href="run_emboss_analysis.php?example=1">Additional EMBOSS Analysis</a>
    </p>

    <h3>Sequence List</h3>
    <div class="table-responsive" style="max-height: 420px; overflow: auto; font-size: 0.9em;">
      <table class="table table-hover align-middle">
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
        $stmt = $pdo->query("SELECT id, accession, organism, seq_length 
                             FROM example_g6p_aves ORDER BY accession");
        while ($row = $stmt->fetch()):
        ?>
            <tr>
                <td style="padding:8px; border-bottom:1px solid #ddd;"><strong><?php echo htmlspecialchars($row['accession']); ?></strong></td>
                <td style="padding:8px; border-bottom:1px solid #ddd;"><?php echo htmlspecialchars($row['organism']); ?></td>
                <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;"><?php echo $row['seq_length']; ?></td>
                <td style="padding:8px; border-bottom:1px solid #ddd;">
                    <a href="view_example_seq.php?id=<?php echo $row['id']; ?>"><i class='bi bi-eye me-1'></i>View Sequence</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
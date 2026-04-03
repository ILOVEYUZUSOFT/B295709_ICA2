<?php
// revisit.php 

require_once 'includes/header.php';

$access_code = trim($_GET['access_code'] ?? '');

$where = "WHERE username = 's2827275'";
$params = [];

if ($access_code !== '') {
    $where .= " AND access_code LIKE ?";
    $params[] = "%$access_code%";}

$stmt = $pdo->prepare("SELECT id, analysis_name, access_code, protein_family, 
                              num_sequences, created_at
                       FROM user_analyses
                       $where
                       ORDER BY created_at DESC");
$stmt->execute($params);
$analyses = $stmt->fetchAll();
?>

<div style="padding:20px;">
    <h2><i class="bi bi-clock-history me-3"></i>My Previous Analyses</h2>

    <form method="get">
        <input type="text" name="access_code" 
               placeholder="Enter Access Code"
               value="<?php echo htmlspecialchars($access_code); ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($access_code): ?>
        <p>Showing results for Access Code: <strong><?php echo htmlspecialchars($access_code); ?></strong></p>
    <?php endif; ?>

    <?php if (empty($analyses)): ?>
        <p>No analyses found for this Access Code.</p>
    <?php else: ?>
     <div class="table-responsive" style="max-height: 420px; overflow: auto; font-size: 0.9em;">
      <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Access Code</th>
                    <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Analysis Name</th>
                    <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Protein Family</th>
                    <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Sequences</th>
                    <th style="text-align:left; padding:8px; border-bottom:2px solid #ccc;">Created</th>
                    <th style="width:100px; padding:8px; border-bottom:2px solid #ccc;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($analyses as $row): ?>
                <tr>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><strong><?php echo htmlspecialchars($row['access_code']); ?></strong></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><?php echo htmlspecialchars($row['analysis_name']); ?></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><?php echo htmlspecialchars($row['protein_family']); ?></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;"><?php echo $row['num_sequences']; ?></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;">
                        <a href="results.php?id=<?php echo $row['id']; ?>"><i class='bi bi-eye me-1'></i>View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
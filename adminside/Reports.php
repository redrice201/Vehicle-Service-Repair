<?php
session_start();
include 'db.php';
include 'service/editstatus.php';
include 'service/modaldetails.php';
?>

<?php include 'adminparts/link.php'?>

<div class="container">
    <?php include 'adminparts/sidebar.php'?>
    <?php include 'adminparts/header.php'?>

    <div class="main-content">
        <div class="page-title">
            <div class="title">Reports</div>
        </div>

        <div class="table-card">
            <div class="card-title">
                <h3><i class="fas fa-shopping-bag"></i> Ready for Release</h3>
            </div>

            <div class="table-filter" style="margin-bottom:15px;">
                <form method="GET" action="" style="display:flex; gap:10px; flex-wrap:wrap;">
                    <label>From: <input type="date" name="from" value="<?= isset($_GET['from']) ? $_GET['from'] : '' ?>"></label>
                    <label>To: <input type="date" name="to" value="<?= isset($_GET['to']) ? $_GET['to'] : '' ?>"></label>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="printReport()">Print Report</button>
                </form>
            </div>

            <table class="data-table" border="1" cellspacing="0" cellpadding="5" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Assign Mechanic</th>
                        <th>Vehicle</th>
                        <th>Problem</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$fromDate = isset($_GET['from']) && $_GET['from'] != '' ? $_GET['from'] : null;
$toDate   = isset($_GET['to']) && $_GET['to'] != '' ? $_GET['to'] : null;

$sql = "
    SELECT so.*, u.full_name, u.phone, u.address, m.full_name AS assignmechanic
    FROM service_orders so
    JOIN users u ON so.user_id = u.id
    LEFT JOIN mechanics m ON so.assignmechanic = m.id
    WHERE so.status = 'Ready for Release'
";

$params = [];
$types = '';

if ($fromDate && $toDate) {
    $sql .= " AND so.created_at BETWEEN ? AND ?";
    $params[] = $fromDate . " 00:00:00";
    $params[] = $toDate . " 23:59:59";
    $types .= 'ss';
} elseif ($fromDate) {
    $sql .= " AND so.created_at >= ?";
    $params[] = $fromDate . " 00:00:00";
    $types .= 's';
} elseif ($toDate) {
    $sql .= " AND so.created_at <= ?";
    $params[] = $toDate . " 23:59:59";
    $types .= 's';
}

$sql .= " ORDER BY so.created_at DESC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()):
    $statusClass = strtolower(str_replace(' ', '-', $row['status']));
?>
<tr data-full='<?= json_encode($row) ?>'>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['full_name']) ?></td>
    <td><?= $row['assignmechanic'] ? htmlspecialchars($row['assignmechanic']) : 'N/A' ?></td>
    <td><?= htmlspecialchars($row['vehicle_model']) ?></td>
    <td><?= htmlspecialchars($row['problem']) ?></td>
    <td><span class="status <?= $statusClass ?>"><?= $row['status'] ?></span></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-outline btn-sm view-btn">View</button>
         
        </div>
    </td>
</tr>
<?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'adminparts/footer.php'; ?>

</body>
</html>

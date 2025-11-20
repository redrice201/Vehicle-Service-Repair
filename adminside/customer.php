<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>

<?php include 'service/editstatus.php' ?>
<?php include 'service/modaldetails.php' ?>
<?php include 'adminparts/link.php'?>
<?php include 'db.php'?>

<div class="container">
    <?php include 'adminparts/sidebar.php'?>
    <?php include 'adminparts/header.php'?>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div id="messageBox">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']);
    }
    ?>

    <div class="main-content">
        <div class="page-title">
            <div class="title">Customer</div>
        </div>

        <div class="table-card">
            <div class="card-title">
                <h3><i class="fas fa-shopping-bag"></i> Recent Orders</h3>
            </div>

            <table class="data-table">
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
                // Fetch orders with used parts including unit price
                $stmt = $conn->prepare("
                    SELECT so.*, u.full_name, u.phone, u.address, m.full_name AS assignmechanic
                    FROM service_orders so
                    JOIN users u ON so.user_id = u.id
                    LEFT JOIN mechanics m ON so.assignmechanic = m.id
                    ORDER BY so.created_at DESC
                ");
                $stmt->execute();
                $result = $stmt->get_result();

                $orders = [];
                while ($row = $result->fetch_assoc()) {
                    $order_id = $row['id'];

                    // Fetch used parts for this order
                    $parts_result = $conn->query("
                        SELECT p.id AS part_id, p.part_name, p.unit_price, op.quantity_used
                        FROM order_parts op
                        JOIN parts_inventory p ON op.part_id = p.id
                        WHERE op.order_id = $order_id
                    ");
                    $parts = [];
                    while ($p = $parts_result->fetch_assoc()) {
                        $parts[] = $p;
                    }

                    $row['used_parts'] = $parts;
                    $orders[] = $row;
                }

                // Render table rows
                foreach ($orders as $row):
                    $statusClass = strtolower(str_replace(' ', '-', $row['status']));
                ?>
                    <tr data-full='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>'>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                        <td><?= $row['assignmechanic'] ? htmlspecialchars($row['assignmechanic']) : 'N/A' ?></td>
                        <td><?= htmlspecialchars($row['vehicle_model']) ?></td>
                        <td><?= htmlspecialchars($row['problem']) ?></td>
                        <td><span class="status <?= $statusClass ?>"><?= $row['status'] ?></span></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline btn-sm view-btn">View</button>
                                <button class="btn btn-outline btn-sm edit-status-btn">Edit Status</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include 'adminparts/footer.php'; ?>
</body>
</html>

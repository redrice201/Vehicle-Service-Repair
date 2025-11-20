<?php
include "userparts/link.php";
include "userparts/header.php";
include "db.php"; 

if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("
    SELECT so.*, m.full_name AS mechanic_name
    FROM service_orders so
    LEFT JOIN mechanics m ON so.assignmechanic = m.id
    WHERE so.user_id = ?
    ORDER BY so.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$services = $result->fetch_all(MYSQLI_ASSOC);

$serviceIds = array_column($services, 'id');
$partsMap = [];
if (!empty($serviceIds)) {
    $idsStr = implode(',', $serviceIds);
    $partsResult = $conn->query("
        SELECT op.order_id, p.part_name, op.quantity_used, p.unit_price
        FROM order_parts op
        JOIN parts_inventory p ON op.part_id = p.id
        WHERE op.order_id IN ($idsStr)
    ");
    while ($row = $partsResult->fetch_assoc()) {
        $partsMap[$row['order_id']][] = $row;
    }
}
?>

<section id="about" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row" style="padding-bottom: 20px;">
      <div class="col-md-5 col-sm-6">
        <div class="about-info">
          <div class="section-title">
            <h2>Our Service Progress</h2>
            <span class="line-bar">...</span>
          </div>
          <p>Track the status of all ongoing, pending, completed, and ready-to-release services in our workshop. Stay informed on each vehicle's progress at a glance.</p>
        </div>
      </div>

      <div class="col-md-7 col-sm-6">
        <div class="about-info skill-thumb">

          <div class="filter-controls" style="margin-bottom:20px;">
            <button data-filter="*" class="filter-btn active btn btn-primary btn-sm">All</button>
            <button data-filter=".pending" class="filter-btn btn btn-warning btn-sm">Pending</button>
            <button data-filter=".ongoing" class="filter-btn btn btn-info btn-sm">Ongoing</button>
            <button data-filter=".completed" class="filter-btn btn btn-success btn-sm">Completed</button>
           <button data-filter=".ready-for-release" class="filter-btn btn btn-secondary btn-sm">Ready for Release</button>

          </div>

          <div class="grid" id="serviceGrid">
           <?php foreach($services as $service): 
                $statusClass = strtolower(str_replace(' ', '-', $service['status'])); 
                $serviceParts = $partsMap[$service['id']] ?? [];
                
                $totalPartsCost = 0;
                foreach($serviceParts as $part) {
                    $totalPartsCost += $part['quantity_used'] * $part['unit_price'];
                }
           ?>
            <div class="service-item <?= $statusClass ?>" data-order-id="<?= $service['id'] ?>">
                <strong><?= htmlspecialchars($service['vehicle_model'] . ' || ' . $service['plate_number']) ?></strong>
                <span class="pull-right"><?= htmlspecialchars($service['status']) ?></span>
                <br>
                <small>Assign Mechanic: <?= htmlspecialchars($service['mechanic_name'] ?? 'N/A') ?></small>
                <br>
                <small>Problem: <?= htmlspecialchars($service['problem']) ?></small>
                <br>
                <small>Delivery Date: <?= htmlspecialchars($service['delivery_date']) ?></small>
                <br>

                <?php if (!empty($serviceParts)): ?>
                    <div style="margin-top:10px;">
                        <strong>Parts Used:</strong>
                        <table class="table table-sm table-bordered" style="margin-top:5px;">
                            <thead>
                                <tr>
                                    <th>Part Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($serviceParts as $part): 
                                    $partTotal = $part['quantity_used'] * $part['unit_price'];
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($part['part_name']) ?></td>
                                        <td><?= htmlspecialchars($part['quantity_used']) ?></td>
                                        <td><?= htmlspecialchars(number_format($part['unit_price'],2)) ?></td>
                                        <td><?= htmlspecialchars(number_format($partTotal,2)) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <strong>Total Parts Cost: <?= number_format($totalPartsCost,2) ?></strong>
                    </div>
                <?php endif; ?>

                <div style="margin-top:5px;">
                    <strong>Service Price: <?= isset($service['price']) ? number_format($service['price'],2) : 'N/A' ?></strong>
                </div>

                <?php if($service['status'] === 'Completed' && empty($service['payment_img'])): ?>
                    <button class="btn btn-success btn-sm mt-2 payment-btn" data-order-id="<?= $service['id'] ?>">Upload Payment</button>
                <?php endif; ?>
            </div>
           <?php endforeach; ?>
          </div>

          <div id="pagination" class="text-center" style="margin-top:20px;">
            <button class="btn btn-default btn-sm prev">Prev</button>
            <span id="pageNumbers"></span>
            <button class="btn btn-default btn-sm next">Next</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php include "userparts/footer.php"; ?>

<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="container">
      
      <?php include 'adminparts/sidebar.php' ?>

      <?php include 'adminparts/header.php' ?>

      <div class="main-content">

        <?php
        $totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

        $totalRevenue = $conn->query("
            SELECT SUM(price) AS total 
            FROM service_orders 
            WHERE status IN ('Completed', 'Ready for Release')
        ")->fetch_assoc()['total'];
        $totalRevenue = $totalRevenue ? $totalRevenue : 0;

        $totalOrders = $conn->query("SELECT COUNT(*) AS total FROM service_orders")->fetch_assoc()['total'];

        $pending = $conn->query("SELECT COUNT(*) AS total FROM service_orders WHERE status='Pending'")->fetch_assoc()['total'];
        $ongoing = $conn->query("SELECT COUNT(*) AS total FROM service_orders WHERE status='Ongoing'")->fetch_assoc()['total'];
        $completed = $conn->query("SELECT COUNT(*) AS total FROM service_orders WHERE status='Completed'")->fetch_assoc()['total'];
        $readyRelease = $conn->query("SELECT COUNT(*) AS total FROM service_orders WHERE status='Ready for Release'")->fetch_assoc()['total'];

        $completionRate = $totalOrders > 0 ? round(($completed / $totalOrders) * 100) : 0;
        ?>

        <div class="stats-cards">

          <div class="stat-card">
            <div class="card-header">
              <div>
                <div class="card-value"><?php echo number_format($totalUsers); ?></div>
                <div class="card-label">Total Users</div>
              </div>
              <div class="card-icon purple">
                <i class="fas fa-users"></i>
              </div>
            </div>
            
          </div>

          <div class="stat-card">
            <div class="card-header">
              <div>
                <div class="card-value">₱<?php echo number_format($totalRevenue, 2); ?></div>
                <div class="card-label">Total Revenue</div>
              </div>
              <div class="card-icon blue">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
           
          </div>

          <div class="stat-card">
            <div class="card-header">
              <div>
                <div class="card-value"><?php echo number_format($totalOrders); ?></div>
                <div class="card-label">Total Orders</div>
              </div>
              <div class="card-icon green">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
         
          </div>

        
        

        </div> 

      </div> 

    </div>
  </body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "db.php";

if (isset($_SESSION['message'])) {
    echo '<div id="messageBox">'.$_SESSION['message'].'</div>';
    unset($_SESSION['message']);
}
?>

<?php include 'adminparts/link.php'?>

<div class="container">
    
 <?php include 'adminparts/sidebar.php'?>
  
 <?php include 'adminparts/header.php'?>

  <div class="main-content">
    <div class="page-title">
      <div class="title">Parts Used Inventory</div>

      <div class="action-buttons">
        <button class="btn btn-primary" id="openAddPartModal">
          <i class="fas fa-plus"></i> Add Part
        </button>
      </div>
    </div>

    <div class="table-card">
      <div class="card-title">
        <h3><i class="fas fa-cogs"></i> Parts Inventory List</h3>
      </div>

      <table class="data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Part Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM parts_inventory ORDER BY id DESC");
        while($row = $result->fetch_assoc()){

            $status = ($row['quantity'] > 0) ? "In Stock" : "Out of Stock";
            $price = number_format($row['unit_price'], 2);

            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['part_name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['quantity']}</td>
                <td>₱{$price}</td>
                <td>{$status}</td>
                <td>
                  <button class='btn btn-outline btn-sm btn-edit' 
                          data-id='{$row['id']}'
                          data-name='{$row['part_name']}'
                          data-category='{$row['category']}'
                          data-quantity='{$row['quantity']}'
                          data-price='{$row['unit_price']}'>
                          Edit
                  </button>

                  <button class='btn btn-outline btn-sm btn-delete'
                          data-id='{$row['id']}'>
                          Delete
                  </button>
                </td>
            </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'parts/modal_add_part.php'?>
<?php include 'parts/modal_edit_part.php'?>
<?php include 'parts/modal_delete_part.php'?>
<?php include 'adminparts/footer.php'?>


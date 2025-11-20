    <?php
session_start();
include "db.php";
if (isset($_SESSION['message'])) {
    echo '
    <div id="messageBox">'.$_SESSION['message'].'</div>';

    unset($_SESSION['message']);
}
?>

    <?php include 'adminparts/link.php'?>

    <div class="container">
        
     <?php include 'adminparts/sidebar.php'?>
      
     <?php include 'adminparts/header.php'?>

      <div class="main-content">
        <div class="page-title">
          <div class="title">Mechanical Employee</div>
          <div class="action-buttons">
           
       <button class="btn btn-primary" id="openAddMechanicModal">
  <i class="fas fa-plus"></i> Add New
</button>

          </div>
        </div>

       
        <div class="table-card">
          <div class="card-title">
            <h3><i class="fas fa-shopping-bag"></i> Recent Orders</h3>
            
          </div>
          <table class="data-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Mechanic</th>
                 <th>Email</th>
                <th>Phone</th>
                <th>Specialization</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php
$result = $conn->query("SELECT * FROM mechanics ORDER BY id DESC");
while($row = $result->fetch_assoc()){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['full_name']}</td>
         <td>{$row['email']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['specialization']}</td>
        <td>{$row['status']}</td>
        
       <td>
  <button class='btn btn-outline btn-sm btn-edit'>Edit</button>
  <button class='btn btn-outline btn-sm btn-delete'>Delete</button>
</td>
  </tr>";
}
?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
<?php include 'mechanicmodal/modalmechanic.php'?>

<?php include 'mechanicmodal/confirmation.php'?>
    
<?php
include 'adminparts/footer.php'
?>



<?php include 'mechanicmodal/modaleditmechanic.php'?>
  </body>
</html>

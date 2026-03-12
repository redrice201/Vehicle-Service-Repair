<?php
session_start();
include "db.php";

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../userside/index.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Check current password if user wants to change
    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();
    $current_hashed_password = $user_data['password'];

    if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (password_verify($current_password, $current_hashed_password)) {
            if ($new_password === $confirm_password) {
                $hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                $stmt->bind_param("si", $hashed, $user_id);
                $stmt->execute();
                $success = "Profile and password updated successfully.";
            } else {
                $error = "New passwords do not match.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }

    // Update profile
    $stmt = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $user_id);
    $stmt->execute();

    // Refresh user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if(empty($error) && empty($success)){
        $success = "Profile updated successfully.";
    }
}
?>

<?php include 'adminparts/link.php'?>



<div class="container">
    <?php include 'adminparts/sidebar.php'?>
    <?php include 'adminparts/header.php'?>

    <div class="main-content">
        <div class="page-title">
            <div class="title">User Data</div>
            <div class="action-buttons"></div>
        </div>

        <div class="table-card">
            <div class="card-title">
                <h3>Profile Information</h3>
            </div>

            <!-- Message Box -->
           
            <form method="POST" action="" style="padding:10px 5px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                 <div class="form-group">
    <label>Contact Number</label>
    <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" pattern="09[0-9]{9}" maxlength="11" required title="Philippine mobile number format: 09XXXXXXXXX (11 digits)">
</div> 

                <div class="form-group">
                    <label>Home Address</label>
                    <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-secondary btn-sm mb-2" id="togglePassword">Change Password</button>
                </div>

                <div id="passwordFields" style="display:none;">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
            </form>
        </div>
    </div>
</div>

<?php include 'mechanicmodal/modalmechanic.php'?>
<?php include 'mechanicmodal/confirmation.php'?>
<?php include 'adminparts/footer.php'?>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    let fields = document.getElementById('passwordFields');
    fields.style.display = fields.style.display === 'none' ? 'block' : 'none';
});
</script>

<?php include 'mechanicmodal/modaleditmechanic.php'?>
</body>
</html>

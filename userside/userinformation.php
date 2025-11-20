<?php
include "userparts/link.php";
include "userparts/header.php";


if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

include "db.php";

$user_id = $_SESSION["user"]["id"];

$stmt = $conn->prepare("SELECT full_name, email, phone, address FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>


<section id="user-info" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">

      <div class="col-md-6 col-sm-6">
        <div class="about-info">
          <div class="section-title">
            <h2>User Information</h2>
            <span class="line-bar">...</span>
          </div>
          <p>Update your personal details. You may also change your password at any time for security purposes.</p>
          <div id="messageBox"></div>
        </div>
      </div>

      <div class="col-md-6 col-sm-6">
        <form id="userInfoForm" method="POST">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
          </div>

          <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>

          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
          </div>

          <div class="form-group">
            <label>Home Address</label>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" required>
          </div>

          <div class="form-group">
            <button type="button" id="togglePassword" class="btn btn-secondary btn-sm" style="margin-bottom:10px;">
              Change Password
            </button>
          </div>

          <div id="passwordFields" style="display:none;">
            <div class="form-group">
              <label>Current Password</label>
              <input type="password" name="current_password" class="form-control">
            </div>

            <div class="form-group">
              <label>New Password</label>
              <input type="password" name="new_password" class="form-control">
            </div>

            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_password" class="form-control">
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
        </form>
      </div>

    </div>
  </div>
</section>




<?php
include "userparts/footer.php";
?>

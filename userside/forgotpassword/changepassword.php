<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<div id="changeForgotPasswordModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="wrapper">
      <div class="title">Change Password</div>
      <form id="changeForgotPasswordForm">
        <div class="field">
          <input type="password" name="new_password" required placeholder="New Password">
        </div>
        <div class="field">
          <input type="password" name="confirm_password" required placeholder="Confirm Password">
        </div>
      <input type="hidden" name="email" value="<?= $_SESSION['password_reset']['email'] ?>">
        <div class="field">
          <input type="submit" value="Change Password">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include "userparts/link.php";
?>
<div id="forgotPasswordModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="wrapper">
      <div class="title">Forgot Password</div>

      <form id="forgotPasswordForm">
        <div class="field">
          <input type="email" name="email" required>
          <label>Email Address</label>
        </div>

        <div class="field">
          <input type="submit" value="Send Reset Link">
        </div>

        <div class="content">
          <div class="pass-link">
            <a href="#" class="backToLogin">Back to Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

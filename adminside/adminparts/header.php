<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: ../userside/index.php");
    exit();
}

if (!isset($_SESSION['user']['is_admin']) || $_SESSION['user']['is_admin'] != 1) {
    header("Location: ../userside/index.php");
    exit();
}
?>


<div class="header">
  <div class="search-bar" style="background-color:white;">
  </div>

  <div class="header-actions">
    <div class="user-profile">
      <a href="profile.php" style="display:flex; text-decoration:none; color:inherit;">
        
        <div class="profile-img">
            <?= strtoupper(substr($_SESSION['user']['name'], 0, 2)); ?>
        </div>

        <div class="user-info">
          
          <!-- Full Name -->
          <div class="user-name">
            <?= htmlspecialchars($_SESSION['user']['name']); ?>
          </div>

          <!-- Fixed Role -->
          <div class="user-role">
            Administrator
          </div>

        </div>

      </a>
    </div>
  </div>
</div>

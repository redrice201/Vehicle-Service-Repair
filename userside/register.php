<?php
include "userparts/link.php";
?>

<div id="registerModal1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="wrapper">
            <div class="title">
               Register
            </div>
          <form id="registerForm">

    <div class="field">
        <input type="text" name="full_name" required>
        <label>Full Name</label>
    </div>

    <div class="field">
        <input type="email" name="email" required>
        <label>Email Address</label>
    </div>

    <div class="field">
        <input type="number" name="contact" required>
        <label>Contact</label>
    </div>

    <div class="field">
        <input type="text" name="address" required>
        <label>Address</label>
    </div>

    <div class="field">
        <input type="password" name="password" required>
        <label>Password</label>
    </div>

    <div class="field">
        <input type="password" name="confirm_password" required>
        <label>Confirm Password</label>
    </div>

    <div class="field">
        <input type="submit" value="Register">
    </div>

</form>

        </div>
    </div>
</div>
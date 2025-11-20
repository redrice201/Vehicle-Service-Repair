 <?php
 
 include "userparts/link.php";
 
 ?>
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="wrapper">
            <div class="title">Login</div>

          <form id="loginForm">

                <div class="field">
                    <input type="text" name="email" required>
                    <label>Email Address</label>
                </div>

                <div class="field">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>

                <div class="field">
                    <input type="submit" value="Login">
                </div>

               <div class="pass-link">
    <a href="#" class="openForgot">Forgot password?</a>
</div>

<div class="pass-link">
    <a href="#" class="openRegister">Sign Up</a>
</div>

            </form>
        </div>
    </div>
</div>

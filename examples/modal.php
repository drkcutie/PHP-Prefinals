<?php
session_start();
?>
<link rel = "stylesheet" href = "styles.css"/>

<!--ALERTS-->
<div id="success-popup" class="popup alert alert-success" role="alert">
    Signup successful!
</div>
<div id="error-popup" class="popup alert alert-danger" role="alert" style="font-size: 14px">
    Incorrect login. Logging out.
</div>
<div class="popup alert alert-primary" id = "posted-popup" role="alert">
    Successfully posted!
</div>
<div class="popup alert alert-secondary" role="alert" id = "delete-popup">
    Successfully deleted!
</div>
<div id="errorDelete-popup" class="popup alert alert-danger" role="alert" style="font-size: 14px">
    You don't have permission to delete.
</div>
<div id="login-popup" class="popup alert alert-danger" role="alert" style="font-size: 14px">
    Login successful.
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sign in</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loginForm">
                <form action="index.php" method="post">
                    <label for="fname" style="font-family: 'Courier New',sans-serif">Name: </label><br>
                    <input type="text" name="user-name"  placeholder="Enter name..." required/>


            </div>
            <div class="modal-footer" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="text-align: left;">
                    <p style="margin: 0;">Current User:</p>
                    <p id="userHere" style="margin: 0;"></p>
                </div>
                    <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="loginButton">Login</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- REGISTER MODAL -->
<div class="modal fade" id="registerArea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sign in / Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--                submit should be inside the form in order to workk...-->
                <form action="index.php" method="post">
                    <label for="NAME" style="font-family: 'Courier New',sans-serif">Name: </label><br>
                    <input type="text" name="NAME" style="margin-bottom: 10px" required><br>
                    <label for="USERNAME" style="font-family: 'Courier New',sans-serif">Username: </label><br>
                    <input type="text" name="USER-NAME" style="margin-bottom: 10px" required/><br>
                    <label for="EMAIL" style="font-family: 'Courier New',sans-serif">Email: </label><br>
                    <input type="email" name="EMAIL" style="margin-bottom: 10px" required/><br>
                    <label for="STREET" style="font-family: 'Courier New',sans-serif">Street: </label><br>
                    <input type="text" name="STREET" style="margin-bottom: 10px" required/><br>
                    <label for="BARANGAY" style="font-family: 'Courier New',sans-serif">Barangay: </label><br>
                    <input type="text" name="BARANGAY" style="margin-bottom: 10px" required/><br>
                    <label for="CITY" style="font-family: 'Courier New',sans-serif">City: </label><br>
                    <input type="text" name="CITY" style="margin-bottom: 10px" required/><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="registerButton" >Sign up
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

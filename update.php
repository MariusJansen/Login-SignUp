<?php
/* init.php includes everything we need
 * has to be included in every file!
 *
 */
require_once 'core/init.php';

if(isset($_POST['submitUsername' ])){
    $validation = new InputValidation($_POST);
    $errorsUsername = $validation->validateUsername();
    if(!$errorsUsername){
        $updateUsername = new User($_POST);
        $updateUsername->updateUsername();
    }
}
if(isset($_POST['submitPassword'])){
    $validation = new InputValidation($_POST);
    $errorsPassword = $validation->validatePassword();
    if(!$errorsPassword){
        $updatePassword = new User($_POST);
        $updatePassword->updatePassword();
    }
}

?>

<body>
<div class="container col-5">
    <a href="profile.php"><- back</a>
    <h3>Change your username or password</h3>
        <div class="mb-4">
            <div class="card">
                <div class="card-header">
                    Change Username
                </div>
                <div class="card-body">
                    <?php
                    if(empty($updateUsername)){
                        echo "";
                    } else {
                        echo "<div class='alert alert-success'>Your username was updated to ".$_SESSION[Config::get('session/session_name')]."! Going back to
                                <a href='profile.php'>Profile</a></div>";
                    }
                    $errorMessagesUsername = [];
                    if(!isset($errorsUsername['username'])){
                        echo '';
                    } else {
                        $errorMessagesUsername[] .= $errorsUsername['username'];
                    }
                    if(!isset($errorMessagesUsername)){
                        echo '';
                    } else {
                        foreach ($errorMessagesUsername as $errorMessageUser){
                            echo "<div class='alert alert-danger'>".$errorMessageUser."</div>";
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username">Enter your new username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $_POST['username'] ?? '' ?>" placeholder="Enter your username">
                        </div>
                        <input type="submit" name="submitUsername" value="Change username" class="btn btn-success col-12">
                    </form>
                </div>
            </div>
        </div>
        <div >
            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body ">
                    <?php
                    if(empty($updatePassword)){
                        echo "";
                    } else {
                        echo "<div class='alert alert-success'>Your password was updated. Going back to
                                <a href='profile.php'>Profile</a></div>";
                    }
                    $errorMessagesPassword = [];
                    if(!isset($errorsPassword['password'])){
                        echo '';
                    } else {
                        $errorMessagesPassword[] .= $errorsPassword['password'];
                    }
                    if(!isset($errorMessagesPassword)){
                        echo '';
                    } else {
                        foreach ($errorMessagesPassword as $errorMessage){
                            echo "<div class='alert alert-danger'>".$errorMessage."</div>";
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="password">Enter your new password</label>
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo $_POST['password'] ?? '' ?>"  placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="reenterPassword">Enter your new password</label>
                            <input type="password" name="reenterPassword" id="reenterPassword" class="form-control" placeholder="Repeat password">
                        </div>
                        <input type="submit" value="Change password" name="submitPassword" class="btn btn-success col-12">
                    </form>
                </div>
            </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


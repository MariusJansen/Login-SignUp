<?php
/* init.php includes everything we need
 * has to be included in every file!
 *
 */
require_once 'core/init.php';
if(isset($_POST['submit'])){
    $validation = new InputValidationLogin($_POST);
    $errors = $validation->validateLogin();
    
    if(!$errors){
        $login = new User($_POST);
        $login->loginUser();
    }
}
?>
<body >
<div class="container col-lg-5 mt-3">
<h3>Login to your profile <i class="fa-solid fa-right-to-bracket"></i></h3>
<?php
/**
 * Sammelt alle Errors in einem Array und gibt diese für den User aus
 */
$errorMessages = [];
if (!isset($errors['username'])) {
    echo '';
} else {
    $errorMessages[] .= $errors['username'];
}

if (!isset($errors['password'])) {
    echo '';
} else {
    $errorMessages[] .= $errors['password'];
}

if(!isset($errorMessages)){
    echo '';
} else {
    foreach ($errorMessages as $errorMessage){
        echo "<div class='alert alert-danger'>".$errorMessage."</div>";
    }
}

?>
<form action="" method="post">
    <div class="mb-3">
        <label for="username">Enter your username</label>
        <input name="username" id="username" class="form-control" value="<?= $_POST['username'] ?? '' ?>" 
               placeholder="Usersame">
    </div>
    <div class="mb-3">
        <label for="password">Enter your password</label>
        <input type="password" name="password" id="password" class="form-control" value="<?= $_POST['password'] ?? '' ?>" 
               placeholder="Password">
    </div>
    <input type="submit" value="Login" class="btn btn-success col-12 mb-3" name="submit">
    <p>No account yet? <a href="register.php">Sign Up</a></p>
    
    
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
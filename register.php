<?php
// init.php includes everything we need and has to be included in every file!
require_once 'core/init.php';
if(isset($_POST['submit'])){
    // validate entries
    // $_POST returns an array
 
    $validation = new InputValidation($_POST);
    $errors = $validation->validateForm();
    
    if(!$errors){
        $registerUsers = new User($_POST);
        $registerUsers->registerNewUser();  
    }

}
include_once 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>    
<body >
<div class="container col-lg-5 mt-3">
    

    <h3>Register to our page <i class="fa-solid fa-address-card"></i></h3>
    <?php
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

    if (!isset($errors['reenterPassword'])) {
        echo '';
    } else {
        $errorMessages[] .= $errors['reenterPassword'];
    }

    if (!isset($errors['name'])) {
        echo '';
    } else {
        $errorMessages[] .= $errors['name'];
    }
    if(!isset($errorMessages)){
        echo '';
    } else {
        
        foreach ($errorMessages as $errorMessage){
            echo "<div class='alert alert-danger'>".$errorMessage."</div>";
        }
    }

    ?>
    <form action="" method="POST" class="d-flex flex-column ">
    <div>
        <label for="username">Enter your username</label>
        <input type="text" name="username" id="username" placeholder="Username"
               value="<?= $_POST['username'] ?? '' ?>" autocomplete="off" class="form-control mb-2">

    </div>
    <div>
        <label for="password">Enter your password</label>
        <input type="password" name="password" id="username" placeholder="Password" value="<?= $_POST['password'] ?? '' ?>" class="form-control mb-2"
        >

    </div>
    <div>
        <label for="reenterPassword">Repeat your password</label>
        <input type="password" name="reenterPassword" id="reenterPassword" 
               placeholder="Repeat password" value="" class="form-control mb-2">

    </div>
    <div class="mb-3">
        <label for="name">Enter your full name</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?= $_POST['name'] ?? '' ?>" class="form-control mb-2">
    </div>
    <input type="submit" class="btn btn-success mb-3" value="Submit" name="submit">
</form>
<p>You already have an account? <a href="login.php">Log in</a></p>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
        crossorigin="anonymous"></script>
</body>
</html>
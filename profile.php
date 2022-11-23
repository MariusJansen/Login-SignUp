<?php
/* init.php includes everything we need
 * has to be included in every file!
 *
 */
require_once 'core/init.php';

if(isset($_POST['submit'])){
    $logoutUser = new User($_POST);
    $logoutUser->logoutUser();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body >
  <div class="container mt-3">
      <div class="alert alert-success d-flex justify-content-between align-items-center">
          <div>
              <h5 class="m-0">Welcome, <?php echo $_SESSION['user'] ?>!</h5>
          </div>
          <form action="" method="post">
              <div class="d-flex align-items-center">
                  <input type="submit" value="Log out" name="submit" id="submit" class="btn btn-success me-2">
                  <a href="update.php" class="m-0 p-0"><i class="fa-solid fa-lg fa-gear link-secondary"></i></a>
              </div>
          </form>
      </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
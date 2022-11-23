<?php
/* init.php includes everything we need
 * has to be included in every file!
 */

require_once 'core/init.php';

if(!$_SESSION['user']){
    header('Location: register.php');
} else {
    header('Location: profile.php');
}



<?php
/* init.php includes everything we need
 * has to be included in every file!
 */

require_once 'core/init.php';

/**
 * Existiert keine Session, wird der User zur Registrierungseite weitergeleitet
 * Existiert eine Session, wird der User zur Loginseite weitergeleitet
 */
if(!$_SESSION['user']){
    header('Location: login.php');
} else {
    header('Location: profile.php');
}



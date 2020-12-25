<?php
require_once "userLoginTrans.php";
if (login('bob','pswd')) {
 if (isset($_SESSION['user'])) {
    print '<p>'.'Your account name: '.$_SESSION['user'].'</p>';
 } else {
    print '<p>'.'Session variable representing the account name is not set'.'</p>';
 }
}else {
    print '<p>'.'Authentication failed'.'</p>';
 }
?>
<?php 
require_once './include/session-start.php';

if (!isset($_SESSION['user_id'])) {
  include './include/html/nav-unregistered.php';
}?>

<?php 
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['privilege'] == 2) {
      include './include/html/nav-admin.php';
    }
    if ($_SESSION['privilege'] == 1) {
      include './include/html/nav-registered.php';
    }
}
?>


<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
  header ('Location: index1.php');
  exit();
}
?>

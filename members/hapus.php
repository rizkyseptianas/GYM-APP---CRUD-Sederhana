<?php
include "../config/koneksi.php";
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['login'])) header("Location: ../auth/login.php");

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM members WHERE id='$id'");
header("Location: index.php?msg=hapus");
exit;

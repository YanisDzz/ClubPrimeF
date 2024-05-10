<?php
session_start();
require_once '../model/login.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $adminModel = new AdminModel();
    $admin = $adminModel->authenticateAdmin($username, $password);

    if ($admin && $password === $admin['password']) {
        $_SESSION['admin'] = $admin;
        header('Location: ../index.php');
        exit();
    } else {
        $error = '<span style="color:red;">Identifiants ou mot de passe incorrect.</span>';
    }
}

include '../vue/login.php';
?>

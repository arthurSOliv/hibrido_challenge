<?php
    if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    }

    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'hibridoback') or die(mysqli_error($mysqli));

    $update = false;
    $id = 0;
    $name = '';
    $email = '';
    $cpf = '';
    $tel = '';

    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $tel = $_POST['tel'];

        $mysqli->query("INSERT INTO users (name, email, cpf, tel) VALUES ('$name', '$email', '$cpf', '$tel')") or
                die($mysqli->error);
        
        $_SESSION['message'] = "Usuário cadastrado!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");
    }   


    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $mysqli->query("DELETE FROM users WHERE id=$id") or
                die($mysqli->error);

        $_SESSION['message'] = "Usuário removido!";
        $_SESSION['msg_type'] = "danger";
    } 

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $update = true;

        $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or
                die($mysqli->error);

        if(count($result) == 1) {
            $row = $result->fetch_array();
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $cpf = $row['cpf'];
            $tel = $row['tel'];
        }
    } 

    if(isset($_POST['cancel'])) {

        $update = false;
        $id = 0;
        $name = '';
        $email = '';
        $cpf = '';
        $tel = '';

        header("location: index.php");
    } 

    if(isset($_POST['update'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $tel = $_POST['tel'];

        $mysqli->query("UPDATE users SET name='$name', email='$email', cpf='$cpf', tel='$tel' WHERE id=$id") or
                die($mysqli->error);
        
        $_SESSION['message'] = "Usuário editado!";
        $_SESSION['msg_type'] = "warning";

        header("location: index.php");
    } 
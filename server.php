<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// define variables
$nameError = $signatureError = $emailError = $passwordError = "";
$name = $signature = $email = $password = "";


//connection to the database
$servername = "mysql:dbname=registration;host=localhost";
$dbUsername = "admin";
$dbPassword = "Admin0713?";

try {
    $db = new PDO($servername, $dbUsername, $dbPassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} 
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


// FUNCTION TO CHECK INPUTS 

function testInput($data) {
    // cuts unnecessary tabs, spaces, newlines & remove backslashes 
    $data = trim($data); 
    $data = stripslashes($data);
    // security check
    $data = htmlspecialchars($data);
    return $data;
}


// REGISTER FORM

if (isset($_POST['register_user'])) {
    // 'register_user being the name of my submit btn
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = testInput($_POST["name"]);
        // name contains only letters & whitespaces ?
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["signature"])) {
        $signature = "";
    } else {
        $signature = testInput($_POST["signature"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$signature)) {
            $signatureError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = testInput($_POST["email"]);
        // email correct form ?
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $testedPassword = testInput($_POST["password"]);
        $password = hash('sha256', $testedPassword);
    }

    $query = $db->prepare('SELECT * FROM users WHERE name ="'. $name .'" OR email= "'. $email .'"');
    $query->execute();
    $result_user = $query->fetch();

    if ($result_user['name'] === $name) {
        $nameError = "Name already exists";
    } 
    else if ($result_user['email'] === $email) {
        $emailError = "Email already exists";
    } 
    else if ($nameError == "" && $signatureError == "" && $emailError == "" && $passwordError == "") {
        $query = $db->prepare("INSERT INTO users (name, signature, email, password) VALUES('$name', '$signature', '$email', '$password')");
        $query->execute();

        $_SESSION['name'] = $name;
        header('location: index.php');
    }
}


// LOGIN FORM

if (isset($_POST['login_user'])) {
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = testInput($_POST["name"]);
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = hash('sha256', testInput($_POST["password"]));
    }

    if ($nameError == "") {
        $query = $db->prepare('SELECT * FROM users WHERE name="' . $name . '" AND password="' . $password . '"');
        $query->execute();
        if ($query->rowCount() == 1) {
            $_SESSION['name'] = $name;
            header('location: index.php');
        } else {
            print_r("No account on this name");
        }
    }
}

?>
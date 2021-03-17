<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// define variables
$nameError = $signatureError = $emailError = $passwordError = "";
$name = $signature = $email = $password = "";


//connection to the database
$servername = "mysql:dbname=".getenv("DB_NAME").";host=".getenv("SERVER");
$dbUsername = getenv("DB_USERNAME");
$dbPassword = getenv("DB_PASSWORD");

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
            $nameError = "Only letters and white space allowed!";
        }
        if (strlen($name) > 50) {
            $nameError = "Name is too long!";
        }
    }

    if (empty($_POST["signature"])) {
        $signature = "";
    } else {
        $signature = testInput($_POST["signature"]);
        if (!preg_match("/^\*,\\,\{,\},\[,\]*$/",$signature)) {
            $signatureError = "Don't use weird character come on!";
        }
        if (strlen($signature) > 250) {
            $signatureError = "Signature is too long!";
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
        $_SESSION['signature'] = $signature;
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

    if ($nameError == "" && $passwordError == "") {
        $query = $db->prepare('SELECT * FROM users WHERE name="' . $name . '" AND password="' . $password . '"');
        $query->execute();
        $result = $query->fetch();

        if ($query->rowCount() == 1) {
            $_SESSION['name'] = $name;
            $_SESSION['signature'] = $result['signature'];
            header('location: index.php');
        } else {
            $nameError = "No account on this name";
            // print_r("No account on this name");
        }
    }
}

?>
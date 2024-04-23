<?php
include 'config.php';
session_start();
// check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// fetch the user's name based on the user_id from the session
$user_id = $_SESSION['user_id'];
$sql = "SELECT full_name FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['full_name'];
} else {
    $user_name = 'Unknown';
}

$r_type;
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        select, input[type="text"] {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Book Ticket</h2>
    <form action="booking_c.php" method="post">
        <label for="path">Path:</label><br>
        <select id="path" name="path">
            <option value="from_bracu">From BRAC University to home</option>
            <option value="to_bracu">From home to BRAC University</option>
        </select><br>
        <button type="submit">Continue</button>
    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["path"])) {
            $var = $_POST["path"];
            if ($var == "to_bracu"){
                header("Location: book_ticket.php");
                exit; // make sure to exit after redirecting
            } else if ($var == "from_bracu"){
                header("Location: book_ticket2.php");
                exit; // make sure to exit after redirecting
            }
        }
    }
    ?>
</div>
</body>
</html>
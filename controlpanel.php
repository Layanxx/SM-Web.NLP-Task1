<?php

$servername = "localhost:3306";
$username = " root";
$password = "";
$dbname = "dir_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['button'])) {
    $direction = $_POST['button'];

    $sql = "INSERT INTO directions (direction) VALUES ('$direction')";

    if ($conn->query($sql) === TRUE) {
        echo "Direction registered.";
    } else {
        echo "Direction not registered: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM directions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Directions</title>

    <style>
body {
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: black;
            text-align: center;
        }

        button {
            width: 15%;
            height: 30px;
            background-color: lightpink;
            border-width: 0px;
            margin-top: 3%;
            margin-right: 3%;
        }

        button:hover {
            background-color: rgb(206, 106, 123);
        }

    </style>

</head>

<body>
    <h1>Control Panel</h1>
    <form method="POST" action="">
        <button type="submit" name="button" value="F">Forward</button><br> 
        <button type="submit" name="button" value="L">left</button>
        <button type="submit" name="button" value="S">Stop</button>
        <button type="submit" name="button" value="R">Right</button><br> 
        <button type="submit" name="button" value="B">Backward</button>
    </form>
    <h2>Registered Directions:</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['direction'] . "</li>";
            }
        } else {
            echo "<li>No directions registered.</li>";
        }
        ?>
    </ul>

    <?php
    $conn->close();
    ?>

</body>
</html>
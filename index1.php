<!DOCTYPE html>
<html>
<head><title>OIE Orders</title></head>
<body>
<?php
//unset($_COOKIE[user]);
//setcookie("user", "", time() - 3600);
$brugernavn = $_GET['name'];
$kodeord = $_GET['password'];
if($brugernavn && $kodeord) {
    if ($brugernavn == "A" && $kodeord=="a") {
        echo "Du er logget ind!";
        $cookie_name = "user";
        $cookie_value = "A";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    }
}
?><!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<form action="login.php" method="get">
    <label>Brugernavn</label>
    <input type="text" name="name" >
    <label>Kodeord</label>
    <input type="password"  name="password">
    <button>Log ind</button>
</form>

<?php

echo "<h1> OIE Order List </h1>";
/*
  Opretter forbindelse til databasen
*/
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "exdb";
$port = "3306";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
/*
  Sender forespørgsel til databasen, modtager data og viser data
*/
echo "<h2>Orders</h2>";
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<br />" . $row["ORD_NUM"] . ". " . $row["ORD_DATE"] . " . " . $row["ORD_DESCRIPTION"] . "." .$row["ORD_AMOUNT"];
    }
} else {
    echo "0 results";
}
/* Viser data i en tabel */
// Eksempel på en SQL forespørgsel
// SELECT name, rolle FROM users, userRoles, roles
// WHERE users.id = userRoles.userID
// AND roles.id = userRoles.roleID
?>
<table>
    <tr>
        <td style="border:1px solid;">
            ID
        </td>
        <td style="border:1px solid;">
            Date
        </td>
        <td style="border:1px solid;">
            Description
        </td>
        <td style="border:1px solid;">
            Amount
        </td>
    </tr>
    <?php
    $sql = "SELECT * FROM orders"; /***/
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border:1px solid;'>";
            echo $row["ORD_NUM"];
            echo "</td>";
            echo "<td style='border:1px solid;'>";
            echo $row["ORD_DATE"];
            echo "</td>";
            echo "<td style='border:1px solid;'>";
            echo $row["ORD_DESCRIPTION"];
            echo "</td>";
            echo "<td style='border:1px solid;'>";
            echo $row["ORD_AMOUNT"];
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    ?>

</table>



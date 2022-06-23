<?php


$servername = "localhost";
$username = "user";
$password = "pass";
$dbname = "amirali";

function db_exec($conn, $sqlString)
{
    $conn->exec($sqlString);
}

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);

   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //create database
    $sql = "CREATE DATABASE $dbname (
            CREATE USER '$username'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$dbname`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;";

    
    $conn->exec($sql);
    echo "Database created successfully";

    //craete table
    $sql = "CREATE TABLE Assets (
    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    AssetName varchar(255) NOT NULL,
    UnitPrice INT(6) NOT NULL,
    `Count` INT(6) NOT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    
    $conn->exec($sql);
    echo "Table created successfully";

    //insert 
    $sql = "INSERT INTO Assets(AssetName, UnitPrice, Count) VALUES(?, ?, ?)";
    $stmtInsert = $conn->prepare($sql);
    
    $stmtInsert->bindParam(1, "Peugeot2008");
    $stmtInsert->bindParam(2, "650000000");
    $stmtInsert->bindParam(3, "1");
    $stmtInsert->execute();
    echo "insert successfull";

    $stmtInsert->bindParam(1, "USD");
    $stmtInsert->bindParam(2, "20000");
    $stmtInsert->bindParam(3, "17500");
    $stmtInsert->execute();
    echo "insert successfull";


    $stmtInsert->bindParam(1, "Shopping");
    $stmtInsert->bindParam(2, "800000000");
    $stmtInsert->bindParam(3, "1");
    $stmtInsert->execute();
    echo "insert successfull";

    //update
    $sql = "UPDATE ASSETS SET UnitPrice=UnitPrice*? WHERE AssetName=?";
    $stmtUpdatePrice = $conn->prepare($sql);

    $stmtUpdatePrice->bindParam(1, 1.45);
    $stmtUpdatePrice->bindParam(2, "USD");
    $stmtUpdatePrice->execute();
    echo "Updated successfull";

    $stmtUpdatePrice->bindParam(1, 2);
    $stmtUpdatePrice->bindParam(2, "Peugeot2008");
    $stmtUpdatePrice->execute();
    echo "Updated successfull";

    $stmtUpdatePrice->bindParam(1, 0.25);
    $stmtUpdatePrice->bindParam(2, "Shopping");
    $stmtUpdatePrice->execute();
    echo "Updated successfull";

   //delete
    $sql = "DELETE FROM ASSETS WHERE AssetName=?";
    $stmtDelete = $conn->prepare($sql);

    $stmtDelete->bindParam(1, "Shopping");
    $stmtDelete->execute();
    echo "Deleted successfull";

   //update record
    $sql = "UPDATE ASSETS SET count=count+? WHERE AssetName=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, "Peugeot2008");
    $stmt->bindParam(2, "650000000");
    $stmt->bindParam(3, "1");
    $stmt->execute();
    echo "Updated successfull";

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

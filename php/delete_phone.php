<?php
$pid = $_GET['pid'];
const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$statement = $conn->prepare("delete from phone where pid = :pid");
$statement->execute(array(':pid' => $pid));
echo "删除成功";


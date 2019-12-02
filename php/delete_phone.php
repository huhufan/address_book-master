<?php
$pid = $_GET['pid'];
include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$statement = $conn->prepare("delete from phone where pid = :pid");
$statement->execute(array(':pid' => $pid));
$conn = null;
echo "删除成功";


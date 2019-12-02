<?php
$gid=$_GET['gid'];

include "MysqlUtils.php";
$conn = MysqlUtils::getConn();

$conn->beginTransaction();
$statement = $conn->prepare("delete from address_book.group where gid = :gid");
$statement->bindParam(':gid',$gid);
$statement->execute();

$statement = $conn->prepare("update user set group_id = :default where group_id = :gid");
$default = 1;
$statement->bindParam(':gid',$gid);
$statement->bindParam(':default',$default);
$statement->execute();

$conn->commit();
$conn = null;
?>
<div id="head"></div>
<div id="user_details" style="color: darkcyan">删除成功！</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>

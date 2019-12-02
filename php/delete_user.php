<?php
$uid=$_GET['uid'];

include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$statement = $conn->prepare("delete from user where uid = :uid");
$statement->bindParam(':uid',$uid);
$statement->execute();

$statement = $conn->prepare("delete from phone where uid = :uid");
$statement->bindParam(':uid',$uid);
$statement->execute();

$conn = null;
?>
<div id="head"></div>
<div id="user_details" style="color: darkcyan">删除成功！</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>

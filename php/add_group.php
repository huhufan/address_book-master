<?php
include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$gname=$_POST["gname"];

$statement = $conn->prepare("insert into address_book.group(gname) values (:gname)");
$statement->bindParam(':gname',$gname);
$statement->execute();
$conn = null;

?>
<div id="head"></div>
<div id="user_details" style="color: darkcyan">添加成功！</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>

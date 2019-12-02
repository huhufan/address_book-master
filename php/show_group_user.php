<?php
$gid = $_GET['gid'];
$gname = $_GET['gname'];


include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$conn->beginTransaction();
$statement = $conn->prepare("select uid , name from user where group_id = :gid order by convert (name using gbk) collate gbk_chinese_ci");
$statement->bindParam(":gid",$gid);
$statement->execute();
$groupUser = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<style>

    tr{
        background-color: #fef9f4;
    }
    a {
        color:#575356;
        font-size: 12px;
        text-decoration: none;
    }
</style>
<div id="head"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>
<table style="padding-top: 20px;width: 300px; text-align: left">
    <div style="width: 300px"><button style="float: left;"><?php echo $gname ?></button><button style="float: right;"><a href="/address_book-master/php/delete_group.php?gid=<?php echo $gid ?>">删除此群组</a></button></div>
    <?php
    foreach ($groupUser as $user) {
        ?>
        <tr>
        <td><a href="../php/user_details.php?uid=<?php echo $user['uid'] ?>"><?php
                echo $user['name']; ?></a></td><?php
        $statement2 = $conn->prepare("select phone_number from phone where uid = :uid");
        $statement2->execute(array(':uid' => $user['uid']));
        $allPhone = $statement2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <td><select style="float: right"><?php foreach ($allPhone as $p) { ?>
                    <option><?php echo $p['phone_number']; ?></option><?php
                }
                ?></select></td></tr><?php
    }
    $conn = null;
    ?>
</table>


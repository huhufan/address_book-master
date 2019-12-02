<div id="head"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>
<?php
include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$conn->beginTransaction();
$statement = $conn->prepare("select uid , name from user order by convert (name using gbk) collate gbk_chinese_ci");
$statement->execute();
$allUser = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<style>
    tr{
        background-color: #fef9f4;
    }

    a {
        color:#575356;
        font-size: 12px ;
        text-decoration: none;
    }
</style>
<table style="padding-top: 2px;width: 300px; text-align: left">
    <button><a href="/address_book-master/php/to_add_user.php">添加联系人</a></button>
    <?php
    foreach ($allUser as $user) {
        ?>
        <tr>
        <td><a href="/address_book-master/php/user_details.php?uid=<?php echo $user['uid'] ?>"><?php
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


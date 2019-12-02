<div id="head"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>

<?php
include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$statement = $conn->prepare("select * from `group`");
$statement->execute();
$groups = $statement->fetchAll(PDO::FETCH_ASSOC);
$conn = null;


?>
<style>
    a{
        color:#575356;
        font-size: 12px;
        text-decoration: none;
        }
</style>
<button><a href="/address_book-master/php/to_add_group.php">添加群组</a></button>
<div style="width: 300px;">
    <?php
    foreach ($groups as $g){
        ?><a href="/address_book-master/php/show_group_user.php?gid=<?php echo $g['gid'] ?>&gname=<?php echo $g['gname'] ?>"> <div style="width: 100%;background-color: #fef9f4; margin-top: 2px" ><?php echo $g['gname'] ?></div></a><?php
    }
    ?>
</div>


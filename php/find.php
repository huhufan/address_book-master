
<?php
session_start();
if (isset($_GET['key'])){  //如果按上下链接，则改变排序规则，将标示存入session中；
    $_SESSION['key'] = $_GET['key'];
}
$key = $_SESSION['key'];
$cur_page = isset($_GET['page'])?$_GET['page']:1;
$all_page = 1;
$num = 10;
$start = ($cur_page-1)*$num;

include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$statement = $conn->prepare("select count(*) as nums from phone ");
$statement->execute();
$allUser_numbers = $statement->fetchAll(PDO::FETCH_ASSOC);
$nums = $allUser_numbers[0]['nums'];
$all_page = $nums%$num==0?$nums/$num:intval($nums/$num+1);

if ($key==1){
    $statement = $conn->prepare("select u.uid, u.name, p.phone_number from address_book.user as u right join phone as p on u.uid = p.uid order by convert (name using gbk) collate gbk_chinese_ci limit :start,:num  ");
    $statement->execute(array(':start'=>$start,':num'=>$num));
    $allUser_numbers = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($key==2){
    $statement = $conn->prepare("select u.uid, u.name, p.phone_number from address_book.user as u right join phone as p on u.uid = p.uid order by convert (name using gbk) collate gbk_chinese_ci desc LIMIT :start , :num");
    $statement->execute(array(':start'=>$start,':num'=>$num));
    $allUser_numbers = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($key==3){
    $statement = $conn->prepare("select u.uid, u.name, p.phone_number from address_book.user as u right join phone as p on u.uid = p.uid order by phone_number limit :start,:num ");
    $statement->execute(array(':start'=>$start,':num'=>$num));
    $allUser_numbers = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($key==4){
    $statement = $conn->prepare("select u.uid, u.name, p.phone_number from address_book.user as u right join phone as p on u.uid = p.uid order by phone_number desc limit :start,:num");
    $statement->execute(array(':start'=>$start,':num'=>$num));
    $allUser_numbers = $statement->fetchAll(PDO::FETCH_ASSOC);
}



?>
<style>
    tr{
        background-color: #fef9f4;
    }

    a {
        color:#575356;
        font-size: 12px ;
        text-decoration: none;
        overflow: hidden;
    }
     li{
         list-style: none;
         width:300px ;
         color:#575356;
         font-size: 12px ;
         text-decoration: none;
         background-color: #fef9f4;
         margin-top: 2px;
         padding-left: -30px;
     }
    .view_name{
        float: left;
    }
    .view_number{
        float: right;
    }

</style>
<div><div id="head"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $("#head").load("/address_book-master/html/head.html");
    </script>
    <input style="margin-left: 100px" name="find" width="100%" type="text"  placeholder="请输入查询关键字" onkeyup="findResult(this.value)">

<div style="padding-top: 2px;width: 300px; text-align: left;margin-left: -40px;margin-top: -20px" >
    <ul>
        <div style="overflow: hidden;width: 300px"><a style="float: left" href="/address_book-master/php/find.php?key=1">⬆</a><a href="/address_book-master/php/find.php?key=2" style="float: left">⬇</a><a href="/address_book-master/php/find.php?key=3" style="float: right">️⬆</a><a  href="/address_book-master/php/find.php?key=4" style="float: right">️⬇</a></div>
        <?php foreach ($allUser_numbers as $user_number) { ?>
        <li username="<?php echo $user_number['name'] ?>" phone="<?php  echo $user_number['phone_number'] ?>"><a href="/address_book-master/php/user_details.php?uid=<?php echo $user_number['uid'] ?>"><div style="overflow: hidden"><span class="view_name"><?php  echo $user_number['name'] ?></span><span class="view_number"><?php echo $user_number['phone_number'] ?></span></div> </a></li>
        <?php } ?>
        <div style="padding-left: 35%"><a href="/address_book-master/php/find.php?page=<?php echo $cur_page==1?$cur_page:$cur_page-1 ?>">️⬅️</a><span style="font-size: 12px">第<?php echo $cur_page ?>页</span><span style="font-size: 12px">😊共<?php echo $all_page ?>页</span><a href="/address_book-master/php/find.php?page=<?php echo $cur_page<$all_page?$cur_page+1:$all_page ?>">➡️</a></div>
    </ul>
</div>
</div>
<script>

    function findResult(value) {
        var searchName = value;
        if (searchName == "") {
            $("ul li").show();
        } else {
            $("ul li").each(
                function() {
                    var username = $(this).attr("username");
                    var phone = $(this).attr("phone");
                    if (username.indexOf(searchName) != -1
                        || phone.indexOf(searchName) != -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
        }
    }
</script>


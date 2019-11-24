<div id="head"></div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("../html/head.html");
</script>
<?php
const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$conn->beginTransaction();
$statement = $conn->prepare("select * from user where uid = :uid");
$statement->execute(array(':uid' => $_GET['uid']));
$user = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $conn->prepare("select * from `group`");
$statement2->execute();
$allGroup = $statement2->fetchAll(PDO::FETCH_ASSOC);

?>
<div style="width: 300px">
    <form action="/address_book-master/php/update_user.php" method="post">
        <input type="hidden" name="sum" value="0" id="sum">
        <input type="hidden" name="uid" value="<?php echo $user[0]['uid'] ?>">
        <span>名字: </span><input type="text" name="name" value="<?php echo $user[0]['name'] ?>"> <br>
        <span>公司: </span><input type="text" name="company" value="<?php echo $user[0]['company'] ?>"> <br>
        <span>邮箱: </span><input type="text" name="email" value="<?php echo $user[0]['email'] ?>"> <br>
        <span>群组: </span><select name="group_id">
            <?php
            foreach ($allGroup as $a) {
                if ($a['gid'] == $user[0]['group_id']){
                    ?>
                    <option selected value="<?php echo $a["gid"] ?>"><?php echo $a["gname"] ?></option>
                <?php }
                else{
                    ?>
                    <option value="<?php echo $a["gid"] ?>"><?php echo $a["gname"] ?></option>
                <?php }
            }
            ?>
        </select><br>
        <span>备注: </span><input type="text" name="comments" value="<?php echo $user[0]['comments'] ?>"> <br>
        <span>电话: </span> <input type="button" value="+" onclick="add_input(this)">
        <?php
        $statement3 = $conn->prepare("select * from phone where uid = :uid");
        $statement3->execute(array(':uid' => $user[0]['uid']));
        $allPhone = $statement3->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhone as $phone) {
            ?>
            <div style="margin-left: 40px" id="<?php echo $phone['pid'] ?>"><input readonly type="text" pid="<?php echo $phone['pid'] ?>"
                                                         value="<?php echo $phone['phone_number'] ?>">
                <input type="button" pid="<?php echo $phone['pid'] ?>" value="-" onclick="del_input(this)"></div>
            <?php
        } ?>
        <input id="hid" type="hidden" value="0" style="margin-left: 36px"><br>
        <input style="margin-left: 50px" type="submit" value="提交" id="submit">
    </form>
</div>
<script>
    var name = "phone";
    var num = 0;

    function del_input(e) {
        id = e.getAttribute('pid');
        alert(id);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET","/address_book-master/php/delete_phone.php?pid="+id,true);
        xmlhttp.send();
        $('#' + id).remove();

    }

    function add_input() {
        num++;
        $("input[id=sum]").val(num);
        var curName = name + num;
        $("#hid").after('<input name="' + curName + '" style="margin-left: 40px" type="text"><br>');
    }

    // $('#submit').click(function () {
    //     var data = $('form').serializeArray();
    //     $.ajax({
    //         url:'/address_book-master/php/update_user.php',
    //         type:'post',
    //         dataType:'json',
    //         data:"{}",
    //         success:function (result) {
    //             alert("ddd");
    //         }
    //     });
    //     alert("sdad");
    //
    // })
</script>
<?php

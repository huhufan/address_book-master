<?php
const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$statement = $conn->prepare("select * from `group`");
$statement->execute();
$all = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>add_user</title>
    <style>
        .sp {
            width: 300px;
        }

    </style>
</head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<body>
<div>
    <form action="/address_book-master/php/add_user.php" method="post">
        <input type="hidden" name="number" value="1" id="number">
        <span>名字:</span><input type="text" name="name"> <br>
        <span>公司:</span><input type="text" name="company"> <br>
        <span>邮箱:</span><input type="text" name="email"> <br>
        <span>群组:</span><select name="group_id">
            <?php
            foreach ($all as $a) {
                ?>
                <option value="<?php echo $a["gid"] ?>"><?php echo $a["gname"] ?></option>
                <?php
            }
            ?>
        </select><br>
        <span>备注:</span><input type="text" name="comments"> <br>
        <span>电话:</span><input type="text" name="phone1"><input type="button" id="p" value="+"
                                                                onclick="add_input()"><br>
        <input id="hid" type="hidden" style="margin-left: 36px"><br>
        <input style="margin-left: 50px" type="submit" value="提交" id="submit">
    </form>
</div>
</body>
<script>
    var name = "phone";
    var num = 1;
    function add_input() {
        num++;
        $("input[type=hidden]").val(num);
        var curName = name + num;
        $("#hid").after('<input name="' + curName + '" style="margin-left: 36px" type="text"><br>');
    }
</script>
</html>
<?php
?>


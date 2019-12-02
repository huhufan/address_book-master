<div id="head"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>

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
<body>
<div>
    <form action="/address_book-master/php/add_group.php" method="post">
        <span>群组:</span><input type="text" name="gname" required placeholder="必填项">
        <input type="submit" value="添加" id="submit">
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


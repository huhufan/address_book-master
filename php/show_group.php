<?php
const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$conn->beginTransaction();
$statement = $conn->prepare("select * from `group`");
$statement->execute();
$groups = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<div style="width: 300px">
    <?php
    foreach ($groups as $g){
        ?><a href="/address_book-master/php/show_group_user.php?gid=<?php echo $g['gid'] ?>"> <div style="width: 100%;background-color: #cefee7; margin-top: 1px" ><?php echo $g['gname'] ?></div></a><?php
    }
    ?>
</div>


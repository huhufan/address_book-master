<?php
const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$conn->beginTransaction();
$statement = $conn->prepare("select uid , name from user");
$statement->execute();
$allUser = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<style>
    td {
        border-top: 1px solid darkcyan;
    }

    a {
        color: black;
        font-size: 15px;
        text-decoration: none;
    }
</style>
<table style="padding-top: 20px;border: 1px solid darkcyan;width: 300px; text-align: left">
    <button><a href="/address_book-master/html/add_user.html">+</a></button>
    <?php
    foreach ($allUser as $user) {
        ?>
        <tr>
        <td><a href="../php/user_details.php?uid=<?php echo $user['uid'] ?>"><?php
                echo $user['name']; ?></a></td><?php
        $statement2 = $conn->prepare("select phone_number from phone where uid = :uid");
        $statement2->execute(array(':uid' => $user['uid']));
        $allPhone = $statement2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <td><select><?php foreach ($allPhone as $p) { ?>
                    <option><?php echo $p['phone_number']; ?></option><?php
                }
                ?></select></td></tr><?php
    }
    ?>
</table>


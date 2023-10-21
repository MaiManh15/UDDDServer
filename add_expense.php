<?php

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$UserIdDb= $db->retrieve("UserID");
$UserIdDb = json_decode($UserIdDb, 1);


?>
<h2><?php echo "Thêm chi tiêu"; ?></h2>
<br><br>
<form method="post" action="action_expense_add.php">
    <table border="0" width="500">
        <tr>
            <td>user id</td>
            <td>:</td>
            <td>
                <select id="expense_user_id" name="user_id">
                    <option value="">------Chon User id------</option>
                    <?php foreach ($UserIdDb as $UserIdKey => $UserId) { ?>
                        <option value="<?php echo $UserIdKey; ?>"><?php echo $UserIdKey; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>id</td>
            <td>:</td>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <td>ngày</td>
            <td>:</td>
            <td><input type="text" name="date"></td>
        </tr>
        <tr>
            <td>mô tả</td>
            <td>:</td>
            <td><input type="text" name="type"></td>
        </tr>
        <tr>
            <td>sô tiền</td>
            <td>:</td>
            <td><input type="text" name="amount"></td>
        </tr>
        <tr>
            <td>chú thích</td>
            <td>:</td>
            <td><input type="text" name="note"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Thêm"></td>
        </tr>
        
    </table>
</form>
<form action="index.php" method="get">
    <input type="submit" value="Hủy">
</form>
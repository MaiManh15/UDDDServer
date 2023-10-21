<?php
    include("config.php");
    include("firebaseRDB.php");

    $db = new firebaseRDB($databaseURL);
    
    $user_id = $_GET['user_id'];
    $incomeKey = $_GET['income_id'];
    $user_id = trim($user_id);
    $incomeKey = trim($incomeKey);
    
    $incomePath = "IncomeData/$user_id/$incomeKey";

    $incomeData = $db->retrieve($incomePath);
    $incomeData= json_decode($incomeData, 1);
    
?>
<h2><?php echo "Cập nhật thu nhập"; ?></h2>
<form method="post" action="action_income_edit.php">
    <table border="0" width="500">
        <tr>
            <td>id</td>
            <td>:</td>
            <td><input type="text" name="id" value="<?php echo $incomeData['id']; ?>"></td>
        </tr>
        <tr>
            <td>ngày</td>
            <td>:</td>
            <td><input type="text" name="date" value="<?php echo $incomeData['date']; ?>"></td>
        </tr>
        <tr>
            <td>mô tả</td>
            <td>:</td>
            <td><input type="text" name="type" value="<?php echo $incomeData['type']; ?>"></td>
        </tr>
        <tr>
            <td>sô tiền</td>
            <td>:</td>
            <td><input type="text" name="amount" value="<?php echo $incomeData['amount']; ?>"></td>
        </tr>
        <tr>
            <td>chú thích</td>
            <td>:</td>
            <td><input type="text" name="note" value="<?php echo $incomeData['note']; ?>"></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name = "user_id" value ="<?php echo $user_id;?>" >
                <input type="hidden" name = "income_id" value ="<?php echo $incomeKey;?>" >
                <input type="hidden" name="old_id" value="<?php echo $incomeData['id']; ?>">
                <input type="submit" value="Cập nhật">
            </td>
        </tr>
    </table>
</form>
<form action="index.php" method="get">
    <input type="submit" value="Hủy">
</form>
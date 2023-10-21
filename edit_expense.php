<?php
    include("config.php");
    include("firebaseRDB.php");

    $db = new firebaseRDB($databaseURL);
    
    $user_id = $_GET['user_id'];
    $ExpenseKey = $_GET['expense_id'];
    $user_id = trim($user_id);
    $ExpenseKey = trim($ExpenseKey);
    
    $ExpensePath = "ExpenseData/$user_id/$ExpenseKey";

    $ExpenseData = $db->retrieve($ExpensePath);
    $ExpenseData= json_decode($ExpenseData, 1);
    
?>
<h2><?php echo "Cập nhật chi tiêu"; ?></h2>
<form method="post" action="action_expense_edit.php">
    <table border="0" width="500">
        <tr>
            <td>id</td>
            <td>:</td>
            <td><input type="text" name="id" value="<?php echo $ExpenseData['id']; ?>"></td>
        </tr>
        <tr>
            <td>ngày</td>
            <td>:</td>
            <td><input type="text" name="date" value="<?php echo $ExpenseData['date']; ?>"></td>
        </tr>
        <tr>
            <td>mô tả</td>
            <td>:</td>
            <td><input type="text" name="type" value="<?php echo $ExpenseData['type']; ?>"></td>
        </tr>
        <tr>
            <td>sô tiền</td>
            <td>:</td>
            <td><input type="text" name="amount" value="<?php echo $ExpenseData['amount']; ?>"></td>
        </tr>
        <tr>
            <td>chú thích</td>
            <td>:</td>
            <td><input type="text" name="note" value="<?php echo $ExpenseData['note']; ?>"></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name = "user_id" value ="<?php echo $user_id;?>" >
                <input type="hidden" name = "Expense_id" value ="<?php echo $ExpenseKey;?>" >
                <input type="hidden" name="old_id" value="<?php echo $ExpenseData['id']; ?>">
                <input type="submit" value="Cập nhật">
            </td>
        </tr>
    </table>
</form>
<form action="index.php" method="get">
    <input type="submit" value="Hủy">
</form>
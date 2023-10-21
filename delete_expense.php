<?php
    include("config.php");
    include("firebaseRDB.php");

    $db = new firebaseRDB($databaseURL);
    
    $user_id = $_GET['user_id'];
    $ExpenseKey = $_GET['expense_id'];
    $user_id = trim($user_id);
    $ExpenseKey = trim($ExpenseKey);
    
    $ExpensePath = "ExpenseData/$user_id";
    $budgetPath = "BudgetData/$user_id";

    if($ExpenseKey!=""){
        $delete = $db-> delete($ExpensePath, $ExpenseKey);
        $delete = $db-> delete($budgetPath, $ExpenseKey);
        echo "Đã xóa dữ liệu";
    }
    
?>
<br><br>
<form action="index.php" method="get">
    <input type="submit" value="Trở về trang chính">
</form>
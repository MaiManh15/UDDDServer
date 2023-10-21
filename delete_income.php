<?php
    include("config.php");
    include("firebaseRDB.php");

    $db = new firebaseRDB($databaseURL);
    
    $user_id = $_GET['user_id'];
    $incomeKey = $_GET['income_id'];
    $user_id = trim($user_id);
    $incomeKey = trim($incomeKey);
    
    $incomePath = "IncomeData/$user_id";
    $budgetPath = "BudgetData/$user_id";

    if($incomeKey!=""){
        $delete = $db-> delete($incomePath, $incomeKey);
        $delete = $db-> delete($budgetPath, $incomeKey);
        echo "Đã xóa dữ liệu";
    }
    
?>
<br><br>
<form action="index.php" method="get">
    <input type="submit" value="Trở về trang chính">
</form>
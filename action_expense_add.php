<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['user_id']; 
    $id = $_POST['id'];
    $amount = (float)$_POST['amount'];
    $expenseDb = $db->retrieve("ExpenseData");
    $expenseDb = json_decode($expenseDb, 1);
    $incomeDb = $db->retrieve("IncomeData");
    $incomeDb = json_decode($incomeDb, 1);
    $id = trim($id);
    $validID = true;
    

    foreach($expenseDb as $UserExpenseKey=>  $UserExpense){
        if(is_array($UserExpense)){
            foreach($UserExpense as $expenseKey=> $ExpenseData){
                if($id === trim($expenseKey)){
                    $validID= false;
                }
            }   
        }
    }

    foreach($incomeDb as $UserIncomeKey=>  $UserIncome){
        if(is_array($UserIncome)){
            foreach($UserIncome as $incomeKey=> $IncomeData){
                if($id === trim($incomeKey)){
                    $validID= false;
                }
            }
        }
    }

    if($validID){
        $ExpensePath = "ExpenseData/$uid";
        $budgetPath = "BudgetData/$uid";

        $newEntryData = [
            "id" => $_POST['id'],
            "date" => $_POST['date'],
            "note" => $_POST['note'],
            "amount" => $amount,
            "type" => $_POST['type']
        ];

        $insertedExpense = $db->update($ExpensePath, $id, $newEntryData);

        $budgetData = [
            "id" => $_POST['id'],
            "amount" => -$amount,
        ];

        $insertedBudget = $db->update($budgetPath,$id, $budgetData);

        if ($insertedExpense && $insertedBudget) {
            echo "Đã thêm chi tiêu";
        } else {
            echo "Lỗi";
        }
    }else{
        echo "Trùng id";
    }
}
?>
<br><br>
<form action="index.php" method="get">
    <input type="submit" value="Trở về trang chính">
</form>
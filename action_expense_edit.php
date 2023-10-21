<?php
    include("config.php");
    include("firebaseRDB.php");
    $db = new firebaseRDB($databaseURL);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : "";
        $ExpenseKey = isset($_POST['Expense_id']) ? trim($_POST['Expense_id']) : "";
        $amount = (float)$_POST['amount'];
        $oldID= isset($_POST['old_id']) ? trim($_POST['old_id']) : "";

        $expenseDb = $db->retrieve("ExpenseData");
        $expenseDb = json_decode($expenseDb, 1);
        $incomeDb = $db->retrieve("IncomeData");
        $incomeDb = json_decode($incomeDb, 1);
        $id = $_POST['id'];
        $id = trim($id);
        $validID = true;
        

        foreach($expenseDb as $UserExpenseKey=>  $UserExpense){
            if(is_array($UserExpense)){
                foreach($UserExpense as $expenseKey=> $ExpenseData){
                    if($id === trim($ExpenseData['id']) && $id != $oldID){
                        $validID= false;
                    }
                }   
            }
        }

        foreach($incomeDb as $UserIncomeKey=>  $UserIncome){
            if(is_array($UserIncome)){
                foreach($UserIncome as $incomeKey=> $IncomeData){
                    if($id === trim($IncomeData['id'])){
                        $validID= false;
                    }
                }
            }
        }

        if($validID){
            if (empty($ExpenseKey)) {
                echo "Yêu cầu id ";
            } else {
            
                $ExpensePath = "ExpenseData/$user_id";
                $budgetPath = "BudgetData/$user_id"; 
        
                $newEntryData = [
                    "id" => $id,
                    "date" => $_POST['date'],
                    "note" => $_POST['note'],
                    "amount" => $amount,
                    "type" => $_POST['type']
                ];
        
                $ExpenseUpdate = $db->update($ExpensePath, $ExpenseKey, $newEntryData);
                $budgetUpdate = $db->update($budgetPath, $ExpenseKey, ["id" => $_POST['id'],"amount" => -$amount,]);
        
                if ($ExpenseUpdate && $budgetUpdate) {
                    echo "Cập nhật dữ liệu thành công";
                } else {
                    echo "Cập nhật dữ liệu thất bại";
                }
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
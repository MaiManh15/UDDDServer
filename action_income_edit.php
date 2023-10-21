<?php
    include("config.php");
    include("firebaseRDB.php");
    $db = new firebaseRDB($databaseURL);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : "";
        $incomeKey = isset($_POST['income_id']) ? trim($_POST['income_id']) : "";
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
                    if($id === trim($ExpenseData['id'])){
                        $validID= false;
                    }
                }   
            }
        }

        foreach($incomeDb as $UserIncomeKey=>  $UserIncome){
            if(is_array($UserIncome)){
                foreach($UserIncome as $incomeKey=> $IncomeData){
                    if($id === trim($IncomeData['id'])&& $id != $oldID){
                        $validID= false;
                    }
                }
            }
        }
        
        if($validID){
            if (empty($incomeKey)) {
                echo "Yêu cầu id ";
            } else {
            
                $incomePath = "IncomeData/$user_id";
                $budgetPath = "BudgetData/$user_id"; 
        
                $newEntryData = [
                    "id" => $_POST['id'],
                    "date" => $_POST['date'],
                    "note" => $_POST['note'],
                    "amount" => (float)$_POST['amount'],
                    "type" => $_POST['type']
                ];
        
                $incomeUpdate = $db->update($incomePath, $incomeKey, $newEntryData);
                $budgetUpdate = $db->update($budgetPath, $incomeKey, ["id" => $_POST['id'], "amount" => (float)$_POST['amount']]);
        
                if ($incomeUpdate && $budgetUpdate) {
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
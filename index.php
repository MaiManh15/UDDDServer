<?php

    include("config.php");
    include("firebaseRDB.php");

    $db= new firebaseRDB($databaseURL);

?>

<title>BTL Server</title>
<link rel="stylesheet" href="style.css">
<h1><?php echo "Quản lí chi tiêu"; ?></h1>

<h2><?php echo "Thu nhập"; ?></h2>
<table border= "1" width = "1200">

    <tr align="center" bgcolor="#dddddd";>
        <td>user id</td>
        <td>id</td>
        <td>ngày</td>
        <td>mô tả</td>
        <td>sô tiền</td>
        <td>chú thích</td>
        <td colspan="2">Hành động</td>
    </tr>

    <?php
        $incomeDb = $db->retrieve("IncomeData");
        $incomeDb = json_decode($incomeDb, 1);

        foreach($incomeDb as $UserIncomeKey=>  $UserIncome){
            if(is_array($UserIncome)){
                foreach($UserIncome as $incomeKey=> $IncomeData){
                    echo"
                    <tr>
                        <td>{$UserIncomeKey}</td>
                        <td>{$IncomeData['id']}</td>
                        <td>{$IncomeData['date']}</td>
                        <td>{$IncomeData['type']}</td>
                        <td>{$IncomeData['amount']}</td>
                        <td>{$IncomeData['note']}</td>
                        <td><a href='edit_income.php?user_id= $UserIncomeKey&income_id=$incomeKey'>Sửa</a></td>
                        <td><a href='delete_income.php?user_id= $UserIncomeKey&income_id=$incomeKey'>Xóa</a></td>
                    </tr>
                    ";
                }
            }
        }

    ?>

</table>
<br><br><a href="add_income.php"><button>Thêm thu nhập</button></a><br><br>

<h2><?php echo "Chi tiêu"; ?></h2>
<table border= "1" width = "1200">

    <tr align="center" bgcolor="#dddddd";>
        <td>user id</td>
        <td>id</td>
        <td>ngày</td>
        <td>mô tả</td>
        <td>sô tiền</td>
        <td>chú thích</td>
        <td colspan="2">Hành động</td>
    </tr>

    <?php

        $expenseDb = $db->retrieve("ExpenseData");
        $expenseDb = json_decode($expenseDb, 1);

        foreach($expenseDb as $UserExpenseKey=>  $UserExpense){
            if(is_array($UserExpense)){
                foreach($UserExpense as $expenseKey=> $ExpenseData){
                    echo"
                    <tr>
                        <td>{$UserExpenseKey}</td>
                        <td>{$ExpenseData['id']}</td>
                        <td>{$ExpenseData['date']}</td>
                        <td>{$ExpenseData['type']}</td>
                        <td>{$ExpenseData['amount']}</td>
                        <td>{$ExpenseData['note']}</td>
                        <td><a href='edit_expense.php?user_id= $UserExpenseKey&expense_id=$expenseKey'>Sửa</a></td>
                        <td><a href='delete_expense.php?user_id= $UserExpenseKey&expense_id=$expenseKey'>Xóa</a></td>
                    </tr>
                    ";
                }
            }
        }

    ?>

</table>
<br><br><a href="add_expense.php"><button>Thêm chi tiêu</button></a><br><br>

<h2><?php echo "Ngân sách"; ?></h2>
<table border= "1" width = "1200">

    <tr align="center" bgcolor="#dddddd";>
        <td>user id</td>
        <td>id</td>
        <td>sô tiền</td>
    </tr>

    <?php

        $budgetDb = $db->retrieve("BudgetData");
        $budgetDb = json_decode($budgetDb, 1);

        foreach($budgetDb as $UserBudgetKey=>  $UserBudget){
            if(is_array($UserBudget)){
                foreach($UserBudget as $budgetKey=> $BudgetData){
                    echo"
                    <tr>
                        <td>{$UserBudgetKey}</td>
                        <td>{$BudgetData['id']}</td>
                        <td>{$BudgetData['amount']}</td>
                    </tr>
                    ";
                }
            }
        }

    ?>

</table>

<!-- <br><br>
<h2><?php echo "User"; ?></h2>

<table border= "1" width = "1200">

    <tr align="center" bgcolor="#dddddd";>
        <td>user id</td>
        <td>gmail</td>
    </tr>

    <?php

        $UserIdDb= $db->retrieve("UserID");
        $UserIdDb = json_decode($UserIdDb, 1);
        
        foreach ($UserIdDb as $UserIdKey => $UserId){
            echo "
                <tr>
                <td>{$UserIdKey}</td>
                <td>{$UserId}</td>
                </tr>
            ";
        }

    ?>

</table> -->
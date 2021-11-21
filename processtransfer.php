<?php 
    include_once('./connection.php');
    $sender = $_POST['sender'];
    $sender_name = $_POST['sender_name'];
    $amount = $_POST['amount'];
    $receiver_ID = $_POST['receiver'];
    $receiver;
    $sender_balance = $_POST['sender_balance'];
    $receiver_balance;
    $sender_detail = $sender."(".$sender_name.")";
    
    try {
        $fetch_receiver_account = $connection->query("SELECT `AccountNumber`,`AccountHolderName`,`AccountBalance` FROM `customers` WHERE `CustomerID` = '".$receiver_ID."';");
        foreach($fetch_receiver_account as $x){
            $receiver = $x["AccountNumber"];
            $receiver_balance = $x["AccountBalance"];
            $receiver_name = $x["AccountHolderName"];
            $receiver_detail = $receiver."(".$receiver_name.")";
        }
        
        $insert_transfer = "INSERT INTO `transfers` (
            `Sender`, `Receiver`, `TransactionAmount`
        ) VALUES (
            '$sender_detail','$receiver_detail','$amount'
        );";
        $transfer_q = $connection->prepare($insert_transfer);
        $new_sender_balance = $sender_balance - $amount;
        $new_receiver_balance = $receiver_balance + $amount;
        $sender_balance_update = "UPDATE `customers` SET `AccountBalance` = '".$new_sender_balance."' WHERE `AccountNumber` = '".$sender."';";
        $receiver_balance_update = "UPDATE `customers` SET `AccountBalance` = '".$new_receiver_balance."' WHERE `AccountNumber` = '".$receiver."';";
        $sender_q = $connection->prepare($sender_balance_update);
        $receiver_q = $connection->prepare($receiver_balance_update);
        $transfer_q->execute();
        $sender_q->execute();
        $receiver_q->execute();
        header("Location: transfers.php");
    } catch (Exception $e){ echo "Error due to: ".$e->getMessage();}
    
    
?>
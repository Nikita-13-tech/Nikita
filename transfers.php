<?php 
    include_once ('./connection.php');
    include_once('./components.php');
    $page_title = "Transactions";
    $title_separator = "::";
    $bank_name="India Bank";
    $title = $page_title." ".$title_separator." ".$bank_name;
    $customer_name = "Weeping Below";
    $base_url = "./assets/profile-pictures/";
    $account_balance;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
    <title><?php echo $title; ?></title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <div class="application-container">
        <div class="header">
            <div class="brand">
                <div class="brand-logo">
                    <img src="./assets/logo.png" alt="<?php echo $bank_name; ?>" class="logo"/>
                </div>
                <div class="brand-name"><?php echo $bank_name; ?></div>
            </div>
            <div class="header-navbar">
            <a href="index.php"><div class="header-navbar-item">Home</div></a>
                <a href="customers.php"><div class="header-navbar-item">Customers</div></a>
                <a href="transfers.php"><div class="header-navbar-item">Transfers</div></a>
            </div>
        </div>

        <div class="contents">
            <div class="transfer-area">
                <h2 style="text-align:center; color: black;">All Transactions</h2>
                <div class="transfer-heads">
                    <div class="transfer-row">
                        <div class="tcol" id="colhead" style="max-width: 12%; min-width:12%;">TRN</div>
                        <div class="tcol" id="colhead" style="max-width: 17%; min-width:17%;">Date & Time</div>
                        <div class="tcol" id="colhead" style="max-width: 30%; min-width:30%;">Sender</div>
                        <div class="tcol" id="colhead" style="max-width: 30%; min-width:30%;">Receiver</div>
                        <div class="tcol" id="colhead" style="max-width: 11%; min-width:11%;">Amount</div>
                    </div>
                </div>
                    
                <div class="transfers">
                <?php 
                    $get_transactions = "SELECT * FROM `transfers`;";
                    $transfers = $connection->query($get_transactions);
                    $get_customer_names = "SELECT `AccountHolderName`,`AccountNumber` FROM `customers`;";
                    $names = $connection->query($get_customer_names);
                    foreach($transfers as $transfer){
                ?>
                    <div class="transfer-row">
                        <div class="tcol" id="transaction-id"><?php echo $transfer['TransactionNumber'];?></div>
                        <div class="tcol" id="transaction-date"><?php echo $transfer['TransactionDate'];?></div>
                        <div class="tcol" id="money-sender"><?php echo $transfer['Sender'];?></div>
                        <div class="tcol" id="money-receiver"><?php echo $transfer['Receiver'];?></div>
                        <div class="tcol" id="transaction-amount"><i class='fas fa-rupee-sign' style='font-size:14px'></i><?php echo $transfer['TransactionAmount'];?></div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="copyright-box">
                <div class="copyright-line">
                    Copyright &copy; November 2021 @Nikita Sontakke. All Rights Reserved.
                </div>
            </div>
            <div class="footer-navbar">
                <a href="#"><div class="footer-navbar-item">About</div></a>
                <a href="#"><div class="footer-navbar-item">Contact</div></a>
                <a href="#"><div class="footer-navbar-item">Terms & Conditions</div></a>
                <a href="#"><div class="footer-navbar-item">Help & Support</div></a>
                <a href="#"><div class="footer-navbar-item">Feedback</div></a>
                <a href="#"><div class="footer-navbar-item">Privacy Policy</div></a>
            </div>
        </div>
    </div>
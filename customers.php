<?php 
    include_once('./connection.php');
    include_once('./components.php');
    $page_title = "Home";
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
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
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
            
            <div class="display-area">
                <?php 
                    $get_customers = "SELECT * FROM `customers`;";
                    $customers = $connection->query($get_customers);
                    foreach($customers as $customer){
                            $customer_id = $customer["CustomerID"];
                            $account_number = $customer["AccountNumber"];
                            $customer_name = $customer["AccountHolderName"];
                            $Account_type = $customer["AccountType"];
                            $phone_number = $customer["CustomerPhoneNumber"];
                            $email = $customer["CustomerEmail"];
                            $gender = $customer["CustomerGender"];
                            $date_of_birth = $customer["CustomerDateOfBirth"];
                            $permanent_address = $customer["CustomerAddressPermanent"];
                            $correspondence_address = $customer["CustomerAddressCorrespondence"];
                            $city = $customer["CustomerCity"];
                            $state = $customer["CustomerState"];
                            $country = $customer["CustomerCountry"];
                            $pincode = $customer["CustomerPincode"];
                            $account_balance = $customer["AccountBalance"];
                            $account_opening_date = $customer["AccountOpeningDate"];
                            $account_closing_date = $customer["AccountClosingDate"];
                            $account_active_status = $customer["AccountActiveStatus"];
                            $customer_picture = $customer["CustomerProfilePicture"];
                            if($account_active_status == 1){
                                $account_status = "Account is Active";
                            } else {
                                $account_status = $account_closing_date;
                            }
                            $opening_balance = 10000;
                ?>
                        <div class="customer-box w3-card">
                            <div class="name-panel"><?php echo $customer_name; ?></div>
                            <div class="details-panel">
                                <div class="photo-box">
                                    <?php 
                                        //$customer_picture = "p1.jpeg";
                                        $customer_photo = $base_url.$customer_picture;
                                    ?>
                                    <img src="<?php echo $customer_photo; ?>">
                                </div>
                                <div class="detail-box">
                                    <div class="detail">
                                        <div class="detail-label">Account Number</div>
                                        <div class="detail-value"><?php echo $account_number; ?></div>
                                    </div>
                                    <div class="detail">
                                        <div class="detail-label">Account Balance</div>
                                        <div class="detail-value"><?php echo $account_balance?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="view-buttons-panel">
                                <button class="button" onclick="document.getElementById('<?php echo $account_number; ?>').style.display='block'" class="">
                                    View Customer
                                </button>
                                <div id="<?php echo $account_number; ?>" class="w3-modal w3-animate-opacity" style="display:none">
                                        <div class="w3-modal-content w3-card-4">
                                            <header class="w3-container"> 
                                                <span onclick="document.getElementById('<?php echo $account_number; ?>').style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
                                                <h2><?php echo $customer_name ?></h2>
                                            </header>
                                                <div class="w3-container modal-content">
                                                    <div class="detail-row">
                                                        <div class="left-box" id="space-evenly">
                                                            <?php 
                                                                customerDetail("Customer ID",$customer_id);
                                                                customerDetail("Gender",$gender);
                                                                customerDetail("Date of Birth",$date_of_birth);
                                                                customerDetail("Email",$email);
                                                                customerDetail("Phone Number",$phone_number);
                                                            ?>
                                                        </div>
                                                        <div class="right-box" id="photo-box">
                                                            <img src="<?php echo $customer_photo?>" alt="<?php echo $customer_name."'s photo";?>" />
                                                        </div>
                                                    </div>
                                                    <div class="detail-row" id="space-evenly">
                                                        
                                                            <?php 
                                                                customerDetail("Account Number",$account_number);
                                                                customerDetail("Account Opening Date",$account_number);
                                                                customerDetail("Account Closing Date",$account_status);
                                                                customerDetail("Account Balance",$account_balance);
                                                                customerDetail("Account Type",$Account_type);
                                                            ?>
                            
                                                        
                                                    </div>
                                                    <div class="detail-row" id="space-evenly">
                                                            <?php
                                                                customerDetail("",$correspondence_address);
                                                                customerDetail("",$permanent_address);
                                                            ?>
                                                    </div>
                                                    <div class="detail-row" id="space-evenly">
                                                        
                                                            <?php
                                                                customerDetail("City",$city);
                                                                customerDetail("State",$state);
                                                                customerDetail("Country",$country);
                                                                customerDetail("Pincode",$pincode);
                                                            ?>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <button class="button" onclick="document.getElementById('<?php echo $phone_number; ?>').style.display='block';" class="">
                                    Transfer
                                </button>
                                <div id="<?php echo $phone_number; ?>" class="w3-modal w3-animate-opacity" style="display:none;">
                                    <div class="w3-modal-content w3-card-4">
                                        <form action="processtransfer.php" method="post">
                                            <header class="w3-container"> 
                                                <span onclick="document.getElementById('<?php echo $phone_number; ?>').style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
                                                <h2>New Money Transfer Initiated</h2>
                                            </header>
                                            <div class="w3-container modal-content">
                                                <?php
                                                    transactionBox($account_number,$account_balance,$customer_name,$connection );
                                                ?>
                                            </div>
                                            <footer class="w3-container">
                                                 <button id="transfer-button">Confirm Transfer</button>
                                            </footer>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
                
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

</body>
</html>
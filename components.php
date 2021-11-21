<?php
    function customerDetail($detail_label,$detail_value){
?>
        <div class="cust-detail-box">
            <div class="detail-label"><?php echo $detail_label; ?></div>
            <div class="detail-value"><?php echo $detail_value; ?></div>
        </div>
<?php
    }
?>

<?php 
    function transactionBox($sender, $sender_balance,$sender_name, $connection){
        $amount = 1000;
?>

        <div class="transfer-row">
            <div class="sender">
                <?php echo $sender_name; ?>
                <input type="hidden" name="sender" value="<?php echo $sender; ?>">
                <input type="hidden" name="sender_balance" value="<?php echo $sender_balance; ?>">
                <input type="hidden" name="sender_name" value="<?php echo $sender_name; ?>">
            </div>
            <div class="amount">
                <input type="number" name="amount" id="<?php echo $sender; ?>" value="<?php echo $amount; ?>"/>
            </div>
            <div class="receiver">
                <select name="receiver" class="select-receiver">
                    <option value="" id="0" selected disabled hidden>---- SELECT ----</option>
                    <?php 
                        $get_list = "SELECT `CustomerID`,`AccountHolderName`,`AccountBalance` FROM `customers` WHERE `AccountNumber` <> '".$sender."';";
                        $beneficiaries = $connection->query($get_list);
                        foreach($beneficiaries as $beneficiary){
                            $customer_name = $beneficiary["AccountHolderName"];
                            $Customer_ID = $beneficiary["CustomerID"];
                            ?>
                                <option value="<?php echo $Customer_ID; ?>" id="<?php echo $Customer_ID; ?>"><?php echo $customer_name ?></option>
                        
                <?php
                        }
                    ?>
                </select>
                
            </div>
        </div>
        
<?php
    }
?>
<?php
$jsonObj=@json_decode($jsonObj);
$MERCHANT_KEY = "vjZGQwHh";
$SALT = "QrS4iwEV3P";
$PAYU_BASE_URL = "https://secure.payu.in";
//$amount = 1;
$userid = @$this->session->userdata("userid");
$amount = @$jsonObj->amount;
$firstname = @$jsonObj->firstname;
$email = @$jsonObj->email;
$phone = @$jsonObj->phone;
$productinfo = @$jsonObj->row_id."_".$userid;
$surl = base_url()."success";
$furl = base_url()."failure";	// For Production Mode
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$hash = '';
$hash_string = $MERCHANT_KEY.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|';;
$hash_string;
$hash_string .= $SALT;
$hash = strtolower(hash('sha512', $hash_string));
$action = $PAYU_BASE_URL . '/_payment';


?>
<html>
  <head>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
    $(document).keydown(function (event) {
      if (event.keyCode == 123) {
        return false;
      }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
        return false;
      }
    });

    $(document).on("contextmenu", function (e) {
      e.preventDefault();
    });

    $('body').bind('cut copy paste', function (e) {
       e.preventDefault();
    });
  </script>
  </head>
  <!--<body onload="submitPayuForm()"> -->
  <body  onload="submitPayuForm()">
<div style="position:fixed;width:100%;height:100%;background:#fff;text-align: center;">
  <img src="<?php echo base_url() ?>includes/images/ajaxloader.gif">
</div>
    <br/>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($amount)) ? '' : $amount ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($firstname)) ? '' : $firstname; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($email)) ? '' : $email; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" id="email" value="<?php echo (empty($phone)) ? '' : $phone; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($productinfo)) ? '' : $productinfo ?></textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($surl)) ? '' : $surl ?>"  /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($furl)) ? '' : $furl ?>" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl"  value="<?php echo (empty($furl)) ? '' : $furl ?>"/></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </body>
</html>

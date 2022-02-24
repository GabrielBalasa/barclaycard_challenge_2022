<?php
	require 'navigation.php';
	$order = $pdo->prepare('SELECT order_total, order_type FROM orders WHERE order_id = :order_id LIMIT 1');
	$values = [
		'order_id' => $_POST['reference_number']
	];
	$order->execute($values);
	$check = $order->fetch();
	if($check['order_type'] == "collection"){
		$finalprice = $check['order_total'];
	} else {
		$finalprice = $check['order_total'] + 5;
	}
?>

<html>
<head>
<script type="text/javascript">
	window.onload = function(){setTimeout( "document.forms[0].submit();", 100 )};
</script>
<?php
	$transaction_uuid = $_POST['transaction_uuid'];
	$locale = $_POST['locale'];
	$transaction_type = $_POST['transaction_type'];
	$reference_number = $_POST['reference_number'];
	$amount = $finalprice;
	$currency = $_POST['currency'];
	$signed_date_time = $_POST['signed_date_time'];	
	$access_key = $_POST['access_key'];
	$profile_id = $_POST['profile_id'];
	$signed_field_names = $_POST['signed_field_names'];
	//$unsigned_field_names = $_POST['unsigned_field_names'];

        $SECRET_KEY = "db92406734504a239cabfeaec480b27b88912f02a19446dfb8ccb20918db51ba7d5af803d1b24f099386125593e443b3aa19b136195d481b93d43c96ed37710368c560f16f514a56880227cd0d61ca264e2c918e066f42ffa50cb44d9d174a4c5956ae28d84e4f959b0b085cfe407bec29f67f04be06439a93ea31dcd2c697c7";
	
	define ('SECRET_KEY', 'db92406734504a239cabfeaec480b27b88912f02a19446dfb8ccb20918db51ba7d5af803d1b24f099386125593e443b3aa19b136195d481b93d43c96ed37710368c560f16f514a56880227cd0d61ca264e2c918e066f42ffa50cb44d9d174a4c5956ae28d84e4f959b0b085cfe407bec29f67f04be06439a93ea31dcd2c697c7');
	
        
	foreach($_REQUEST as $parameter_name => $parameter_value) {
        $params[$parameter_name] = $parameter_value;
    }
	
	function sign ($params) {
		return signData(buildDataToSign($params), SECRET_KEY);
	}

	function signData($data, $secretKey) {
		return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
	}

	function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
	}

	function commaSeparate ($dataToSign) {
		return implode(",",$dataToSign);
	}
	
?>
        <style>
                table, th, td
		{
			border: 1px solid black;
			border-collapse: collapse;
                        font-face: Tahoma;
		}
			
		th, td
		{
			padding: 5px;
		}
	</style>
</head>
<body>
    <font face="Tahoma">
	<h1 class="text-center">
		Redirecting to Payment Gateway...
	</h1>
	<div class="d-flex justify-content-center mb-5">
		<form method="post" action="https://testsecureacceptance.cybersource.com/pay" name="GatewayPush">
		<table>
			<col width="180">
			<col width="180">
			
		<?php
	            foreach($params as $parameter_name => $parameter_value) {
	                echo "<tr><td>" . $parameter_name . "</td><td>" . $parameter_value . "</td></tr>";
	            }
	        ?>
		</table>
		<div class="censorSquare"></div>
		<?php
	        foreach($params as $parameter_name => $parameter_value) {
	            echo "<input type=\"hidden\" id=\"" . $parameter_name . "\" name=\"" . $parameter_name . "\" value=\"" . $parameter_value . "\"/>\n";
	        }
	        echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
			
	
	    ?>
		<br /><br />
		
		<input class="btn btn-lg btn-block" id="clickButton" type="submit" id="submit" value="Pay up!">
		</form>
	</div>
	
	<?php require 'footer.php' ?>
</body>
</html>
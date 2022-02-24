<?php
	require 'navigation.php';
	$order_id = $_REQUEST['order_id'];
	$order = $pdo->prepare('SELECT order_total, order_type FROM orders WHERE order_id = :order_id LIMIT 1');
	$values = [
		'order_id' => $order_id
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
                                Processing...
                        </h1>
			
			<div class="d-flex justify-content-center mb-5">
			<form  method="post" action="HPPAuth2.php" name=BaseForm>
				<table>
					<col width="180">
					<col width="180">
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Transaction Unique ID</font>
						</td>
						<td>
							<input readonly type="text" name="transaction_uuid" value="<?php echo uniqid() ?>" >
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Language</font>
						</td>
						<td>
							<input readonly type="text" name="locale" value="en">
						</td>
					</tr>
							
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Transaction Type</font>
						</td>
						<td>
							<input readonly type="text" name="transaction_type" value="authorization">
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Reference Number</font>
						</td>
						<td>
							<input readonly type="text" name="reference_number" value="<?=$order_id ?>">
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Amount</font>
						</td>
						<td>
							<input readonly type="text" name="amount" value="<?=$finalprice ?>">
						</td>
					</tr>
					
					<div class="censorSquare"></div>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Currency</font>
						</td>
						<td>
							<input readonly type="text" name="currency" value="GBP">
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Signed Date Time</font>
						</td>
						<td>
							<input readonly type="text" name="signed_date_time" value="<?php echo gmdate("Y-m-d\TH:i:s\Z"); ?>">
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Access key</font>
						</td>
						<td>
                                                        <input readonly type="text" name="access_key" value="3800d6091ec437b0993b9d9d220849c4">
						</td>
					</tr>
					
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Profile ID</font>
						</td>
						<td>
                                                        <input readonly type="text" name="profile_id" value="FA4A5AD6-DDC8-4723-84DD-C526E89E24A0">
						</td>
					</tr>
					
                                        <tr>
						<td colspan="2">
							<font face="Tahoma" color="#000000"><b>Do not change unless necessary</b></font>
						</td>
					</tr>
                                        
					<tr>
						<td>
							<font face="Tahoma" color="#000000">Signed Field Names</font>
						</td>
						<td>
							<input readonly type="text" name="signed_field_names" value="access_key,amount,currency,locale,profile_id,reference_number,signed_date_time,signed_field_names,transaction_type,transaction_uuid">
						</td>
					</tr>
							
					<tr>
						<td align="center">
							<input class="btn btn-lg btn-block" type="submit" value="Pay up!">
						</td>
						<td align="center">
							<input class="btn btn-lg btn-block" type="button" value="Clear the field!" onclick="resetFunction()">
						</td>
					</tr>	
				</table>
			</form>
			</div>
		</font>
		<?php require 'footer.php' ?>
	</body>
</html>
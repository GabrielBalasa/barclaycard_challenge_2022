<?php
    $orders = $pdo->prepare('SELECT * FROM orders JOIN users ON orders.user_id = users.user_id GROUP BY order_id ORDER BY order_date DESC');
    $orders->execute();
    $pending = 0;
    $moneyPending = 0.00;
    $completed = 0;
    $moneyCompleted = 0.00;
    $delivery = 0;
    $moneyDelivery = 0.00;
    $collection = 0;
    $moneyCollection = 0.00;
    
?>

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Order Type/Status</th>
        <th>Number of orders</th>
        <th>Total cost</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $data){
        if($data['order_type'] == "delivery") {
            $delivery = $delivery + 1;
            $moneyDelivery = $moneyDelivery + $data['order_total'];
        } else if ($data['order_type'] == "collection") {
            $collection = $collection + 1;
            $moneyCollection = $moneyCollection + $data['order_total'];
        }
        if ($data['order_status'] == "Pending") {
            $pending = $pending + 1;
            $moneyPending = $moneyPending + $data['order_total'];
        } else if ($data['order_status'] == "Confirmed") {
            $completed = $completed + 1;
            $moneyCompleted = $moneyCompleted + $data['order_total'];
        }
    } ?>
    <tr>
        <td>Completed orders</td>
        <td><?=$completed ?></td>
        <td>£<?=$moneyCompleted ?></td>
    </tr>
    <tr>
        <td>Pending orders</td>
        <td><?=$pending ?></td>
        <td>£<?=$moneyPending ?></td>
    </tr>
    <tr>
        <td>Delivery</td>
        <td><?=$delivery ?></td>
        <td>£<?=$moneyDelivery ?></td>
    </tr>
    <tr>
        <td>Collection</td>
        <td><?=$collection ?></td>
        <td>£<?=$moneyCollection ?></td>
    </tr>
    </tbody>
  </table>
</div>
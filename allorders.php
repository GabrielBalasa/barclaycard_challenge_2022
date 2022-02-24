<?php
    $orders = $pdo->prepare('SELECT * FROM orders JOIN users ON orders.user_id = users.user_id GROUP BY order_id ORDER BY order_date DESC');
    $orders->execute();
?>

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Total</th>
        <th>Order Status</th>
        <th>Order Type</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $data){ ?>
      <tr>
        <td><?=$data['order_id'] ?></td>
        <td><?=$data['first_name'] ?></td>
        <td><?=$data['surname'] ?></td>
        <td><?=$data['order_total'] ?></td>
        <td><?=$data['order_status'] ?></td>
        <td><?=$data['order_type'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
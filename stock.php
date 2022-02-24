<?php 
    $stock = $pdo->prepare('SELECT * FROM products');
    $stock->execute();
?>

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Item Title</th>
        <th>Stock Amount</th>
        <th>Price per item</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($stock as $item){ ?>
        <tr>
            <td><?=$item['title'] ?></td>
            <td><?=$item['stock'] ?></td>
            <td>£<?=$item['price'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
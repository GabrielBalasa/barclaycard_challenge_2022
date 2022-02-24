<?php

$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
            $values = [
                'user_id' => $_SESSION['loggedin']
            ];
            $stmt->execute($values);
            $data = $stmt->fetch();

if(empty($_SESSION['loggedin']) || $data['user_access']=="0"){
    exit;
}

if(isset($_POST['editstock'])) {
    $update=$pdo->prepare('UPDATE products SET stock = :stock WHERE product_id = :product_id');
    $values=[
        'product_id' => $_POST['product_id'],
        'stock' => $_POST['stock']
    ];
    $update->execute($values);
}?>

<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM products ORDER BY product_id DESC');
        $select->execute();	

        echo '<label>Edit stock:</label></br><select class="w-50" name="product_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['product_id'] . '">' . $data['title'] . " - " . $data['stock'] . '</option>';
        } ?>
        </select>
        <input class="form-group mt-2 w-50" type="text" name="stock" placeholder="New stock level" required></br>
        
    <input type="submit" name="editstock" value="Change">
</form>
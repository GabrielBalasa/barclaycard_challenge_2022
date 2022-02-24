<?php
    if(isset($_POST['onemore' . (string)$product['product_id']])){
        $update = $pdo->prepare('UPDATE carts SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id');
        $values = [
            'product_id' => $product['product_id'],
            'user_id' => $_SESSION['loggedin'],
            'quantity' => $_POST['quantity']
        ];
        $update->execute($values);
        echo '<meta http-equiv="Refresh" content="0; url=\'cart.php\'" />';
    } else if(isset($_POST['oneless' . (string)$product['product_id']])){
        $update = $pdo->prepare('UPDATE carts SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id');
        $values = [
            'product_id' => $product['product_id'],
            'user_id' => $_SESSION['loggedin'],
            'quantity' => $_POST['quantity']
        ];
        $update->execute($values);
        echo '<meta http-equiv="Refresh" content="0; url=\'cart.php\'" />';
    } else if(isset($_POST['removeitem' . (string)$product['product_id']])){
        $update = $pdo->prepare('DELETE FROM carts WHERE product_id = :product_id AND user_id = :user_id');
        $values = [
            'product_id' => $product['product_id'],
            'user_id' => $_SESSION['loggedin']
        ];
        $update->execute($values);
        echo '<meta http-equiv="Refresh" content="0; url=\'cart.php\'" />';
    }
?>
<tr>
    <td>
        <div class="img">
            <a href="#"><img src="img/<?php echo $product['image_source']; ?>" alt="Image"></a>
            <p><?php echo $product['title'] ?></p>
        </div>
    </td>
    <td>£<?php echo $product['price']; ?></td>
    <td>
        <div class="qty">
            <form method="POST">
                <button class="btn-minus" name="oneless<?php echo $product['product_id']; ?>"><i class="fa fa-minus"></i></button>
                <input type="text" name="quantity" value="<?php echo $product['quantity'] ?>">
                <button class="btn-plus" name="onemore<?php echo $product['product_id']; ?>"><i class="fa fa-plus"></i></button>
            </form>
        </div>
    </td>
    <td>£<?php $itemtotal = $product['quantity'] * $product['price']; echo $itemtotal; ?></td>
    <td><form method="POST"><button name="removeitem<?php echo $product['product_id']; ?>"><i class="fa fa-trash"></i></button></form></td>
</tr>

<?php $subtotal = $subtotal + $itemtotal; ?>
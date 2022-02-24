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

if(isset($_POST['createproduct'])) {
    // An admin can create other admin account and only admin account because of the role from the users table that is set as 'admin'

    $stmt = $pdo->prepare('INSERT INTO products (title, description, stock, price, image_source) 
    VALUES (:title, :description, :stock, :price, :image_source)');
    $values = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'stock' => $_POST['stock'],
        'price' => $_POST['price'],
        'image_source' => $_POST['image_source']
    ];
    $stmt->execute($values);

    echo 'You successfully created a new product. <a href="products.php">See products.</a>';
        
    } else if (isset($_POST['editproduct'])){
    
        $update=$pdo->prepare('UPDATE products SET title = :title, description = :description, stock = :stock, price = :price, image_source = :image_source WHERE product_id = :product_id');
        $values=[
            'product_id' => $_POST['product_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'stock' => $_POST['stock'],
            'price' => $_POST['price'],
            'image_source' => $_POST['image_source']
        ];
        $update->execute($values);

        echo '<p>Changes completed!';
    
    } else if (isset($_POST['deleteproduct'])){
    
        $delete=$pdo->prepare('DELETE FROM products WHERE product_id = :product_id LIMIT 1');
        $values=[
            'product_id' => $_POST['product_id']
        ];
        $delete->execute($values);
    
        echo '<p>The product has been deleted!';
    
    }
    ?>
        <form  action="my-account.php" method="POST">
        <label>Add products:</label></br>
                <input class="form-group mt-2 w-50" type="text" name="title" placeholder="Product title" required>
                <input class="form-group mt-2 w-50" type="text" name="stock" placeholder="Stock" required>
                <input class="form-group mt-2 w-50" type="text" name="price" placeholder="Price" required>
                <input class="form-group mt-2 w-50" type="text" name="image_source" placeholder="Image name" required>
                <textarea class="form-group mt-2 w-50" rows="5" name="description" placeholder="Product description" required></textarea>
        
            <div class="col-8">
                <input class="form-group" type="submit" value="Create new product" name="createproduct" >
            </div>
        </form>
        
        <hr>
        
        <form action="my-account.php" method="POST" class="">
            <?php
                $select = $pdo->prepare('SELECT * FROM products ORDER BY product_id DESC');
                $select->execute();	
        
                echo '<label>Edit branch:</label></br><select class="w-50" name="product_id">';
                foreach ($select as $data) {
                    echo '<option class="align" value="' . $data['product_id'] . '">' . $data['title'] . " - " . $data['stock'] . " - " . $data['price'] .'</option>';
                } ?>
                </select>
                <input class="form-group mt-2 w-50" type="text" name="title" placeholder="New product title" required></br>
                <input class="form-group mt-2 w-50" type="text" name="stock" placeholder="New stock level" required></br>
                <input class="form-group mt-2 w-50" type="text" name="price" placeholder="New price" required></br>
                <input class="form-group mt-2 w-50" type="text" name="image_source" placeholder="New image name" required></br>
                <textarea class="form-group md-textarea mt-2 w-50" rows="5" name="description" placeholder="New item description" required></textarea></br>
                
            <input type="submit" name="editproduct" value="Change">
        </form>
        
        <hr>
        
        <form action="my-account.php" method="POST" class="">
            <?php
                $select = $pdo->prepare('SELECT * FROM products ORDER BY product_id DESC');
                $select->execute();	
        
                echo '<label>Delete product: </label></br><select class="select w-25" name="product_id">';
                foreach ($select as $data) {
                    echo '<option class="align" value="' . $data['product_id'] . '">' . $data['title'] . '</option>';
                }
                echo '</select>';
            ?></br>
            <input class="form-group mt-3" type="submit" name="deleteproduct" value="Delete">
        </form>
    
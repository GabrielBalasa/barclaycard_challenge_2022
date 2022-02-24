<?php
    if(isset($_POST['create'])){

        $stmt=$pdo->prepare('INSERT INTO categories (category_name)
                                VALUES (:category_name)');
        $values = [
            'category_name' => $_POST['category']
        ];
        $stmt->execute($values);
        echo '<p>The new category has been created!</p>';

    }   else if (isset($_POST['delete'])){

        $stmt=$pdo->prepare('DELETE FROM categories WHERE category_name = :category_name LIMIT 1');
        $values=[
            'category_name' => $_POST['deletecategory']
        ];
        $stmt->execute($values);

        echo '<p>The category has been deleted!</p>';

    }   else if(isset($_POST['edit'])){

        $update=$pdo->prepare('UPDATE categories SET category_name = :new_name WHERE category_id = :category_id');
        $values=[
            'new_name' => $_POST['new_name'],
            'category_id' => $_POST['category_id']
        ];
        $update->execute($values);
        echo '<p>Changes completed!</p>';

    }
?>

<form action="my-account.php" method="POST" class="simpleForm">
    <label>Create a new category:</label><input class="form-group" type="text" pattern="[A-Za-z0-9]{1,35}" name="category"  required>
    <input class="form-group" type="submit" name="create" value="Create">
</form>

<form action="my-account.php" method="POST" class="simpleForm">
    <?php
        $select = $pdo->prepare('SELECT * FROM categories ORDER BY category_id DESC');
        $select->execute();	

        echo '<label>Delete categories:</label><select class="select" name="deletecategory">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['category_name'] . '">' . $data['category_name'] . '</option>';
        }
        echo '</select>';
    ?>
    <input class="form-group" type="submit" name="delete" value="Delete">
</form>
<form action="my-account.php" method="POST" class="simpleForm">
    <?php
        $select = $pdo->prepare('SELECT * FROM categories ORDER BY category_id DESC');
        $select->execute();	

        echo '<label>Edit categories:</label><select class="select" name="category_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['category_id'] . '">' . $data['category_name'] . '</option>';
        }
        echo '<input type="text" pattern="[A-Za-z0-9]{1,35}" name="new_name" placeholder="New category name" required>';
        echo '</select>';
    ?>


    <input class="form-group" type="submit" name="edit" value="Change">
</form>
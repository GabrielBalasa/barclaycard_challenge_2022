<?php
    if (isset($_POST['deletebranch'])){
        $stmt=$pdo->prepare('DELETE FROM branches WHERE branch_name = :branch_name LIMIT 1');
        $values=[
            'branch_name' => $_POST['deletebranch']
        ];
        $stmt->execute($values);
    }
?>

<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id DESC');
        $select->execute();	

        echo '<label>Delete branches:</label><select class="" name="deletebranch">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['branch_id'] . '">' . $data['branch_name'] . '</option>';
        }
        echo '</select>';
    ?>
    <input type="submit" name="deletebranch" value="Delete">
</form>
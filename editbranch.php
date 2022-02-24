<?php 
    if (isset($_POST['editbranch'])) {
        $update=$pdo->prepare('UPDATE branches SET branch_name = :branch_name, branch_address = :branch_address WHERE branch_id = :branch_id');
        $values=[
            'branch_name' => $_POST['branch_name'],
            'branch_address' => $_POST['branch_address'],
            'branch_id' => $_POST['branch_id']
        ];
        $update->execute($values);
    }
?>
<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id DESC');
        $select->execute();	

        echo '<label>Edit branch:</label><select class="" name="branch_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['branch_id'] . '">' . $data['branch_name'] . " " . $data['branch_address'] .'</option>';
        }
        echo '<input type="text" pattern="[A-Za-z0-9]{1,}" name="branch_name" placeholder="New branch name" required>';
        echo '<input type="text" pattern="[A-Za-z0-9]{1,}" name="branch_address" placeholder="New branch address" required>';
        echo '</select>';
    ?>
    <input type="submit" name="editbranch" value="Change">
</form>
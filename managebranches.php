<?php
    if(isset($_POST['createbranch'])){

        $stmt=$pdo->prepare('INSERT INTO  branches (branch_name, branch_address) 
                    VALUES (:branch_name, :branch_address)');
        $values = [
            'branch_name'=>$_POST['branch_name'],
            'branch_address'=>$_POST['branch_address']
        ];
        $stmt->execute($values);

        echo '<p>The new branch has been created!';

    }   else if (isset($_POST['deletebranch'])){

        $delete=$pdo->prepare('DELETE FROM branches WHERE branch_id = :branch_id LIMIT 1');
        $values=[
            'branch_id' => $_POST['branch_id']
        ];
        $delete->execute($values);

        echo '<p>The branch has been deleted!';

    }   else if(isset($_POST['editbranch'])){

        $update=$pdo->prepare('UPDATE branches SET branch_name = :branch_name, branch_address = :branch_address WHERE branch_id = :branch_id');
        $values=[
            'branch_name' => $_POST['branch_name'],
            'branch_address' => $_POST['branch_address'],
            'branch_id' => $_POST['branch_id']
        ];
        $update->execute($values);

        echo '<p>Changes completed!';

    }
?>

<form action="my-account.php" method="POST" class="simpleForm">
    <label>Add new branch:</label></br>
    <label>Branch Name: </label></br>
    <input class="form-group w-50" type="text" name="branch_name" required /> </br>
    <label>Branch Address: </label></br>
    <input class="form-group w-50" type="text" name="branch_address" required /> </br>
    <input class="form-group" type="submit" name="createbranch" value="Create" />
</form>
<hr>
<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id DESC');
        $select->execute();	

        echo '<label>Delete branch: </label></br><select class="select w-25" name="branch_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['branch_id'] . '">' . $data['branch_name'] . '</option>';
        }
        echo '</select>';
    ?></br>
    <input class="form-group mt-3" type="submit" name="deletebranch" value="Delete">
</form>
<hr>
<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id DESC');
        $select->execute();	

        echo '<label>Edit branch:</label></br><select class="w-50" name="branch_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['branch_id'] . '">' . $data['branch_name'] . " - " . $data['branch_address'] .'</option>';
        } 
        echo '</select> </br>';        
        echo '<input class="form-group mt-3 w-50" type="text" name="branch_name" placeholder="New branch name" required></br>';
        echo '<input class="form-group w-50" type="text" name="branch_address" placeholder="New branch address" required></br>';
        
    ?>
    <input type="submit" name="editbranch" value="Change">
</form>
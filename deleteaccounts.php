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

if(isset($_POST['deleteemployee'])){
    // Deletes only one account, depending on which id is retrieved by the hidden input from the deteleadmin form

    $delete = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id LIMIT 1 ');
    $values= [
        'user_id' => $_POST['user_id']
    ];
    $delete->execute($values);

    echo 'You successfully deleted the account.';

} 
else {



$accounts = $pdo->prepare('SELECT * FROM users WHERE user_access ="1"');
$accounts->execute();

    foreach($accounts as $row){
        ?>
        
         <form  action="my-account.php" method="POST">
        <label><?php echo $row['surname'] . '  ' . $row['email'];?></label>
        <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>"/> </br>
        <input type="submit" name="deleteemployee" value="Delete"/>
        </form>
        <hr>
<?php
    }
}
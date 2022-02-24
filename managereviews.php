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

if(isset($_POST['approve'])) {
    $update=$pdo->prepare('UPDATE reviews SET approved = :approved WHERE review_id = :review_id');
    $values=[
        'review_id' => $_POST['review_id'],
        'approved' => 1
    ];
    $update->execute($values);
} else if (isset($_POST['delete'])){
    $delete=$pdo->prepare('DELETE FROM reviews WHERE review_id = :review_id');
    $values=[
        'review_id' => $_POST['review_id']
    ];
    $delete->execute($values);

}?>

<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM reviews WHERE approved = 0 ORDER BY review_date DESC');
        $select->execute();	

        echo '<label>Reviews:</label></br><select class="w-50 mb-3" name="review_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['review_id'] . '">' . $data['review_title'] . " | " . $data['review_author'] . " | " .$data['review_stars'] . " | " . $data['review_text'] . '</option>';
        } ?>
        </select>
        <br>
        
    <input class="mx-3" type="submit" name="approve" value="Approve review">
    <input type="submit" name="delete" value="Delete review">
</form>
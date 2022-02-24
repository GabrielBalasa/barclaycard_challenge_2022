<?php 
require 'navigation.php';
$date = date("Y-m-d");
$review = $pdo->prepare('SELECT * FROM reviews WHERE approved = 1 ORDER BY review_date DESC');
$review->execute();
if(isset($_POST['newreview'])) {
$addreview = $pdo->prepare('INSERT INTO reviews (review_title, review_author, review_date, review_text, review_stars)
                            VALUES (:review_title, :review_author, :review_date, :review_text, :review_stars)');
$values = [
    'review_title' => $_POST['review_title'],
    'review_author' => $_POST['review_author'],
    'review_date' => $date,
    'review_text' => $_POST['review_text'],
    'review_stars' => $_POST['review_stars']
];
$addreview->execute($values);
}
?>


<div class="featured-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Reviews</h1>
        </div>
        <?php
            foreach ($review as $data){
                require 'review.php';
            }
        ?>
    </div>
</div>

<div class="px-3 mx-5">
    <form action="reviews.php" method="POST">
        <label>Your review:</label></br>
        <input class="form-group mt-2 w-50" type="text" name="review_author" placeholder="Your name" required>
        <input class="form-group mt-2 w-50" type="text" name="review_title" placeholder="Review title" required>
        <select class="form-group mt-2 w-50" name="review_stars">
        <option value="5">5 Stars</option>
        <option value="4">4 Stars</option>
        <option value="3">3 Stars</option>
        <option value="2">2 Stars</option>
        <option value="1">1 Star</option>
        </select>
        <textarea class="form-group mt-2 w-50" rows="5" name="review_text" placeholder="Your opinion" required></textarea>
    
        <div class="col-8">
        <input class="form-group btn" type="submit" value="Submit" name="newreview" >
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
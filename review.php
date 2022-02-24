<?php  
$newDate = date("d-m-Y", strtotime($data['review_date'])); 
?>

<div class="section-header">
<h4>
<?=$data['review_title']?> (<?php if($data['review_stars'] == 1) { echo '<i class="fas fa-star"></i>'; }
else if($data['review_stars'] == 2) { echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; }
else if($data['review_stars'] == 3) { echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; }
else if($data['review_stars'] == 4) { echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; }
else if($data['review_stars'] == 5) { echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>'; echo '<i class="fas fa-star"></i>';}

?>) - <?=$data['review_author'] ?></h4>
<p>Reviewed at <?=$newDate?></p>
<p><?=$data['review_text']?></p>
</div>
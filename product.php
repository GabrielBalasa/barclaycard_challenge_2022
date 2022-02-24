<form class="col-md-4" method="POST">
    <div class="product-item">
        <div class="product-title">
            <input type="hidden" value="<?php echo $product['product_id'];?>" name="product_id" /> 
            <a href="#"><?php echo $product['title']; ?></a>
        </div>
        <div class="product-image">
            <a href="product-detail.php?product_id=<?php echo $product['product_id'] ?>">
                <img src="img/<?php echo $product['image_source']; ?>" alt="Product Image">
            </a>
        </div>
        <div class="product-price">
            <h3><span>£</span><?php echo $product['price']; ?></h3>
            <!-- <a class="btn buynow" href="#" name="addtocart"><i class="fa fa-shopping-cart"></i>Buy Now</a> -->
            <input class="noStyle btn" type="submit" value="Buy now" name="addtocart" />
        </div>
    </div>
</form>
<div class="col-lg-3">
    <div class="product-item">
        <div class="product-title">
            <a href="#"><?php $product['title'] ?></a>
        </div>
        <div class="product-image">
            <a href="product-detail.html">
                <img src="<?php echo $product['image_source']; ?>" alt="Product Image">
            </a>
            <div class="product-action">
                <a href="#"><i class="fa fa-cart-plus"></i></a>
                <a href="#"><i class="fa fa-search"></i></a>
            </div>
        </div>
        <div class="product-price">
            <h3><span>£</span><?php $product['price'] ?></h3>
            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
        </div>
    </div>
</div>
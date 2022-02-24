<?php require 'navigation.php' ?>

<!-- My Account Start -->
<div class="my-account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab">Dashboard</a>
                    <a class="nav-link" id="allorders-nav" data-toggle="pill" href="#allorders-tab" role="tab">Orders</a>
                    <a class="nav-link" id="stock-nav" data-toggle="pill" href="#stock-tab" role="tab">Stock</a>
                    <a class="nav-link" id="products-nav" data-toggle="pill" href="#orders-tab" role="tab">Manage products</a>
                    <a class="nav-link" id="accounts-nav" data-toggle="pill" href="#accounts-tab" role="tab">Manage accounts</a>
                    <a class="nav-link" id="branches-nav" data-toggle="pill" href="#manage-branches" role="tab">Manage branches</a>
                    <a class="nav-link" id="stock-nav" data-toggle="pill" href="#manage-stock" role="tab">Manage stock</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#manage-orders" role="tab">Manage orders</a>
                    <a class="nav-link" id="reviews-nav" data-toggle="pill" href="#manage-reviews" role="tab">Manage reviews</a>
                    <a class="nav-link" id="refunds-nav" data-toggle="pill" href="#manage-refunds" role="tab">Manage refunds</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                    <h4>Dashboard</h4>
                        <?php require 'dashboard.php' ?>
                    </div>
                    <div class="tab-pane fade" id="allorders-tab" role="tabpanel" aria-labelledby="allorders-nav">
                    <h4>Orders</h4>
                        <?php require 'allorders.php' ?>
                    </div>
                    <div class="tab-pane fade" id="stock-tab" role="tabpanel" aria-labelledby="stock-nav">
                    <h4>Stock</h4>
                        <?php require 'stock.php' ?>
                    </div>
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="products-nav">
                    <h4>Manage products</h4>
                        <?php require 'newproduct.php' ?>
                    </div>
                    <div class="tab-pane fade" id="accounts-tab" role="tabpanel" aria-labelledby="accounts-nav">
                        <h4>Manage admin accounts</h4>
                            <?php require 'accounts.php'?>
                    </div>
                    <div class="tab-pane fade" id="manage-branches" role="tabpanel" aria-labelledby="branches-nav">
                        <h4>Manage branches</h4>
                        <?php require 'managebranches.php' ?>
                    </div>
                    <div class="tab-pane fade" id="manage-stock" role="tabpanel" aria-labelledby="stock-nav">
                        <h4>Manage stock</h4>
                        <?php require 'managestock.php' ?>
                    </div>
                    <div class="tab-pane fade" id="manage-orders" role="tabpanel" aria-labelledby="orders-nav">
                        <h4>Manage orders</h4>
                        <?php require 'manageorders.php' ?>
                    </div>
                    <div class="tab-pane fade" id="manage-reviews" role="tabpanel" aria-labelledby="reviews-nav">
                        <h4>Manage reviews</h4>
                        <?php require 'managereviews.php' ?>
                    </div>
                    <div class="tab-pane fade" id="manage-refunds" role="tabpanel" aria-labelledby="refunds-nav">
                        <h4>Manage refunds</h4>
                        <?php require 'managerefunds.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account End -->   
<?php require "footer.php" ?>

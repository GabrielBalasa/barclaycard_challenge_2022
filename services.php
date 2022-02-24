<?php require 'navigation.php'?>

<div class="container-fluid pb-4">
    <div class="row d-flex justify-content-center ">
       <div class="col-lg-8 bg-white p-5">
            <div class="row">
<?php
        $services = $pdo->prepare('SELECT * FROM services');
        $services->execute();	

        foreach($services as $service){
?>
                <div class="col-6 pb-2">
                    <h4><?=$service['service_name']?></h4>
                </div>

                <div class="col-6 pb-2 d-flex justify-content-end">
                    <h4>£<?=$service['service_price']?></h4>
                </div>
<?php } ?>
            </div>
       </div>
    </div>
</div>


<?php require 'footer.php' ?>
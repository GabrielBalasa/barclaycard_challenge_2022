<?php require 'navigation.php' ?>



      <div class="container-fluid">
        <div class="row d-flex justify-content-center pb-4">
            <div class="col-6 bg-white p-5">

            <h3>Payment</h3>

            <div class="form-group col-12 py-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="card-type">Card type</label>
                    </div>
                <select class="custom-select" id="card-type" required>
                    <option selected>Choose...</option>
                    <option value="1">Visa</option>
                    <option value="2">Master Card</option>
                    <option value="3">Three</option>
                </select>
            </div>
            </div>

            <div class="card-details">
                <h3 class="title">Credit Card Details</h3>
                <div class="row">
                <div class="form-group col-8">
                    <label for="card-holder">Card Holder</label>
                    <input id="card-holder" type="text" class="form-control" placeholder="Card Holder">
                </div>
                <div class="form-group col-4">
                    <label for="">Expiration Date</label>
                    <div class="input-group expiration-date">
                    <input type="text" class="form-control" placeholder="MM">
                    <span class="date-separator">/</span>
                    <input type="text" class="form-control" placeholder="YY">
                    </div>
                </div>
                <div class="form-group col-8">
                    <label for="card-number">Card Number</label>
                    <input id="card-number" type="text" class="form-control" placeholder="Card Number">
                </div>
                <div class="form-group col-4">
                    <label for="cvc">CVC</label>
                    <input id="cvc" type="text" class="form-control" placeholder="CVC">
                </div>
                
                <div class="form-group col-12 d-flex justify-content-center">
                    <button type="submit" class="btn ">Proceed</button>
                </div>
                </div>

                
            </div>
            </form>
        </div>
        </div>
        </div>
      </div>    



<?php require "footer.php" ?>


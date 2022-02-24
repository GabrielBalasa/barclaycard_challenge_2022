<?php require 'navigation.php';

$validation = false;

if(isset($_POST['signup'])){
  $duplicate = $pdo->prepare('SELECT * FROM users');
  $duplicate->execute();
  foreach ($duplicate as $row){
    if($row['email'] == $_POST['email']){
      $validation = true;
    }
  }
  if($validation){
    echo '<p class="h2 d-flex justify-content-center pb-4">An account with this email already exists. <a class="px-2" href = "register.php" class="noStyle link">Try again.</a>';
  } else {
    $stmt = $pdo->prepare('INSERT INTO users  (first_name, surname, email, phone, password, address, city, postcode, country, date_of_birth) 
                                      VALUES (:first_name, :surname, :email, :phone, :password, :address, :city, :postcode, :country, :date_of_birth)');
    $values = [
      'first_name'  => $_POST['first_name'],
      'surname' => $_POST['surname'],
      'email' => $_POST['email'],
      'phone' => $_POST['phone'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
      'address' => $_POST['address'],
      'city' => $_POST['city'],
      'postcode' => $_POST['postcode'],
      'country' => $_POST['country'],
      'date_of_birth' => $_POST['date_of_birth']
    ];
    $stmt->execute($values);
    echo '<p class="h2 d-flex justify-content-center pb-4">You are now a member! Go to <a class="px-2" href = "login.php" class="noStyle link">login</a> page ';

}
}

else {
?>

<div class="container-fluid login">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 ">    
                <form action="register.php" method="POST" class="register-form">
                    <div class="row form-row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Surname</label>
                            <input class="form-control" type="text"  name="surname"  placeholder="Surname" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" pattern="[a-z0-9._]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone number</label>
                            <input class="form-control" type="text" name="phone" placeholder="Phone number" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password"  required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password"  placeholder="Confirm password" required >
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" name="address" placeholder="Address" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" placeholder="City" required> 
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Postcode</label>
                            <input class="form-control" type="text" name="postcode" placeholder="Postcode" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" name="country" placeholder="Country" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Date of birth:</label>
                            <input class="form-control" type="date" name="date_of_birth" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="custom-control custom-checkbox form-check">
                                <input type="checkbox" class="custom-control-input" id="newaccount" required>
                                <label class="custom-control-label" for="newaccount">I have read and agree to the <a href="#">Terms and Conditions</a></label>
                            </div>
                        </div>
                       
                        <div class="col-md-12 form-group pt-3 d-flex justify-content-center">
                            <button class="btn" type="submit" name="signup" >Create account</button>
                        </div>
                    </div>
                    <h5 class="d-flex justify-content-center">Already have an account?<a class="pl-2" href="#">Sign in!</a></h5>
                </form>
            </div>
            </div>
            </div>
          
<?php 
}
   
require 'footer.php';
?>
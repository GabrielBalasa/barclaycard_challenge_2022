<?php
require 'navigation.php';
if (isset($_POST['login'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $values = [
        'email' => $_POST['email']
    ];

    $stmt->execute($values);
    $data = $stmt->fetch();
    $pass = password_verify($_POST['password'], $data['password']);
    if ($stmt->rowCount() > 0 && $pass){
  
        $user = $data['user_id']; 
        $_SESSION['loggedin'] = $user;

        echo '<meta http-equiv="Refresh" content="0; url=\'index.php\'" />';
    } else {
        echo '<p class="h2 d-flex justify-content-center pb-4">Sorry, your username and password could not be found. Go to <a class="px-2" href = "login.php" class="noStyle link">login</a> page and try again</p>';
    }
} else {
?>
<div class="login">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            
            <div class="col-lg-6">
                <form action="login.php" method="POST" class="login-form py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-9 form-group">
                            <label class="h4 pb-2">Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-9 form-group">
                            <label class="h4 pb-2">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-9 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                            </div>
                        </div>
                        <div class="col-md-9 form-group d-flex justify-content-center">
                            <button type="submit" name="login" class="btn">Login</button>
                        </div>
                            <p class="col-md-9 d-flex justify-content-center"><a href="#">Forgot your password?</a></p>
                            <p class="col-md-9 d-flex justify-content-center">Don't have an account? <a class="pl-1" href="register.php">Create one!</a></p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
    require "footer.php";
?>
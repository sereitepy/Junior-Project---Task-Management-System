<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}
ob_end_flush();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>
<?php include 'header.php' ?>
<body class="hold-transition login-page bg-gray">
<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-white"><b><?php echo $_SESSION['system']['name'] ?> </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="signup-form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="firstname" required placeholder="First Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastname" required placeholder="Last Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="">
              <label for="remember">
                Already have an account? <a href="login.php">Login Here</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
 $(document).ready(function(){
    $('#signup-form').submit(function(e){
        e.preventDefault();
        start_load();

        // Check for the correct email domain
        var email = $('input[name="email"]').val();
        var emailDomain = "@paragoniu.edu.kh";
        if (!email.endsWith(emailDomain)) {
            if($(this).find('.alert-danger').length > 0 )
                $(this).find('.alert-danger').remove();
            $('#signup-form').prepend('<div class="alert alert-danger">Please use an email address ending with @paragoniu.edu.kh.</div>');
            end_load();
            return;
        }

        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'ajax.php?action=signup',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err);
                end_load();
            },
            success: function(resp){
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                } else if (resp == 2) {
                    $('#signup-form').prepend('<div class="alert alert-danger">Email already exists.</div>');
                    end_load();
                } else {
                    $('#signup-form').prepend('<div class="alert alert-danger">Signup failed. Please try again.</div>');
                    end_load();
                }
            }
        });
    });
});


</script>
<?php include 'footer.php' ?>
</body>
</html>


<?php include 'header.php' ?>

<title>WeMessage</title>


<main>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <img class="d-none d-sm-block" src="images/login_svg.svg" alt="">
      </div>
      <div class="col-md-10 mx-auto col-lg-5">

        <form id="login" method="POST" class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
          <h1 class="h3 text-center fw-bold mb-3 text-uppercase">account login </h1>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="name@example.com">
            <label for="floatingInput">username / email address</label>
          </div>

          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>

          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" required value="remember-me"> Remember me
            </label>
          </div>

          <!-- ERROR MeSSAGE -->
              <div style="display: none;" id="notify" class="alert   text-center alert-dismissible fade show" role="alert">
                <b id="error_show"></b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
              </div>


          <button id="loginbtn" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
          <hr class="my-4">
          <small class="text-body-secondary">By clicking Sign in, you agree to the terms of use.</small>
        </form>

      </div>
    </div>
  </div>


</main>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/color-modes.js"></script>

</body>
</html>

<script>
  $(document).ready(function(e) {
    $("#notify").hide();
    //$("#error_show").hide();
  });

  $("form#login").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url: './actions/login_auth',
            type: 'POST',
            data: formData,
            beforeSend:function(){
                $('#loginbtn').html("logging in <span class='fas fa-1x fa-spinner fa-spin'></span>").show().addClass('disabled');
            },
            success: function (data) {
                if (data == "success") {
                    $("#notify").show().addClass('alert-success');

                    $("#error_show").html("Login is successful. Redirecting to Dashboard... <span class='fas fa-1x fa-spinner fa-pulse'></span>").show();

                    setTimeout(' window.location.href = "./dashboard"; ', 3000);
                }else{
                    $("#notify").show().addClass('alert-danger');
                    $("#error_show").html(data).show();
                }   
            },
            cache: false,
            error:function(){
                ('#notify').show().addClass('alert-warning');
                $('#error_show').html("An error has occured!!").show();
            },
            contentType: false,
            processData: false
        });
    });
</script>
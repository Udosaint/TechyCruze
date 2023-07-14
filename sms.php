<?php 
include 'config.php';
require 'header.php';
 ?>


 <title><?= SITE  ?> Send SMS</title>


<style>
	
	body {
	  min-height: 100vh;
	  min-height: -webkit-fill-available;
	}

	html {
	  height: -webkit-fill-available;
	}

	main {
	  height: 100vh !important;
	  height: -webkit-fill-available;
	  max-height: 100vh !important;
	  overflow-x: auto !important;
	  overflow-y: hidden !important;
	}


	.btn-toggle-nav a {
	  padding: .1875rem .5rem;
	  margin-top: .125rem;
	  margin-left: 1.25rem;
	}
	.btn-toggle-nav a:hover,
	.btn-toggle-nav a:focus {
	  background-color: var(--bs-tertiary-bg);
	}

	.scrollarea {
	  overflow-y: auto ;
	}
	
</style>

<div class="container-fluid">
  <div class="row">

  <?php 
  	include 'nav.php'; 
  ?>

    <!-- SIDEBAR  -->
  	<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
	    <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
	      <div class="offcanvas-header">
	        <h5 class="offcanvas-title" id="sidebarMenuLabel"><?php echo SITE_NAME ?></h5>
	        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
	      </div>

	      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

	        <ul class="nav nav-pills flex-column mb-auto px-3">

	          <li class="nav-item mb-1">
	            <a class="nav-link d-flex align-items-center gap-2 "  href="dashboard">
	              <i class="fa-solid fa-gauge"></i>
	              Dashboard
	            </a>
	          </li>

	          <li class="nav-item mb-1">
	            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"  href="sms">
	              <i class="fa-regular fa-paper-plane"></i>
	              Send SMS
	            </a>
	          </li>

	        <li class="nav-item mb-1">
	            <a class="nav-link d-flex align-items-center gap-2" href="sendngn">
	              <i class="fa-solid fa-plus"></i>
	              SMS Nigeria
	            </a>
	          </li>

	          <li class="nav-item">
	            <a class="nav-link d-flex align-items-center gap-2 "  href="report">
	               <i class="fa-solid fa-list-check"></i>
	              SMS Reports
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="error">
	               <i class="fa-solid fa-bug"></i>
	              Error Reports
	            </a>
	          </li>
	        </ul>

	        </ul>

	        <hr class="my-3">

	        <ul class="nav flex-column mb-auto bottom-0 px-3">
	          <li class="nav-item">
	            <a class="nav-link d-flex align-items-center gap-2" href="actions/logout">
	              <i class="fa-solid fa-right-from-bracket"></i>
	              Sign out
	            </a>
	          </li>
	        </ul>
	      </div>
	    </div>
	  </div>
	<!-- SIDEBAR END -->

  	<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 class="h2">Send SMS</h1>
	    </div>

	      <div class="container col-md-8 mx-auto">

			    <form id="sendsms"  method="POST"  class="form-control">
			      
			      <div class="mb-3">
			        <label for="exampleFormControlInput1" class="form-label">Sender</label>
			        <input type="text" maxlength="11" required class="form-control" name="sender" id="sender" placeholder="Zenith">
			        <p id="senderror" class="text-danger"></p>
			      </div>

			      <div class="mb-3">
			        <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
			        <input type="text" required class="form-control" name="receiver" id="receiver" placeholder="+23481836578">
			      </div>

			      <div class="mb-3">
			        <label for="exampleFormControlTextarea1" class="form-label">Message </label>
			        <textarea class="form-control" required name="message" id="message" placeholder="Hi' Welcome to WeMessage"></textarea>
			      </div>
					
<!-- 					<div class="mb-3">
			        <label for="exampleFormControlTextarea1" class="form-label">Message </label>
			        <input class="form-control" required name="message" id="message" placeholder="Hi' Welcome to WeMessage">
			      </div> -->
			        <!-- ERROR MeSSAGE -->
              <div style="display: none;" id="notify" class="alert   text-center alert-dismissible fade show" role="alert">
                <b id="error_show"></b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
              </div>



			      <div class="mb-3 text-center p-2">
			        <button id="btnsms" class="btn btn-md btn-block btn-outline-primary" name="sen" type="submit">
			        <i class="fa-regular fa-paper-plane"></i>
			      	Send SMS</button>
			      </div>
			    </form>
			  </div>
     
    </main>

  </div>
</div>





<?php include 'footer.php'; ?>

<script>
	$(document).ready(function(e) {
		$("#notify").hide();

		$("#senderror").hide();
	});

	$("form#sendsms").submit(function(e) {

        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url: './Api/sendSMS',
            type: 'POST',
            data: formData,
            beforeSend:function(){
                $('#btnsms').html("Sending SMS <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
            },
            success: function (data) {
                if (data == "success") {
                    $("#notify").show().addClass('alert-success');

                    $("#error_show").html("SMS sent succssfully. Redirecting... <span class='fas fa-1x fa-spinner fa-pulse'></span>").show();

                    setTimeout(' window.location.href = "sms"; ', 3000);
                }else{
                    $("#notify").show().addClass('alert-danger');
                    $("#error_show").html(data).show();
                }   
            },
            cache: false,
            error:function(){
                ('#notify').show().addClass('alert-warning');
                $('#error_show').html("An error has occured!!").show();
                console.log(data);
            },
            contentType: false,
            processData: false
        });
    });


    $("#sender").on('input',function(){

    	var senderlen = $("#sender").val();
    	
    	if (senderlen.length >= 11){

    		$("#senderror").html("only 11 character is allow").show();
    	}else{
    		$("#senderror").hide();
    	}
    });
</script>
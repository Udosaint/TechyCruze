<?php 
include 'config.php';
require 'header.php';

if (!isset($_SESSION['username'])) {
	header("Location: ./");
	exit();
}
 ?>


 <title><?= SITE  ?> Dashboard</title>


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
  	include 'sidebar.php' ;
  ?>

  	<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-4 px-sm-4 py-sm-4 mb-md-5">

	    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 class="h2">Dashboard</h1>
	    </div>

	    <div class="row row-cols-2 row-cols-md-2 g-2 mb-5">
			  <div class="col">
			    <div class="card h-100 border-primary">
			    	<div class="row g-0 d-flex align-items-center justify-content-between">
			    		<div class="col-md-4 d-flex align-self-center px-3 py-3 display-3 text-primary">
			    			<i class="fa-solid fa-dollar"></i>
			    		</div>

			    		<div class="col-md-8">
			    			<div class="card-body">
					        	<h5 class="card-title">SMS Balance</h5>
					        	<p id="smsbalance" class="card-text">
					        		Fetching Balance 
					        		<span class='fas fa-1x fa-spinner fa-spin'></span>
					        	</p>
					      	</div>
			    		</div>
			    	</div>
			    </div>
			  </div>

			  <div class="col">
			    <div class="card h-100 border-secondary">
			    	<div class="row g-0 d-flex align-items-center justify-content-between">
			    		<div class="col-md-4 d-flex align-self-center px-3 py-3 display-3 text-secondary">
			    			<i class="fa-solid fa-download"></i>
			    		</div>

			    		<div class="col-md-8">
			    			<div class="card-body">
					        	<h5 class="card-title">Total SMS</h5>
					        	<p id="totalsms" class="card-text">Fetching Total</p>
					      	</div>
			    		</div>
			    	</div>
			    </div>
			  </div>

			    <div class="col">
				    <div class="card h-100 border-success">
				    	<div class="row g-0 d-flex align-items-center justify-content-between">
				    		<div class="text-success col-md-4 align-self-center px-3 py-3 display-3">
				    			<i class="fa-regular fa-circle-check"></i>
				    		</div>

				    		<div class="col-md-8">
				    			<div class="card-body">
						        	<h5 class="card-title">Delivered SMS</h5>
						        	<p id="totaldel" class="card-text">This is a short card.</p>
						      	</div>
				    		</div>
				    	</div>
				    </div>
			    </div>

			    <div class="col">
				    <div class="card h-100 border-danger">
				    	<div class="row g-0 d-flex align-items-center justify-content-between">
				    		<div class="col-md-4 align-self-center px-3 py-3 display-3 text-danger">
				    			<i class="fa-solid fa-triangle-exclamation" ></i>
				    		</div>

				    		<div class="col-md-8">
				    			<div class="card-body">
						        	<h5 class="card-title">Failed SMS</h5>
						        	<p id="totalfail" class="card-text">This is a short card.</p>
						      	</div>
				    		</div>
				    	</div>
				    </div>
			   </div>

			    <div class="col">
				    <div class="card h-100 border-tertiary">
				    	<div class="row g-0 d-flex align-items-center justify-content-between">
				    		<div class="col-md-4 align-self-center px-3 py-3 display-3 text-tertiary">
				    			<i class="fa-solid fa-xmark"></i>
				    		</div>

				    		<div class="col-md-8">
				    			<div class="card-body">
						        	<h5 class="card-title">Rejected SMS</h5>
						        	<p id="totalreject" class="card-text">Fetching...</p>
						      	</div>
				    		</div>
				    	</div>
				    </div>
			   </div>
			</div>

     
    </main>

  </div>


</div>

<?php include 'footer.php'; ?>

<script>
  $(document).ready(function(e) {
    getBalance();

    countSMS();
    countdel();
    countfail();
    countject();
  });

  function getBalance() {
    $.ajax({
        url: './Api/balance',
        type: 'GET',
        beforeSend:function(){
          $('#smsbalance').html("Fetching Balance <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
         },
        success: function (data) {
        	
            $("#smsbalance").html(data).show();
        },
        cache: false,
        error:function(){
            $('#smsbalance').html("An error has occured!!").show();
        },
        contentType: false,
        processData: false
    });
  };

  function countSMS() {
    $.ajax({
        url: './actions/sms_actions?action=countSMS',
        type: 'GET',
        beforeSend:function(){
          $('#totalsms').html("Fetching Balance <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
         },
        success: function (data) {
        	
            $("#totalsms").html(data).show();
        },
        cache: false,
        error:function(){
            $('#totalsms').html("An error has occured!!").show();
        },
        contentType: false,
        processData: false
    });
  };

  function countdel() {
    $.ajax({
        url: './actions/sms_actions?action=countdeliver',
        type: 'GET',
        beforeSend:function(){
          $('#totaldel').html("Fetching Balance <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
         },
        success: function (data) {
        	
            $("#totaldel").html(data).show();
        },
        cache: false,
        error:function(){
            $('#totaldel').html("An error has occured!!").show();
        },
        contentType: false,
        processData: false
    });
  };

  function countfail() {
    $.ajax({
        url: './actions/sms_actions?action=countfail',
        type: 'GET',
        beforeSend:function(){
          $('#totalfail').html("Fetching Total <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
         },
        success: function (data) {
        	
            $("#totalfail").html(data).show();
        },
        cache: false,
        error:function(){
            $('#totalfail').html("An error has occured!!").show();
        },
        contentType: false,
        processData: false
    });
  };

  function countject() {
    $.ajax({
        url: './actions/sms_actions?action=countrejected',
        type: 'GET',
        beforeSend:function(){
          $('#totalreject').html("Fetching Total <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
         },
        success: function (data) {
        	
            $("#totalreject").html(data).show();
        },
        cache: false,
        error:function(){
            $('#totalreject').html("An error has occured!!").show();
        },
        contentType: false,
        processData: false
    });
  };
</script>
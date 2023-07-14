<?php 
include 'config.php';
require 'header.php';

	$errors = '';
	$chekPwd = $db_conn->prepare("SELECT * FROM error_log");
    $chekPwd->execute();
    if ($chekPwd->rowCount() < 1) {
        $errors = "There is no data found";
    }
 ?>


 <title><?= SITE  ?> Error Report</title>
 <script src="js/jquery-3.4.1.min.js"></script>


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
	        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
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
	            <a class="nav-link d-flex align-items-center gap-2 "  href="sms">
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
	            <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="report">
	               <i class="fa-solid fa-list-check"></i>
	              SMS Reports
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="error">
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
	        <h1 class="h2">SMS Report</h1>
	    </div>

	    <div class="table-responsive-md card card-body">
	    	
        <table class="table  table-md  caption-top">
        	<caption class="h5">List of all SMS reports</caption>
          <thead class="table-dark">
            <tr class="">
              <th class="" scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Recipients</th>
              <th scope="col">Content</th>
              <th scope="col">Error</th>
            </tr>
          </thead>
          <tbody>

          <?php $i = 1; while ($row = $chekPwd->fetch(PDO::FETCH_ASSOC)):?>
          	<tr>
              <td><?= $i++ ?></td>
              <td><?= $row['date'] ?></td>
              <td><?= $row['receiver'] ?></td>
              <td><?= $row['message'] ?></td>
              <td><?= $row['error'] ?></td>
        
            </tr>

            <script>
            	$("#refresh<?= $row['request_id'] ?>").click(function(){
								var id = $(this).attr("data");
								//alert(id);

									$.ajax({
							        url: './Api/status?id='+id,
							        type: 'GET',
							        data: {id:id},
							        beforeSend:function(){
							          $('#refresh<?= $row['request_id'] ?>').html("Refreshing..");
							         },
							        success: function (data) {
							            //$("#smsbalance").html(data).show();
							        	$('#refresh<?= $row['request_id'] ?>').html('<i class="fa-solid fa-rotate"></i>');
							        	alert(data);
							        	console.log(data);
							        },
							        cache: false,
							        error:function(){
							            alert("An error occured");
							        },
							        contentType: false,
							        processData: false
							    });

							});
            </script>
          <?php endwhile ?>

            
          </tbody>
        </table>

        <p class="w-100 h4 text-center"><?php echo $errors ?></p>
      </div>
     
    </main>

  </div>
</div>

<?php include 'footer.php'; ?>

<script>
	
$(document).ready(function(e){


})




</script>
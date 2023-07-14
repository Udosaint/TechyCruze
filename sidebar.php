

  <div class=" sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary ">
    <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header mb-0">
        <h5 class="offcanvas-title" id="sidebarMenuLabel"><?php echo SITE_NAME ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>


      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

        <ul class="nav nav-pills flex-column mb-auto px-3">

          <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="dashboard">
              <i class="fa-solid fa-gauge"></i>
              Dashboard
            </a>
          </li>

          <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center gap-2" href="sms">
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
            <a class="nav-link d-flex align-items-center gap-2" href="report">
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

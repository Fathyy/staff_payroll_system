<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <?php
        if (isset($_SESSION['auth'])) :?>
          <h5>Hello <?php echo $_SESSION['auth']['fname']?></h5>  
        <?php endif ?>
        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          
        </div>
      </div>
    </nav>
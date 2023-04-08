<?php $this->extend('v_Template'); ?>
<?php $this->section('content'); ?>

<!-- CONTENT -->
<section id="content">
  <!-- NAVBAR -->
  <nav>
    <i class='bx bx-menu'></i>
    <form action="#">
      <div class="form-input">
        <input type="search" placeholder="Search...">
        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
      </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>
  </nav>
  <!-- END NAVBAR -->

  <!-- MAIN -->
  <main>
    <div class="table-data">
      <div class="order">
        <form action="/" method="POST">
          <div class="w-75">

            <!-- <div class="form-group row mt-4">
              <label for="inputNIP" class="col-sm-2 col-form-label">NIP</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="inputNIP" placeholder="NIP" name="nip">
              </div>
            </div>
            <div class="form-group row mt-4">
              <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="username" class="form-control" id="inputUsername" placeholder="Username" name="username">
              </div>
            </div>
            <div class="form-group row mt-4">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
              </div>
            </div>

            <div class="form-group row mt-4">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </div>
          </div> -->
            <section class="vh-50">
              <div class="container py-5 h-50">
                <div class="row d-flex align-items-center justify-content-center h-100">
                  <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
                  </div>
                  <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <!-- NIP input -->
                    <div class="form-outline mb-4">
                      <input type="number" class="form-control form-control-lg" id="inputNIP" placeholder="" name="nip">
                      <label for="inputNIP" class="col-sm-2 col-form-label">NIP</label>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                      <input type="username" class="form-control form-control-lg" id="inputUsername" placeholder="" name="username">
                      <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" class="form-control form-control-lg" id="inputPassword3" placeholder="" name="password">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    </div>

                    <!-- Submit button -->
                    <div class="row">
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                      </div>

                      <div class="col">
                        <?php
                        if (session()->getFlashdata('error')) {
                          echo '<div class="" style="color:red;">' . session()->getFlashdata('error') . '</div>';
                        }
                        ?>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </section>
        </form>
      </div>
    </div>

  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->


<?php $this->endSection(); ?>
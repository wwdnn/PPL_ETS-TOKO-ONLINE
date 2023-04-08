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

    <!-- <a href="#" class="profile">
      <img src="img/people.png">
    </a> -->
  </nav>
  <!-- END NAVBAR -->

  <!-- MAIN -->
  <main>
    <section class="h-100 gradient-custom">

      <?php $validation = \Config\Services::validation(); ?>

      <?php
      if (session()->getFlashdata('success')) {
        echo '<div class="alert alert-success" role="alert">';
        echo session()->getFlashdata('success');
        echo '</div>';
      }
      ?>

      <form action="/tambah-barang" method="POST" class="formCheckout" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0"> Tambah Kemeja</h5>
              </div>
              <div class="card-body">

                <div class="form-group row mt-4">
                  <label for="inputNamaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control <?= $validation->hasError('namabrg') ? 'is-invalid' : null ?>" id="inputNamaBarang" placeholder="" name="namabrg">
                    <div class="invalid-feedback">
                      <?= $validation->getError('namabrg'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : null ?>" id="inputHarga" placeholder="" name="harga">
                    <div class="invalid-feedback">
                      <?= $validation->getError('harga'); ?>
                    </div>
                  </div>


                </div>

                <div class="form-group row mt-4">
                  <label for="inputStok" class="col-sm-2 col-form-label">Stok</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : null ?>" id="inputStok" placeholder="" name="stok">
                    <div class="invalid-feedback">
                      <?= $validation->getError('stok'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <label for="inputDiskon" class="col-sm-2 col-form-label">Diskon</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control <?= $validation->hasError('diskon') ? 'is-invalid' : null ?>" id="inputDiskon" placeholder="" name="diskon">
                    <div class="invalid-feedback">
                      <?= $validation->getError('diskon'); ?>
                    </div>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <label for="inputFile" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : null ?>" id="inputFile" name="gambar" accept="image/png, image/jpeg">
                    <div class="invalid-feedback">
                      <?= $validation->getError('gambar'); ?>
                    </div>
                  </div>
                </div>

                <div class="d-inline-block mt-4">
                  <button type="submit" class="btn btn-primary btn-block btnTambah">
                    Tambah
                  </button>

                  <button type="button" class="btn btn-warning btn-block btnKembali">
                    <a href="/home" class="text-white">Kembali</a>
                  </button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </form>
    </section>


  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<?php $this->endSection(); ?>
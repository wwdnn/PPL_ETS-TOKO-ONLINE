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
    <div class="head-title">
      <div class="left">
        <h1>Pegawai 
          <?php if (session()->get('username')) : ?>
            <?= session()->get('username'); ?>
          <?php endif; ?>
        </h1>

      </div>
    </div>

    <div class="table-data">
      <div class="order">
        <div class="row mt-4">
          <div class="col-md-12">
            <a href="/tambah-barang" class="btn btn-primary">Tambah Data</a>
          </div>
        </div>

        <!-- card total barang -->
        <!-- tabled -->
        <table class="table table-striped table-bordered mt-3" id="table_id">
          <thead>
            <tr>
              <th scope="col" class="text-center">No</th>
              <th scope="col" class="text-center">Nama Barang</th>
              <th scope="col" class="text-center">Harga</th>
              <th scope="col" class="text-center">Stok</th>
              <th scope="col" class="text-center">Gambar</th>
              <th scope="col" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($barang as $key => $value) : ?>
              <tr>
                <th scope="row" class="text-center"><?= $no++; ?></th>
                <td><?= $value['namabrg']; ?></td>
                <td class="text-center">Rp <?= number_format($value['harga'], 0, ',', '.') ?></td>
                <td class="text-center"><?= $value['stok']; ?></td>
                <td class="text-center"><img src="/products/<?= $value['namafile']; ?>" alt="" width="100px" class=""></td>
                <td class="text-center">
                  <a href="/edit-barang/" class="btn btn-warning">Edit</a>
                  <a href="/hapus-barang/" class="btn btn-danger">Hapus</a>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
      </div>
    </div>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<?php $this->endSection(); ?>
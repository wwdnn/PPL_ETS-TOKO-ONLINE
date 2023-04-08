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
    <a href="<?= base_url('cart') ?>" class="notification">
      <i class='bx bx-cart'></i>
      <!-- Count -->
      <?php
      $cart = \Config\Services::cart();
      $count_cart = 0;

      if ($cart->contents()) {
        foreach ($cart->contents() as $itemProduk) {
          $count_cart = $count_cart + $itemProduk['qty'];
        }
      }
      ?>
      <span class="num"><?= $count_cart ?></span>
    </a>
    <!-- <a href="#" class="profile">
      <img src="img/people.png">
    </a> -->
  </nav>
  <!-- END NAVBAR -->

  <!-- MAIN -->
  <main>
    <div class="head-title">
      <div class="left">
        <h1>Dashboard</h1>

      </div>
    </div>

    <div class="table-data">
      <div class="order">
        <div class="row">
          <a href="/carttes">cek</a>
          <?php foreach ($barangs as $brg) : ?>
            <div class="col-md-3 py-3">
              <!-- Card Produk -->
              <form action="/cart" method="post" id="formCart_<?= $brg['idkemeja'] ?>">
                <?php

                // diskon
                $diskon = $brg['harga'] - ($brg['harga'] * $brg['diskon'] / 100);

                ?>
                <input type="hidden" name="idkemeja" value="<?= $brg['idkemeja'] ?>">
                <input type="hidden" name="namabrg" value="<?= $brg['namabrg'] ?>">
                <input type="hidden" name="harga" value="<?= $diskon?>">
                <input type="hidden" name="diskon" value="<?= $brg['diskon'] ?>">
                <input type="hidden" name="stok" value="<?= $brg['stok'] ?>">
                <input type="hidden" name="namafile" value="<?= $brg['namafile'] ?>">

                <div class="card" style="width: 15rem;">
                  <img src="./products/<?= $brg['namafile'] ?>" class="card-img-top" alt="..." style="height:200px;">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?= $brg['namabrg'] ?></h5>

                    <p class="card-text">Rp <?= number_format($diskon, 0, ',', '.'); ?></p>
                    <?php if ($brg['stok'] > 0) : ?>
                      <p class="card-text text-success">Stok Tersedia : <?= $brg['stok'] ?></p>
                    <?php else : ?>
                      <p class="card-text text-danger">Stok Habis</p>
                    <?php endif; ?>
                    <button type="submit" class="btn submitBtn" data-formid="formCart_<?= $brg['idkemeja'] ?>">Add To Cart</button>
                  </div>
                </div>
              </form>
              <!-- End Card Produk -->
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<script>
  // sweet alert if success transaction
  const alert = document.querySelector('.alert');
  if (alert) {
    Swal.fire({
      icon: 'success',
      text: 'Barang Berhasil Ditambahkan',
      showConfirmButton: false,
      customClass: {
        container: 'position-absolute'
      },
      toast: true,
      position: 'top-right',
      timer: 1500
    })
  }

  const submitBtns = document.querySelectorAll('.btn');
  submitBtns.forEach(function(submitBtn) {
    submitBtn.addEventListener('click', function(event) {
      event.preventDefault();
      const formId = this.getAttribute('data-formid');
      const form = document.getElementById(formId);
      Swal.fire({
        icon: 'success',
        text: 'Barang Berhasil Ditambahkan',
        showConfirmButton: false,
        customClass: {
          container: 'position-absolute'
        },
        toast: true,
        position: 'top-right',
        timer: 1500
      }).then(() => {
        form.submit();
      })
    });
  });
</script>

<?php $this->endSection(); ?>
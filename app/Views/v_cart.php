<?php $this->extend('v_Template'); ?>
<?php $this->section('content'); ?>

<!-- CONTENT -->
<section id="content">
  <!-- NAVBAR -->
  <nav>
    <i class='bx bx-menu'></i>
    <form action="#">
      <div class="form-input">

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
      $count_items_cart = 0;

      if ($cart->contents()) {
        foreach ($cart->contents() as $itemProduk) {
          $count_cart = $count_cart + $itemProduk['qty'];
          $count_items_cart++;
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
    <section class="h-100 gradient-custom">
        <div class="row">
          <div class="col-md-8">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0"> Checkout</h5>
              </div>
              <div class="card-body">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nama Kemeja</th>
                      <th scope="col">Harga Setelah Diskon</th>
                      <th scope="col">Jumlah Jual</th>
                      <th scope="col">Subtotal</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($carts as $cart) : ?>
                      <tr>
                        <td><?= $cart['name'] ?></td>
                        <td>Rp <?= number_format($cart['price'], 0, ',', '.') ?></td>
                        <td>
                          <input type="number" name="qty[]" value="<?= $cart['qty'] ?>" min="1" max="10" class="form-control">
                          <input type="hidden" name="rowid[]" value="<?= $cart['rowid'] ?>">
                        </td>
                        <td>Rp <?= number_format($cart['subtotal'], 0, ',', '.') ?></td>
                        <td>
                          <a href="/cart/delete/<?= $cart['rowid'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0">Summary</h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Products
                    <?php
                    $total = 0;
                    foreach ($carts as $cart) :
                      $total = $total + $cart['subtotal'];
                    endforeach;
                    ?>
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    Total Produk
                    <span><?= $count_items_cart ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Total Bayar</strong>
                    </div>
                    <span><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></span>
                  </li>
                  </ul>

                <div class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Cek Lagi Yaa!!">
                  <button type="button" class="btn btn-primary btn-lg btn-block btnCheckout">
                    <a href="/checkout" class="text-white">Checkout</a>
                  </button>
                </div>

              </div>
            </div>
          </div>
        </div>

        </div>
    </section>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<script>
  // btn delete
  const btnDelete = document.querySelectorAll('.btnDelete');
  // clear keranjang
  const clearCart = document.querySelector('.clearCart');
  // step up
  const stepUp = document.querySelectorAll('.stepUp');
  // step down
  const stepDown = document.querySelectorAll('.stepDown');
  // boolean update
  let update = false;

  // btn checkout disable when update
  const btnCheckout = document.querySelector('.btnCheckout');

  // change value cart['subtotal'] when step up
  stepUp.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      const subTotal = btn.parentNode.parentNode.querySelector('.subTotal');
      const price = btn.parentNode.parentNode.querySelector('input[type=hidden]');
      const qty = btn.parentNode.querySelector('input[type=number]');
      const total = parseInt(price.value) * parseInt(qty.value);
      update = true
      subTotal.innerHTML = `<strong>Rp ${total.toLocaleString('id-ID')}</strong>`;
      if (update) {
        btnCheckout.setAttribute('disabled', 'disabled');
        // change title tooltip
        $('[data-toggle="tooltip"]').attr('title', 'Tekan Tombol Update Terlebih Dahulu!!')
        $('[data-toggle="tooltip"]').tooltip()
      }
    })
  })

  // change value cart['subtotal'] when step down
  stepDown.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      const subTotal = btn.parentNode.parentNode.querySelector('.subTotal');
      const price = btn.parentNode.parentNode.querySelector('input[type=hidden]');
      const qty = btn.parentNode.querySelector('input[type=number]');
      const total = parseInt(price.value) * parseInt(qty.value);
      update = true;
      subTotal.innerHTML = `<strong>Rp ${total.toLocaleString('id-ID')}</strong>`;
      if (update) {
        btnCheckout.setAttribute('disabled', 'disabled');
        // when update is true, btn checkout disabled and tooltip show
        $('[data-toggle="tooltip"]').attr('title', 'Tekan Tombol Update Terlebih Dahulu!!')
        $('[data-toggle="tooltip"]').tooltip()
      }

    })
  })

  clearCart.addEventListener('click', (e) => {
    e.preventDefault();
    const href = clearCart.getAttribute('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Semua produk akan dihapus dari keranjang!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
      }
    })
  })

  btnDelete.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const href = btn.getAttribute('href');

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Produk akan dihapus dari keranjang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
        }
      })
    })
  })
</script>

<?php $this->endSection(); ?>
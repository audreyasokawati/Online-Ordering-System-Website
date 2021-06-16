<?php
  if($this->session->userdata('id_akun') == 1):
    $this->load->view('templates/v_admin');
?>

<h5>Daftar Menu</h5>
<hr>
<?php if ($this->session->flashdata('flash')) : ?>
  <div class="row mt-3">
    <div class="col-md-6">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('flash'); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
<?php endif; ?>

<div id="menu" class="menu">
  <!-- <div class="container"> -->
    <div class="row mt-2">
      <?php foreach ($menu as $m) : ?>
        <div class="col-lg-2">
          <div class="shadow p-3 mb-5 bg-white">
            <img src="<?= base_url('assets/img/menu/') . $m['foto_menu']; ?>" class="img-fluid">
            <div class="text-center mt-3">
              <h5><?= $m['nama_menu']; ?></h5>
              <p>IDR <?= number_format($m['harga_menu'],2,',','.'); ?></p>
              <?php if($m['status_menu'] == 1): ?>
                <a href="<?= base_url('corders/order/').$m['id_menu']; ?>" class="btn btn-pesan">Pesan</a>
                <?php else: ?>
                  <a href="" class="btn btn-danger disabled" >Habis</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>
</div>

<?php else: ?>

<div class="container">
 <br>

<h5>Daftar Menu</h5>
<hr>
  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
  <?php endif; ?>
</div>

<div id="menu" class="menu">
  <div class="container">
    <div class="row mt-2">
      <?php foreach ($menu as $m) : ?>
        <div class="col-lg-3">
          <div class="shadow p-3 mb-5 bg-white">
            <img src="<?= base_url('assets/img/menu/') . $m['foto_menu']; ?>" class="img-fluid">
            <div class="text-center mt-3">
              <h5><?= $m['nama_menu']; ?></h5>
              <p>IDR <?= number_format($m['harga_menu'],2,',','.'); ?></p>
              <?php if($m['status_menu'] == 1): ?>
                <a href="<?= base_url('corders/order/').$m['id_menu']; ?>" class="btn btn-pesan">Pesan</a>
              <?php else: ?>
                <a href="" class="btn btn-danger disabled" >Habis</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php endif; ?>
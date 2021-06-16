<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/bootstrap.min.css');?>">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

  <title>OOS</title>
</head>
<body class="bg-light">
  <div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">


      <!-- jika customer bisa lihat MENU, Pesanan -->
      <?php if ($this->session->userdata('customer')) : ?>
        <a class="navbar-brand" href="">Online Ordering System</a>
        <ul class="navbar-nav">

          <?php if(!$this->session->userdata('terbayar')): ?>
            <li>
              <a class="nav-link" href="<?= base_url('cmenus') ?>">Menu <span class="sr-only">(current)</span></a>
            </li>

            <li>
             <a class="nav-item nav-link" href="<?= base_url('corders/cart'); ?>">Pesanan (<span><?= $notif_pesanan; ?></span>)</a>
           </li>

        <?php else: ?>
         <li>
           <a class="nav-item nav-link active" href="<?= base_url('corders/cart/done'); ?>">Pesanan</a>
         </li>
        <?php endif; ?>

       </ul>

       <!--  Tampilan jika user belum login -->
       <?php elseif($this->session->userdata('logged_in')): ?>

        <!-- kalau admin -->
        <?php if($this->session->userdata('id_akun') == 1): ?>
          <a class="navbar-brand" href="">Online Ordering System</a>
          <ul class="navbar-nav">
            <?php if(!$this->session->userdata('terbayarAdmin')): ?>
              <li>
                <a class="nav-link" href="<?= base_url('cmenus') ?>">Menu <span class="sr-only">(current)</span></a>
              </li>

              <li>
               <a class="nav-item nav-link" href="<?= base_url('corders/cart'); ?>">Pesanan (<span><?= $notif_pesanan; ?></span>)</a>
             </li>
            <?php else: ?>
             <li>
               <a class="nav-item nav-link active" href="<?= base_url('corders/cart/done'); ?>">Pesanan</a>
             </li>
           <?php endif; ?>
          </ul>

         <!-- kalau kasir -->
        <?php endif; ?>

        <ul class="navbar-nav ml-md-auto">
          <li>
            <a class="nav-link" href="<?= base_url('cusers/logout') ?>">Logout <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <!-- Jika bukan customer hanya bisa lihat Online Ordering System -->
        <?php else: ?>
          <a class="navbar-brand" href="<?= base_url('') ?>">Online Ordering System</a>

          <ul class="navbar-nav ml-md-auto">
            <li>
              <a class="nav-link" href="<?= base_url('cusers/login') ?>">Login <span class="sr-only">(current)</span></a>
            </li>
          </ul>

        <?php endif; ?>
      </div>
    </div>
  </div>
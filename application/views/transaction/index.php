<?php
  if($this->session->userdata('id_akun') == 1){
    $this->load->view('templates/v_admin');
  }else{
    $this->load->view('templates/v_kasir');
  }
?>

<h5>Kasir</h5>
<hr>

 <!-- <br> -->
<a href="<?php   echo base_url('ckasir/index/konfirmasi') ?>" class="btn btn-primary">Konfirmasi Pembayaran</a>
<a href="<?php   echo base_url('ckasir/index/status') ?>" class="btn btn-warning">Edit Status Pesanan</a>
<a href="<?php   echo base_url('ckasir/index/histori') ?>" class="btn btn-success">Histori Transaksi</a>

<br>
<br>

<?php if($pilihan == "konfirmasi"): ?>
 <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Pembayaran</th>
        <th scope="col">Status</th>
        <th scope="col">Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $nomor = 1;
      ?>
      
      <?php foreach ($pembeli as $p): 
        if($p['status_order'] == 1){

      ?>


      <tr>
        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($p['nama_pembeli']); ?></td>
        <td><?= ucfirst($p['tanggal_order']); ?></td>
        <td><?= ucfirst($p['jenisPembayaran']); ?></td>

        <td> Menunggu Konfirmasi </td>
      
        <td>
          <a href=" <?= base_url('ckasir/updateStatus/2/').$p['id_order']; ?> " class= "badge badge-success">Terkonfirmasi</a>
        </td>
        <?php  $nomor++; ?>
      
      </tr>


      <?php 
      }
      endforeach; ?>

    </tbody>
  </table>
<?php elseif($pilihan == "status"): ?> 

 <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Status</th>
        <th scope="col">Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $nomor = 1;
      ?>
      
      <?php foreach ($pembeli as $p): 
      if($p['status_order'] == 2){

      ?>
      <tr>

        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($p['nama_pembeli']); ?></td>
        <td><?= ucfirst($p['tanggal_order']); ?></td>

        <td> Menunggu Pesanan </td>
      
        <td>
          <a href="<?= base_url('ckasir/detailOrder/').$p['id_order']; ?>" class= "badge badge-success" >Detail</a>
        </td>
        <?php  $nomor++; ?>
      
      </tr>


      <?php }
      endforeach; ?>

    </tbody>
  </table>
<?php elseif($pilihan == "histori"): ?>
  <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Status</th>
          <th scope="col">Total</th>
          <th scope="col">Detail</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $nomor = 1;
      ?>
      
      <?php foreach ($pembeli as $p): 
        if($p['status_order'] == 3){

      ?>
      <tr>

        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($p['nama_pembeli']); ?></td>
        <td><?= ucfirst($p['tanggal_order']); ?></td>

        <td> Selesai </td>
        <td>IDR <?= number_format($p['total_harga'],2,',','.'); ?></td>
        <td>
          <a href="<?= base_url('ckasir/struk/').$p['id_order'] ?>" class= "badge badge-success">Struk</a>
        </td>
        <?php  $nomor++; ?>
      
      </tr>


      <?php } endforeach; ?>

    </tbody>
  </table>
<?php endif; ?>
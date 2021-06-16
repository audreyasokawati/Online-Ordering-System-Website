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

<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $nomor = 1;
    $belumSelesai = 0;
    ?>
    
    <?php foreach ($pesanan as $p): ?>
      <tr>
        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($p['nama_menu']); ?></td>
        <td><?= ucfirst($p['jumlah_order']); ?></td>
        <td><?= ucfirst($p['subtotal_order']); ?></td>

        <?php if($p['status_detail_order'] == 1): ?>
          <td> Sedang Diproses </td>
          <td>
            <a href=" <?= base_url('ckasir/updateStatusDO_byIDO/2/').$p['id_detail_order'].'/'.$p['id_order']; ?> " class= "btn btn-success">Selesai</a>
          </td>   
          <?php $belumSelesai++; ?>
          <?php elseif($p['status_detail_order'] == 2): ?>
            <td> Selesai </td>
            <td>
              <a href="" class= "btn btn-warning disabled">Selesai</a>
            </td>
          <?php endif; ?>      
          <?php  $nomor++; ?>
        </tr>


        <?php 
      endforeach; 
      ?>


    </tbody>
  </table>
  <?php if($belumSelesai == 0): ?>
    <a href="<?= base_url('ckasir/updateStatus/3/'.$p['id_order']) ?>" class="col-lg-1 btn btn-primary mt-1 float-right">Akhiri Transaksi </a>
    <?php endif; ?>   
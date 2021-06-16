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
      </tr>
    </thead>
    <tbody>
      <?php 
        $nomor = 1;
        $total = 0;
      ?>
      
      <?php foreach ($pesanan as $p): ?>
      <tr>
        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($p['nama_menu']); ?></td>
        <td><?= ucfirst($p['jumlah_order']); ?></td>
        <td>IDR <?= number_format($p['subtotal_order'], '2', ',', '.'); ?></td> 
        <?php  $nomor++; 
          $total = $total + $p['subtotal_order'];
        ?>
      </tr>


      <?php 
      endforeach; 
      ?>
    </tbody>
      <tfoot>
      <tr>
      <th style="text-align:right;" colspan="3">Total : </th>
      <td>IDR <?php echo number_format($total, '2', ',', '.'); ?></td>
    </tr>
   </tfoot>
  </table>
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
<a href="<?php   echo base_url('ccodes/generateCode') ?>" class="btn btn-primary">Generate Code</a>
<a href="<?php   echo base_url('ccodes/index/') ?>" class="btn btn-success">Tersedia</a>
<a href="<?php   echo base_url('ccodes/index/terpakai') ?>" class="btn btn-danger">Sudah Terpakai</a>

<br>
<br>

<?php if($pilihan == "tersedia"): ?>
 <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Kode</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $nomor = 1;
      ?>
      
      <?php foreach ($code as $c): 
        if($c['statusKode'] == 0){

        ?>

      <tr>
        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($c['kodeUnik']); ?></td>
        <td><?= ucfirst($c['statusKode']); ?></td>

        <?php  $nomor++; ?>
      
      </tr>


      <?php } endforeach; ?>

    </tbody>
  </table>
<?php else: ?>
<table class="table table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Kode</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $nomor = 1;
      ?>
      
      <?php foreach ($code as $c): 
        if($c['statusKode'] == 1){


        ?>

      <tr>
        <th><?php echo $nomor; ?></th>

        <td><?= ucfirst($c['kodeUnik']); ?></td>
        <td><?= ucfirst($c['statusKode']); ?></td>

        <?php  $nomor++; ?>
      
      </tr>


      <?php } endforeach; ?>

    </tbody>
  </table>
<?php endif; ?>
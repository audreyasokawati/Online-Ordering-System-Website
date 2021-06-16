<?php
  $this->load->view('templates/v_admin');
?>

<?php echo validation_errors(); ?>


<h5>List Menu</h5>
<hr>
<table class="table table-bordered table-hover">
  <thead class="text-center">
    <tr>
      <th>No</th>
      <th>Menu</th>
      <th>Harga</th>
      <th>Kategori</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($menu as $m) {
      # code...
     ?>
    <tr class="text-center">
      <td><?php echo $no++; ?></td>
      <td><?php echo $m['nama_menu']; ?></td>
      <td>IDR <?php echo number_format($m['harga_menu']); ?></td>
      <td><img src="<?= base_url('assets/img/menu/') . $m['foto_menu']; ?>"  class="card-img" style="width:200px;"></td>
      <td>
        <?php if($m['status_menu'] == 1): ?>
        Tersedia
        <?php else: ?>
        Tidak Tersedia
        <?php endif; ?>  
      </td>
      <td>
        <a href="<?= base_url('cmenus/edit/'). $m['id_menu']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
        <a href="<?= base_url('cmenus/delete/'). $m['id_menu']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" ></i> Hapus</a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<a href="<?= base_url('cmenus/create')?>" class="btn btn-primary">Tambah Menu</a>


      </section>
    </main>
  </div>
</div>
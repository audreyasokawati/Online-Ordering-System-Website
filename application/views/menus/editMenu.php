<?php
$this->load->view('templates/v_admin');
?>

<h5>Edit Menu</h5>
<hr>
<?php echo validation_errors();?>

<form action=" <?= base_url('cmenus/update/').$menu['id_menu']; ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama Menu</label>
    <input type="text" name="namaM" class="form-control" value="<?= $menu['nama_menu']; ?> ">
  </div>
  <div class="form-group">
    <label>Kategori Menu</label>
    <select class="form-control" name="kategoriM">
      <option <?php if( $menu['kategori_menu']=='1'){echo "selected"; } ?> value="1">Makanan</option>
      <option <?php if( $menu['kategori_menu']=='2'){echo "selected"; } ?> value="2">Minuman</option>
    </select>
  </div>
  <div class="form-group">
    <label>Harga Menu</label>
    <input type="number" name="hargaM" class="form-control" value="<?= number_format($menu['harga_menu']); ?> ">
  </div>
  <div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="userfile" size="20">
  </div>
  <div class="form-group">
    <label>Status Menu</label>
    <select class="form-control" name="statusM">
      <option <?php if( $menu['status_menu']=='1'){echo "selected"; } ?> value="1">Tersedia</option>
      <option <?php if( $menu['status_menu']=='0'){echo "selected"; } ?> value="0">Kosong</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" name="save">Edit</button>
</form>

<?php
$this->load->view('templates/v_admin');
?>
<?php echo validation_errors();?>

<h5>Tambah Menu</h5>
<hr>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Menu</label>
      <input type="text" name="namaM" class="form-control">
    </div>
    <div class="form-group">
      <label>Kategori Menu</label>
      <select class="form-control" name="kategoriM">
        <option value="1">Makanan</option>
        <option value="2">Minuman</option>
      </select>
    </div>
    <div class="form-group">
      <label>Harga Menu</label>
      <input type="number" name="hargaM" class="form-control">
    </div>
    <div class="form-group">
      <label>Upload Image</label>
      <input type="file" name="userfile" size="20">
    </div>
    <div class="form-group">
      <label>Status Menu</label>
      <select class="form-control" name="statusM">
        <option value="1">Tersedia</option>
        <option value="0">Kosong</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="save">Tambah</button>
  </form>
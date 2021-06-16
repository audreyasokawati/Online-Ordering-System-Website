<?php
  $this->load->view('templates/v_admin');
?>
<h5>List User</h5>
<hr>
<div class="row">
<div class="col-md-8">
  <table class="table table-bordered table-hover text-center">
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Hak Akses</th>
        <th>Opsi</th>
      </tr>
    </thead>
    <tbody>

      <?php $no=1;
      foreach ($users as $a) {
        # code...
      
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $a['username']; ?></td>
        <td><?php echo $a['password']; ?></td>
        <td><?php echo $a['jabatan']; ?></td>
        <td class="text-center">
          <a href="<?= base_url('cusers/edit/'). $a['id_user']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('cusers/delete/'). $a['id_user']; ?>" class="btn btn-danger"><i class="fa fa-trash fa-1x"></i></a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
<div class="col-md-4">

  <h5>Aksi</h5>
  <hr>
  <?php echo validation_errors(); ?>
  <?php if ($pilihan == "edit"): ?>
    <form method="post" action="<?= base_url('cusers/edit/').$user['id_user']; ?>">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $user['username']; ?> ">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control" value="<?= $user['password']; ?> ">
      </div>
      <div class="form-group">
        <label>Hak Akses</label>
        <select class="form-control" name="hak_akses">
            <option>-- Pilih Hak Akses --</option>
            <option <?php if( $user['id_akun']=='1'){echo "selected"; } ?> value="1">Admin</option>
            <option <?php if( $user['id_akun']=='2'){echo "selected"; } ?> value="2">Kasir</option>
        </select>
      </div>
      <button type="submit" name="save" class="btn btn-success">Save</button>
    </form>
  <?php else: ?>
    <form method="post" action="<?= base_url('cusers/create') ?>">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <label>Hak Akses</label>
        <select class="form-control" name="hak_akses">
            <option value="1">Admin</option>
            <option value="2">Kasir</option>
        </select>
      </div>
      <button type="submit" name="save" class="btn btn-success">Save</button>
    </form>

  <?php endif; ?>

</div>
</div>

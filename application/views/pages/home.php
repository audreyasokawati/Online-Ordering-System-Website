<div class="container">
  
<?php echo validation_errors();?>

<!-- FLASH MESSAGE -->
<?php if ($this->session->flashdata('failed')) : ?>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('failed'); ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('customer_done')) : ?>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('customer_done'); ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

</div>
<!-- End Flash Message -->

<!-- Carousel -->
<div id="carouselExampleFade" class="carousel slide carousel-fade bg-light" data-ride="carousel">
  <div class="container">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-5">
            <h4>Selamat datang di program <br>System Order Online</h4>
            <p>Silahkan pilih menu dan lakukan pemesanan tanpa harus mengantri!</p>
            <!-- <a href="<?= base_url('menu'); ?>" class="btn btn-order">Order Now <i class="fas fa-arrow-right ml-3"></i></a> -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-order" data-toggle="modal" data-target="#formEntryCode">
              Order Now!<i class="fas fa-arrow-right ml-3"></i>
            </button>
          </div>
          <div class="col-lg-5 d-flex justify-content-end">
            <div class="img-bg">
              <!-- <img src="<?= base_url('assets/img/coffee-machine.png'); ?>"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Carousel -->


<!-- Modal -->
<div class="modal fade" id="formEntryCode" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Form Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('cOrders/entrycode') ?>" method="POST"> 

      	<div class="form-group">
			    <label for="nama">Nama</label>
			    <input type="text" class="form-control" id="nama" name="nama">
			  </div>

      	<div class="form-group">
			    <label for="kode">Kode</label>
			    <input type="text" class="form-control" id="kode" name="kode">
			  </div>
        
        <div class="form-group">
          <label for="noMeja">Nomor Meja</label>
          <select class="form-control" name="noMeja">
            <?php for($i = 1; $i <= 10; $i++){ ?>
            <option value="<?php echo $i; ?>">
                <?php echo $i; ?>
            </option> 
            <?php } ?>
          </select>
        </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Lanjutkan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>
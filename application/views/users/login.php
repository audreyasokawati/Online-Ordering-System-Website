<div class="container">
	
<?php echo validation_errors(); ?>
<!-- Buka form  -->
<?php echo form_open('cusers/login'); ?>
<!-- Form dikirim ke controller users dan login function -->
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<!-- LOGIN PAGE  -->
	<div class="row">
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<h1 class="text-center"> <strong><?php echo $title; ?></strong></h1>
			<?php if ($this->session->flashdata('login_failed')) : ?>
			  <div class="row mt-3">
			      <div class="col">
			          <div class="alert alert-warning alert-dismissible fade show" role="alert">
			              <?= $this->session->flashdata('login_failed'); ?>
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			              </button>
			          </div>
			      </div>
			  </div>
			<?php endif; ?>
			<br>
			<div class="form-group">
				<strong>Username</strong>
				<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
			</div>
			<div class="form-group">
				<strong>Password</strong>
				<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
			</div>

			<button type="submit" class="btn btn-primary btn-block">Login</button>
		</div>
	</div>

<!-- Tutup Form -->
<?php echo form_close(); ?>
</div>
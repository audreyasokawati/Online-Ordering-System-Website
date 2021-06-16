<?php if($this->session->userdata('id_akun') == 1):
  $this->load->view('templates/v_admin');
  ?>
      <br>
      <!-- FLASH MESSAGE -->
      <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-5">
          <div class="col-md-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('flash'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      <?php endif; ?>

    <!-- cart admin -->
      <?php if($pilihan == "cart"): ?>
        <div id="pesanan" class="pesanan">
          <div class="row mt-5">
            <div class="col-lg-7 pr-5">
              <h5 class="pesanan-anda">Pesanan Anda</h5>
              
        
              <?php if ( !$pesanan ): ?>
                <div class="row justify-content-center">
                  <div class="card bg-light">
                    <h3 class="mt-5 mb-5">Belum ada pesanan.</h3>
                  </div>
                </div>
              <?php else: ?>
                <div class="list-pesanan">
                  <?php foreach ($pesanan as $p) : ?>
                    <div class="row">
                      <div class="card" style="width: 100%">
                        <div class="row no-gutters">
                          <div class="card-body">
                            <div class="row">
                              
                              <div class="col-lg-2">
                                <img src="<?= base_url('assets/img/menu/') . $p['foto_menu']; ?>"  class="card-img">
                              </div>
                              
                              <div class="col-lg-3 d-flex align-items-center">
                                <div class="item">
                                  <h5 class="card-title"><?= $p['nama_menu']; ?></h5>
                                  <p class="card-text"><small class="text-muted">IDR <?= number_format($p['harga_menu'],2,',','.'); ?></small></p>
                                </div>
                              </div>
                              
                              <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                <div class="qty">
                                  <span class="input-group-btn">
                                    <a href="<?= base_url('corders/kurang/') . $p['id_detail_order']; ?>" class="btn-qty">
                                      <i class="fas fa-minus"></i>
                                    </a>
                                  </span>
                                  <input type="text" min="1" max="100" class="input-qty" value="<?= $p['jumlah_order']; ?>" disabled>
                                  <span class="input-group-btn">
                                    <a href="<?= base_url('corders/tambah/') . $p['id_detail_order']; ?>" class="btn-qty">
                                      <i class="fas fa-plus"></i>
                                    </a>
                                  </span>
                                </div>
                              </div>
                              
                              <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                <div class="subtotal_order">
                                  <span class="subtotal_order-item">IDR <?= number_format($p['subtotal_order'],2,',','.'); ?></span>
                                </div>
                              </div>
                              
                              <div class="col-lg-1 d-flex align-items-center justify-content-end">
                                <a href="<?= base_url('corders/deleteDetailOrder/') . $p['id_detail_order']; ?>" class="btn-delete"><i class="fas fa-lg fa-times"></i></a>
                              </div>
                            </div>

                            <hr style="margin-top: 15px;">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>


            <div class="col-lg-2">
              <div class="card shadow bg-dark text-white info-bayar" style="width: 100%; padding-left: 10px; padding-right: 10px;">
                <div class="row">
                  <h5 class="info-bayar-title">Informasi Pembayaran</h5>
                </div>
                <hr>
                <?php if ( !$pesanan ): ?>
                  <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                      <div class="item mb-2">
                        <p>Belum ada pesanan.</p>
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                  <?php foreach ($pesanan as $psn): ?>
                    <div class="row">
                      <div class="col d-flex align-items-center">
                        <div class="item">
                          <h6><?= $psn['nama_menu']; ?></h6>
                          <p style="margin-top: -8px;"><?= $psn['jumlah_order']; ?></p>
                        </div>
                      </div>
                      <div class="col d-flex align-items-center justify-content-end">
                        <p>IDR <?= number_format($psn['subtotal_order'],2,',','.'); ?></p>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <hr style="background-color: rgba(255,255,255,0.4);">
                <div class="row" style="font-weight: 600;">
                  <div class="col-4">
                    <div class="item">
                      <h6 style="font-weight: 600;">Total</h6>
                    </div>
                  </div>
                  <div class="col text-right">

                      <?php if ( !$pesanan ): ?>
                        <p style="font-size: 1rem;">-</p>
                        <?php else: ?>
                          <p style="font-size: 0.9rem;">IDR <?= number_format($total_bayar,2,',','.'); ?></p>
                        <?php endif; ?>

                      </div>
                    </div>
                    <?php if ( !$pesanan ): ?>
                      <?php else: ?>
                        <div class="row">
                          <div class="col mb-3 mt-1">
                            <a href="<?= base_url('corders/bayar/') . $this->session->userdata('id_order').'/1'; ?>" class="btn btn-pesan text-uppercase" data-toggle="modal" data-target="#formPembayaran" style="width: 100%;">Bayar</a>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- </div> -->
              </div>
              <!-- End Pesanan -->

            </div>
          </div>
        </div>

    <!-- cart done admin -->
      <?php elseif($pilihan == "cartDone"): ?> 
       <!-- Pesanan -->
      <div id="pesanan" class="pesanan">
        <div class="row mt-5">
          <div class="col-lg-8 pr-5">
            <h5 class="pesanan-anda">Pesanan Anda</h5>
            <?php if ( !$pesanan ): ?>
              <div class="row justify-content-center">
                <div class="card">
                  <h3 class="mt-5 mb-5">Belum ada pesanan.</h3>
                </div>
              </div>
            <?php else: ?>
              <div class="list-pesanan">
                <?php foreach ($pesanan as $p) : 
                  if($p['status_detail_order'] != 0 && $p['status_detail_order'] < 3 ):
                ?>
                  <div class="row">
                    <div class="card" style="width: 100%">
                      <div class="row no-gutters">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-2">
                              <img src="<?= base_url('assets/img/menu/') . $p['foto_menu']; ?>"  class="card-img">
                            </div>
                            <div class="col-lg-3 d-flex align-items-center">
                              <div class="item">
                                <h5 class="card-title"><?= $p['nama_menu']; ?></h5>
                                <p class="card-text"><small class="text-muted">IDR <?= number_format($p['harga_menu'],2,',','.'); ?></small></p>
                              </div>
                            </div>
                            <div class="col-lg-1 d-flex align-items-center justify-content-end">
                              <span>
                                Qty:  
                                <?= 
                                $p['jumlah_order']; 
                                ?>
                              </span> 
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                              <div class="subtotal_order">
                                <span class="subtotal_order-item">IDR <?= number_format($p['subtotal_order'],2,',','.'); ?></span>
                              </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                              <?php if($p['status_detail_order'] == 1): ?>
                                <!-- <h5 class="card-text">Sedang Dibuat</h5> -->
                                <span class="subtotal_order-item">Sedang Dibuat</span>
                                <?php elseif($p['status_detail_order'] == 2): ?>
                                  <span class="subtotal_order-item">Selesai</span>
                                <?php endif; ?>
                                <!--  -->
                              </div>
                            </div>
                            <hr style="margin-top: 15px;">
                          </div>
                        </div>
                      </div>
                    </div>
                <?php endif; 
                  endforeach; ?>
              </div>
              <a href="<?= base_url('corders/done/'.$p['id_order'].'/3') ?>" class="col-lg-3 btn btn-warning mt-3 float-right">Keluar</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      
      <?php endif; ?>
      </section>
    </main>
  </div>
</div>

<?php else: ?>
  <div class="container">
    <br>

    <br>
    <!-- FLASH MESSAGE -->
    <?php if ($this->session->flashdata('flash')) : ?>
      <div class="row mt-3">
        <div class="col-md-9">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if($pilihan == "cart"): ?> 
      <!-- Pesanan -->
      <div id="pesanan" class="pesanan">
        <div class="container">
          <div class="row mt-5">
            <div class="col-lg-9 pr-5">
              <h5 class="pesanan-anda">Pesanan Anda</h5>
              <?php if ( !$pesanan ): ?>
                <div class="row justify-content-center">
                  <div class="card bg-light">
                    <h3 class="mt-5 mb-5">Belum ada pesanan.</h3>
                  </div>
                </div>
              <?php else: ?>
                <div class="list-pesanan">
                  <?php foreach ($pesanan as $p) : ?>
                    <div class="row">
                      <div class="card" style="width: 100%">
                        <div class="row no-gutters">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-2">
                                <img src="<?= base_url('assets/img/menu/') . $p['foto_menu']; ?>"  class="card-img">
                              </div>
                              <div class="col-lg-3 d-flex align-items-center">
                                <div class="item">
                                  <h5 class="card-title"><?= $p['nama_menu']; ?></h5>
                                  <p class="card-text"><small class="text-muted">IDR <?= number_format($p['harga_menu'],2,',','.'); ?></small></p>
                                </div>
                              </div>
                              <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                <div class="qty">
                                  <span class="input-group-btn">
                                    <a href="<?= base_url('corders/kurang/') . $p['id_detail_order']; ?>" class="btn-qty">
                                      <i class="fas fa-minus"></i>
                                    </a>
                                  </span>
                                  <input type="text" min="1" max="100" class="input-qty" value="<?= $p['jumlah_order']; ?>" disabled>
                                  <span class="input-group-btn">
                                    <a href="<?= base_url('corders/tambah/') . $p['id_detail_order']; ?>" class="btn-qty">
                                      <i class="fas fa-plus"></i>
                                    </a>
                                  </span>
                                </div>
                              </div>
                              <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                <div class="subtotal_order">
                                  <span class="subtotal_order-item">IDR <?= number_format($p['subtotal_order'],2,',','.'); ?></span>
                                </div>
                              </div>
                              <div class="col-lg-1 d-flex align-items-center justify-content-end">
                                <a href="<?= base_url('corders/deleteDetailOrder/') . $p['id_detail_order']; ?>" class="btn-delete"><i class="fas fa-lg fa-times"></i></a>
                              </div>
                            </div>
                            <hr style="margin-top: 15px;">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>


            <div class="col-lg-3">
              <div class="card shadow bg-dark text-white info-bayar" style="width: 100%; padding-left: 10px; padding-right: 10px;">
                <div class="row">
                  <h5 class="info-bayar-title">Informasi Pembayaran</h5>
                </div>
                <hr>
                <?php if ( !$pesanan ): ?>
                  <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                      <div class="item mb-2">
                        <p>Belum ada pesanan.</p>
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                  <?php foreach ($pesanan as $psn): ?>
                    <div class="row">
                      <div class="col d-flex align-items-center">
                        <div class="item">
                          <h6><?= $psn['nama_menu']; ?></h6>
                          <p style="margin-top: -8px;"><?= $psn['jumlah_order']; ?></p>
                        </div>
                      </div>
                      <div class="col d-flex align-items-center justify-content-end">
                        <p>IDR <?= number_format($psn['subtotal_order'],2,',','.'); ?></p>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <hr style="background-color: rgba(255,255,255,0.4);">
                <div class="row" style="font-weight: 600;">
                  <div class="col-4">
                    <div class="item">
                      <h6 style="font-weight: 600;">Total</h6>
                    </div>
                  </div>
                  <div class="col text-right">

                    <?php if ( !$pesanan ): ?>
                      <p style="font-size: 1rem;">-</p>
                    <?php else: ?>
                      <p style="font-size: 0.9rem;">IDR <?= number_format($total_bayar,2,',','.'); ?></p>
                    <?php endif; ?>

                  </div>
                </div>
                <?php if ( !$pesanan ): ?>
                <?php else: ?>
                  <div class="row">
                    <div class="col mb-3 mt-1">
                      <a href="" class="btn btn-pesan text-uppercase" data-toggle="modal" data-target="#formPembayaran" style="width: 100%;">Bayar</a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php elseif($pilihan == "cartDone"): ?> 

     <!-- Pesanan -->
      <div id="pesanan" class="pesanan">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 pr-5">
              <h5 class="pesanan-anda">Struk Anda</h5>
              <hr>
              <?php if ( !$pesanan ): ?>
                <div class="row justify-content-center">
                  <div class="card">
                    <h3 class="mt-5 mb-5">Belum ada pesanan.</h3>
                  </div>
                </div>
              <?php else: ?>
                <div class="list-pesanan">
                  <?php foreach ($pesanan as $p) : 
                    if($p['status_detail_order'] != 0):
                  ?>
                  <div class="row">
                    <div class="card" style="width: 100%">
                      <div class="row no-gutters">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-2">
                              <img src="<?= base_url('assets/img/menu/') . $p['foto_menu']; ?>"  class="card-img">
                            </div>
                            <div class="col-lg-3 d-flex align-items-center">
                              <div class="item">
                                <h5 class="card-title"><?= $p['nama_menu']; ?></h5>
                                <p class="card-text"><small class="text-muted">IDR <?= number_format($p['harga_menu'],2,',','.'); ?></small></p>
                              </div>
                            </div>
                            <div class="col-lg-1 d-flex align-items-center justify-content-end">
                              <span>
                                Qty:  
                                <?= 
                                $p['jumlah_order']; 
                                ?>
                              </span> 
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                              <div class="subtotal_order">
                                <span class="subtotal_order-item">IDR <?= number_format($p['subtotal_order'],2,',','.'); ?></span>
                              </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                              <?php if($p['status_detail_order'] == 1): ?>
                                <!-- <h5 class="card-text">Sedang Dibuat</h5> -->
                                <span class="subtotal_order-item">Sedang Dibuat</span>
                                <?php elseif($p['status_detail_order'] == 2): ?>
                                  <span class="subtotal_order-item">Selesai</span>
                                <?php endif; ?>
                                <!--  -->
                              </div>
                            </div>
                            <hr style="margin-top: 15px;">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif;
                  endforeach; ?>
                </div>
              <?php endif; ?>
              <a href="<?= base_url('corders/done/'.$p['id_order'].'/3') ?>" class="col-lg-3 btn btn-warning mt-3 float-right">Keluar</a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="formPembayaran" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Form Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('corders/bayar/') . $this->session->userdata('id_order').'/1'; ?>" method="POST"> 

        <h5>Total Pembayaran:  IDR <?= number_format($total_bayar,2,',','.'); ?></h5>
        
        <div class="form-group">
          <label for="pembayaran">Jenis Pembayaran</label>
          <select class="form-control" name="pembayaran">
           <option value="CASH">Cash</option>
            <option value="DEBIT">Debit</option>
          </select>
        </div>
        <p>Keterangan Pembayaran: 
        <br>
        - Debit melalui Virtual Account BCA : 2231123102 
        <br>
        - Cash melalui Pelayan 
        <br>
        </p>
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Lanjutkan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>
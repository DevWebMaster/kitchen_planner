<div class="form-background" >
  <div class="login-box">
    
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo">
          <h2><a href="<?= base_url('admin'); ?>"><img border=0 src="<?= base_url()?>assets/dist/img/logo.png"></a></h2>
        </div>

        <p class="login-box-msg"><?= trans('l_auth_login_msg') ?></p>

        <?php $this->load->view('admin/includes/_messages.php') ?>
        
        <?php echo form_open(base_url('admin/auth/login'), 'class="login-form" '); ?>
          <div class="form-group has-feedback">
            <input type="text" name="username" id="name" class="form-control" placeholder="<?= trans('username') ?>" >
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="<?= trans('password') ?>" >
          </div>
          <div class="row">
            <div class="col-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> <?= trans('remember_me') ?>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="<?= trans('signin') ?>">
            </div>
            <!-- /.col -->
          </div>
        <?php echo form_close(); ?>

        <p class="mb-1">
          <a href="<?= base_url('admin/auth/forgot_password'); ?>"><small><?= trans('i_forgot_my_password') ?></small></a>
        </p>
        <p class="mb-0">
          <a href="<?= base_url('admin/auth/register'); ?>" class="text-center"><small><?= trans('register_new_membership') ?></small></a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</div>
<script>          
var images = ['bg_login_01.jpg', 'bg_login_02.jpg', 'bg_login_03.jpg', 'bg_login_04.jpg', 'bg_login_05.jpg'];
$('.bg-cover').css({'background-image': 'url(<?= base_url()?>assets/dist/img/auth/' + images[Math.floor(Math.random() * images.length)] + '),linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6) '});
</script>>

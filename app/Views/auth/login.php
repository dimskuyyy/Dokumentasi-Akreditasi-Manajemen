<?php
helper(['form']);
?>
<?= $this->extend('layout/login') ?>

<?= $this->section('title') ?>
Website - Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-box" style="width: 100%;display:flex;flex-direction: column; align-items: center;">
    <div>
        <img src="<?=base_url('img/LOGO-UNRI.png')?>" alt="Logo Unri" style="height: 120px;margin-bottom: 12px; margin-right:1rem">
        <img src="<?=base_url('img/logo_feb.png')?>" alt="Logo FEB UNRI" style="height: 120px;margin-bottom: 12px;">
    </div>
    <div class="login-logo" style="font-size: 28px;">
        <a href="#"><b>Pendataan Dokumen Bukti Akreditasi<br> Program Studi S2 Ilmu Ekonomi<br>Jurusan Ilmu Ekonomi <br>Fakultas Ekonomi dan Bisnis Universitas Riau</b></a>
        <!-- <div style="font-size:15px; font-weight:bolder;">JURUSAN TEKNIK INFORMATIKA<br>UNIVERSITAS MUHAMMADIYAH RIAU</div> -->
    </div>
    <div class="login-box-body" style="width: 90%; max-width:500px">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php echo form_open('login-do', ['class' => 'form-login']); ?>
        <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <i class="fa fa-user form-control-feedback" aria-hidden="true"></i>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <i class="fa fa-lock form-control-feedback"></i>
        </div>
        <div class="row">
            <div class="col-xs-8"></div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat btn-submit">Sign In</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php //echo password_hash('admin',PASSWORD_BCRYPT); 
?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $('.form-login').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = form.find('.btn-submit');
        var htm = btn.html();
        setLoadingBtn(btn);
        $.ajax({
            url: base_url + 'wbpanel/login-do',
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(result) {
                if (result.status) {
                    successMsg(result.msg);
                    location.reload();
                } else {
                    errorMsg(result.msg);
                    resetLoadingBtn(btn, htm);
                }
            },
            error: function(xhr, status, error) {
                errorMsg(error);
                resetLoadingBtn(btn, htm);
            }
        });
    });
</script>
<?= $this->endSection() ?>
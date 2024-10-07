<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('title') ?>
User
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Profile
    </h1>
</section>
<?= $this->endsection() ?>
<?php
helper(['form']);
?>
<?= $this->section('content') ?>
<div class="box box-widget">
    <div class="box-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#detail-profile" aria-controls="detail-profile" role="tab" data-toggle="tab">Detail Profile</a></li>
                <li role="presentation"><a href="#edit-profile" aria-controls="edit-profile" role="tab" data-toggle="tab">Edit Profile</a></li>
                <li role="presentation"><a href="#ubah-password" aria-controls="ubah-password" role="tab" data-toggle="tab">Ubah Password</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 3rem;">
                <div role="tabpanel" class="tab-pane active" id="detail-profile">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td class="info"><strong>Nama User</strong></td>
                                <td class="active"><?=$data['user_nama']?></td>
                            </tr>
                            <tr>
                                <td class="info"><strong>Username</strong></td>
                                <td class="active"><?=$data['user_username']?></td>
                            </tr>
                            <tr>
                                <td class="info"><strong>Tipe</strong></td>
                                <td class="active"><?=AuthUser()->type_nama?></td>
                            </tr>
                            <tr>
                                <td class="info"><strong>Status</strong></td>
                                <td class="active"><?=$data['user_status'] == 2 ? 'Aktif' : 'Tidak Aktif'?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="edit-profile">
                    <?php echo form_open('#', ['class' => 'form-user']);
                    if (isset($data)) {
                        echo form_hidden('id', $data['user_id']);
                    }
                    ?>
                    <div class="form-group" id="form-nama">
                        <label for='nama'>Nama User</label>
                        <input type="text" name="nama" class="form-control" value="<?= isset($data) ? $data['user_nama'] : '' ?>" required id="nama" placeholder="Masukkan Nama ...">
                    </div>
                    <div class="form-group" id="form-username">
                        <label for='username'>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= isset($data) ? $data['user_username'] : '' ?>" required id="username" placeholder="Masukkan Username ...">
                    </div>
                    <div class="modal-footer set-submit">
                        <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="ubah-password">
                    <?php echo form_open('#', ['class' => 'form-user-password']);
                    if (isset($data)) {
                        echo form_hidden('id', $data['user_id']);
                    }
                    ?>
                    <div class="form-group" id="form-password">
                        <label for='oldPassword'>Password Saat ini</label>
                        <input type="password" name="oldPassword" class="form-control" required id="oldPassword" placeholder="Masukkan password saat ini ...">
                    </div>
                    <div class="form-group" id="form-password">
                        <label for='password'>Password Baru</label>
                        <input type="password" name="password" class="form-control" required id="password" placeholder="Masukkan password baru ...">
                    </div>
                    <div class="form-group" id="form-confirm">
                        <label for='confirm_password'>Confirm Password Baru</label>
                        <input type="password" name="confirm_password" class="form-control" required id="confirm_password" placeholder="Masukkan konfirmasi password baru ...">
                    </div>
                    <div class="modal-footer set-submit">
                        <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    $('#myTabs a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('.form-user').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = form.find('.btn-submit');
        var htm = btn.html();
        setLoadingBtn(btn);
        $.ajax({
            url: base_url + '/user/save',
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(res) {
                if (res.status) {
                    successMsg(res.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 800)
                } else {
                    errorMsg(res.msg);
                }
                resetLoadingBtn(btn, htm);
            },
            error: function(xhr, status, error) {
                resetLoadingBtn(btn, htm);
                errorMsg(error);
            }
        })
    });

    $('.form-user-password').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = form.find('.btn-submit');
        var htm = btn.html();
        setLoadingBtn(btn);
        $.ajax({
            url: base_url + '/user/save',
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(res) {
                if (res.status) {
                    successMsg(res.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 800)
                } else {
                    errorMsg(res.msg);
                }
                resetLoadingBtn(btn, htm);
            },
            error: function(xhr, status, error) {
                resetLoadingBtn(btn, htm);
                errorMsg(error);
            }
        })
    });
</script>
<?= $this->endsection() ?>

<?= $this->section('plugin_css') ?>
<?php datatableCss() ?>
<?= $this->endsection() ?>

<?= $this->section('plugin_js') ?>
<?php datatableJs() ?>
<?= $this->endsection() ?>
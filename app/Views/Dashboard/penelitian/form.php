<?php

use Config\Services;

helper(['form']);
$encrypter = Services::encrypter();
?>
<div class="box box-widget">
    <div class="box-body">
        <div class="pull-left">
            <button class="btn btn-sm btn-flat btn-primary btn-list"><i class="fa fa-list"></i> List Penelitian</button>
        </div><br><br>
        <?php echo form_open('#', ['class' => 'form-post']);
        if (isset($data)) {
            echo form_hidden('id', $data['proyek_id']);
        }
        ?>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for='judul'>Judul Penelitian</label><br>
                        <input type="text" name="judul" class="form-control" value="<?= isset($data) ? $data['proyek_judul'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='sebagai'>Peran Penelitian</label><br>
                        <select name="sebagai" class="form-control select-mod select2">
                            <?php
                            $sebagai = ['Ketua', 'Anggota'];

                            ?>
                            <?php foreach ($sebagai as $row) : ?>
                                <?php
                                if (isset($data) && $data['proyek_sebagai'] == $row) : ?>
                                    <option value="<?= $row ?>" selected><?= $row ?></option>
                                <?php else : ?>
                                    <option value="<?= $row ?>"><?= $row ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for='tahapan'>Tahapan Penelitian</label><br>
                        <select name="tahapan" class="form-control select-mod select2" id="tahapan">
                            <?php
                            $tahapan = ['Proses', 'Terbit'];

                            ?>
                            <?php foreach ($tahapan as $row) : ?>
                                <?php
                                if (isset($data) && $data['proyek_tahapan'] == $row) : ?>
                                    <option value="<?= $row ?>" selected><?= $row ?></option>
                                <?php else : ?>
                                    <option value="<?= $row ?>"><?= $row ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group" id="artikel-input" <?= isset($data) && $data['proyek_tahapan'] != 'Terbit' ? 'hidden' : '' ?>>
                        <label for='artikel'>Link Artikel (Jika Terbit) </label><br>
                        <input type="url" name="artikel" class="form-control" value="<?= isset($data) ? $data['proyek_artikel'] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-close-form" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>js/wbpanel.js"></script>
<script>
    let placeholder = "<?= base_url('img/front/placeholder/180x180.png') ?>";
</script>
<script>
    $(document).ready(function() {
        function changeArtikel(tahapan){
            tahapan == 'Terbit' ? $('#artikel-input').removeAttr('hidden') : $('#artikel-input').prop('hidden',true);
            tahapan == 'Terbit' ? $('#artikel-input input').removeAttr('disabled') : $('#artikel-input input').prop('disabled',true);
        }

        changeArtikel('Proses');

        $('#tahapan').change(function(e){
            e.preventDefault();
            let tahapan = $(this).find(':selected').attr('value');
            changeArtikel(tahapan);
        })

        $('.form-post').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');
            var htm = btn.html();
            setLoadingBtn(btn);
            var formData = new FormData(form[0]);
            $.ajax({
                url: base_url + '/penelitian/save',
                type: 'post',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status) {
                        successMsg(res.msg);
                        form[0].reset();
                        loadData();
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

        // Select 2
        $('.btn-list,.btn-close-form').click(function(e) {
            e.preventDefault();
            loadData();
        });

        $('.select-mod').select2({
            language: 'id'
        });


       
    });
</script>
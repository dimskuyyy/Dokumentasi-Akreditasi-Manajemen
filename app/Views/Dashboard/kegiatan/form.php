<?php

use Config\Services;

helper(['form']);
$encrypter = Services::encrypter();
?>
<div class="box box-widget">
    <div class="box-body">
        <div class="pull-left">
            <button class="btn btn-sm btn-flat btn-primary btn-list"><i class="fa fa-list"></i> List Kegiatan</button>
        </div><br><br>
        <?php echo form_open('#', ['class' => 'form-post']);
        if (isset($data)) {
            echo form_hidden('id', $data['agenda_id']);
        }
        ?>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for='nama'>Nama Kegiatan</label><br>
                        <input type="text" name="nama" class="form-control" value="<?= isset($data) ? $data['agenda_nama'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='sebagai'>Peran Sebagai</label><br>
                        <input type="text" name="sebagai" class="form-control" value="<?= isset($data) ? $data['agenda_sebagai'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='media'>Media</label><br>
                        <div class="choose-media">
                            <a href="#" class="btn btn-sm btn-flat btn-primary btn-media" data-backdrop="static"><i class="fa fa-plus"></i> Pilih Media <span id="text-optional"></span></a>
                            <button type="button" class="btn btn-default btn-flat btn-sm btn-reset-media"><i class="fa fa-recycle" aria-hidden="true"></i></button>
                        </div>
                        <input type="hidden" name="media" id="media-id" value="<?= isset($data) ? $data['agenda_media_id'] : '' ?>">
                        <div class="source-media">
                            <?php if (isset($media)) {
                                if (stripos($media[0]['media_type'], 'image') !== false) {
                            ?>
                                    <img id="media-source" src="<?= base_url('media/' . $media[0]['media_slug']) ?>" alt="Preview" >
                                <?php } else if (stripos($media[0]['media_type'], 'pdf') !== false) { ?>
                                    <iframe src="<?= base_url('media/' . $media[0]['media_slug']) ?>"  frameborder="0" style="height:350px;width:100%" id="media-source"></iframe>
                                <?php } else if (stripos($media[0]['media_type'], 'word') !== false) { ?>
                                    <img id="media-source" src="<?= base_url('img/docx_icon.png') ?>" alt="Preview"  style="object-fit:contain; background-color: white;">
                                <?php } else if (stripos($media[0]['media_type'], 'spreadsheet') !== false || stripos($media[0]['media_type'], 'excel') !== false) { ?>
                                    <img id="media-source" src="<?= base_url('img/xlsx_icon.png') ?>" alt="Preview" style="object-fit:contain; background-color: white;">
                                <?php } else if (stripos($media[0]['media_type'], 'presentation') !== false || stripos($media[0]['media_type'], 'powerpoint') !== false) { ?>
                                    <img id="media-source" src="<?= base_url('img/xlsx_icon.png') ?>" alt="Preview"  style="object-fit:contain; background-color: white;">
                                <?php }
                            } else { ?>
                                <img id="media-source" class="no-source">
                            <?php } ?>
                            <p class="note-media <?= isset($media) ? 'active' : '' ?>">Tidak Ada Cover</p>
                        </div>
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

        $('.btn-reset-media').on('click', function(e) {
            let mediaId = $('#media-id').val();
            let mediaSrc = $('#media-source');
            let mediaNote = $('.note-media');
            if (mediaId.length != 0) {
                $('#media-id').val('');
            }
            mediaSrc.addClass('no-source');
            mediaSrc.removeAttr('src');
            mediaNote.removeClass('active');
        });

        $('.form-post').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');
            var htm = btn.html();
            setLoadingBtn(btn);
            var formData = new FormData(form[0]);
            $.ajax({
                url: base_url + '/kegiatan/save',
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


        $('.btn-media').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/kegiatan/media',
                data: {
                    key: 'cover'
                },
                type: 'post',
                success: function(res) {
                    resetLoadingBtn(btn, htm);
                    $('.mymodal').html(res).modal('show');
                    setLoadingBtn($('.mymodal #media-list'));
                    viewList(1, null);
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
                },
            });
        });
    });
</script>
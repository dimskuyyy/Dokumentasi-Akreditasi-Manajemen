<?php
helper(['form']);
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Form Tambah Media</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for='judul'>Judul Penelitian</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['proyek_judul'] : '' ?>" id="judul" readonly>
            </div>
            <div class="form-group">
                <label for='sebagai'>Peran Dalam Penelitian</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['proyek_sebagai'] : '' ?>" id="sebagai" readonly>
            </div>
            <div class="form-group">
                <label for='tahapan'>Tahapan</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['proyek_tahapan'] : '' ?>" id="tahapan" readonly>
            </div>
            <div class="form-group">
                <label for='artikel'>Artikel</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['proyek_artikel'] : '' ?>" id="artikel" readonly>
            </div>


        </div>
        <div class="modal-footer">
            <div class="col col-sm-12">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <?php if (!empty($data['proyek_artikel'])) { ?>
                    <button type="button" id="btn-copy" data-link="<?= isset($data) ? $data['proyek_artikel'] : '' ?>" class="btn btn-warning"><i class="fa fa-link"></i> Copy</button>
                <?php } ?>
                <?php if (!empty($data['proyek_artikel'])) { ?>
                    <a id="btn-download" href="<?= isset($data) ? $data['proyek_artikel'] : '' ?>" class="btn btn-success" download><i class="fa fa-external-link"></i> Lihat Artikel</a>
                <?php } ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $('.modal-dialog').on('click', '.modal-content .modal-footer .col #btn-copy', function(e) {
        e.preventDefault();
        var link = $(this).attr('data-link');
        if (link != '') {
            navigator.clipboard.writeText(link).then(function() {
                successMsg('Link berhasil di-copy');
            }, function() {
                errorMsg('Failure to copy. Check permissions for clipboard');
            });
        }
    });
</script>
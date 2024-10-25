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
                <label for='nama'>Nama Agenda</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['kepanitiaan_nama'] : '' ?>" id="nama" readonly>
            </div>
            <div class="form-group">
                <label for='sebagai'>Peran Sebagai</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['kepanitiaan_sebagai'] : '' ?>" id="sebagai" readonly>
            </div>
            <div class="form-group">
                <label for="image">File</label>
                <div id="imagePreview">
                    <?php if (isset($data)) {
                        if (stripos($data['media_type'], 'image') !== false) {
                    ?>
                            <img id="preview" src="<?= base_url('media/' . $data['media_slug']) ?>" alt="Preview" class="img-thumbnail preview">
                        <?php } else if (stripos($data['media_type'], 'pdf') !== false) { ?>
                            <iframe src="<?= base_url('media/' . $data['media_slug']) ?>" class="img-thumbnail preview" frameborder="0" style="height:600px"></iframe>
                        <?php } else if (stripos($data['media_type'], 'word') !== false) { ?>
                            <img id="preview" src="<?= base_url('img/docx_icon.png') ?>" alt="Preview" class="img-thumbnail preview" style="width: 200px;">
                        <?php } else if (stripos($data['media_type'], 'spreadsheet') !== false || stripos($data['media_type'], 'excel') !== false) { ?>
                            <img id="preview" src="<?= base_url('img/xlsx_icon.png') ?>" alt="Preview" class="img-thumbnail preview" style="width: 200px;">
                        <?php } else if (stripos($data['media_type'], 'presentation') !== false || stripos($data['media_type'], 'powerpoint') !== false) { ?>
                            <img id="preview" src="<?= base_url('img/xlsx_icon.png') ?>" alt="Preview" class="img-thumbnail preview" style="width: 200px;">
                        <?php }
                    } else { ?>
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail preview hidden">
                    <?php } ?>
                </div>
                <?php 
                    $filename = explode('/',$data['media_path']);
                ?>
                <h4 style="text-align: center;"><?=$filename[1]?></h4>
            </div>


        </div>
        <div class="modal-footer">
            <div class="col col-sm-12">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <button type="button" id="btn-copy" data-slug="<?= isset($data) ? $data['media_slug'] : '' ?>" class="btn btn-warning"><i class="fa fa-link"></i> Copy</button>
                <a id="btn-download" href="<?= isset($data) ? base_url('media/' . esc($data['media_slug'])) : '' ?>" class="btn btn-success" download><i class="fa fa-download"></i> Unduh</a>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $('.modal-dialog').on('click', '.modal-content .modal-footer .col #btn-copy', function(e) {
        e.preventDefault();
        var slug = $(this).attr('data-slug');
        if (slug != '') {
            var link = root_url + '<?= URL_POST_MEDIA ?>' + slug;
            navigator.clipboard.writeText(link).then(function() {
                successMsg('Link berhasil di-copy');
            }, function() {
                errorMsg('Failure to copy. Check permissions for clipboard');
            });
        }
    });
    $("#imageInput").change(function() {
        let file = $(this)[0].files;
        let type = $(this)[0].files[0].type;
        let filename = file[0].name;
        if (checkType(type, 'image') !== -1) {
            readURL(this);
        } else if (checkType(type, 'pdf') !== -1) {
            alternativeView('pdf_icon.png');
        } else if (checkType(type, 'word') !== -1) {
            alternativeView('docx_icon.png');
        } else if (checkType(type, 'powerpoint') !== -1 || checkType(type, 'presentation') !== -1) {
            alternativeView('pptx_icon.png');
        } else if (checkType(type, 'excel') !== -1 || checkType(type, 'spreadsheet') !== -1) {
            alternativeView('xlsx_icon.png');
        }
    });

    function checkType(haystack, needle) {
        return haystack.toLowerCase().indexOf(needle.toLowerCase());
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').removeClass('hidden');
                $('#preview').css('width','100%');
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function alternativeView(file) {
        $('#preview').removeClass('hidden');
        $('#preview').css('width','200px');
        $('#preview').attr('src', `${root_url}/img/${file}`);
    }
</script>
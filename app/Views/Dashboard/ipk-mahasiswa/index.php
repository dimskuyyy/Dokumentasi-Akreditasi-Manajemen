<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('title') ?>
IPK Mahasiswa
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        IPK Mahasiswa
    </h1>
</section>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<div class="box box-widget">
    <div class="box-body">

    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>

<script>
    const content = $('.box-body');
    const media = $('.mymodal #media-list');

    const viewList = debounce((page, keyword) => {
        loadMedia(page, keyword)
    }, 800, $('.mymodal #media-list'));

    function loadData() {
        $.ajax({
            url: base_url + '/ipk-mahasiswa/datatable',
            type: 'post',
            cache: true,
            success: function(data) {
                resetLoadingBtn(content);
                content.html(data);
            },
            error: function(xhr, status, error) {
                errorMsg(error);
                resetLoadingBtn(content);
            }
        });
    }

    function loadMedia(page, keyword = null) {
        $.ajax({
            url: base_url + '/media/list',
            type: 'post',
            data: {
                page: page,
                keyword: keyword,
                type: 2,
                perPage: 6
            },
            success: function(data) {
                resetLoadingBtn($('.mymodal #media-list'));
                $('.mymodal #media-list').html(data);
            },
            error: function(xhr, status, error) {
                errorMsg(error);
                resetLoadingBtn($('.mymodal #media-list'));
            }
        });
    }

    function checkType(haystack, needle) {
        return haystack.toLowerCase().indexOf(needle.toLowerCase());
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#media-source').removeClass('no-source');
                $('#media-source').css('width', '100%');
                $('#media-source').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function alternativeView(file) {
        $('#media-source').removeClass('no-source');
        $('#media-source').css('background-color', 'white')
        $('#media-source').css('object-fit', 'contain');
        $('#media-source').attr('src', `${root_url}/img/${file}`);
    }

    function callMedia(id, btn, htm, callback = () => {}) {
        if (id) {
            setLoadingBtn(btn);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='X-CSRF-TOKEN']").attr('content')
                }
            });
            $.ajax({
                url: base_url + '/ipk-mahasiswa/detail',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    $('#media-id').val(res.data.media_id);
                    $('#media-source').removeClass('no-source');
                    let type = res.data.media_type;
                    if (checkType(type, 'image') !== -1) {
                        $('.source-media').css('width', '100%');
                        $('.source-media').css('background-color', 'rgb(225, 225, 225)')
                        $('#media-source').css('object-fit', 'cover');
                        $('#media-source').attr('src', root_url + 'media/' + res.data.media_slug);
                    } else if (checkType(type, 'pdf') !== -1) {
                        alternativeView('pdf_icon.png');
                    } else if (checkType(type, 'word') !== -1) {
                        alternativeView('docx_icon.png');
                    } else if (checkType(type, 'powerpoint') !== -1 || checkType(type, 'presentation') !== -1) {
                        alternativeView('pptx_icon.png');
                    } else if (checkType(type, 'excel') !== -1 || checkType(type, 'spreadsheet') !== -1) {
                        alternativeView('xlsx_icon.png');
                    }

                    $('.note-media').addClass('active');

                    resetLoadingBtn(btn, htm);
                    $('.mymodal').modal('hide');
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    let errorMessage = response.msg;
                    errorMsg(errorMessage);
                    resetLoadingBtn(btn, htm);
                }
            });
        }
    }

    function submitMedia(form, formData, btn, htm, callback = () => {}) {
        $.ajax({
            url: base_url + '/media/save',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success: function(res) {
                if (res.message.status) {
                    successMsg(res.message.msg);

                    $('#media-id').val(res.id);
                    $('#media-source').removeClass('no-source');
                    let type = res.data.media_type;
                    if (checkType(type, 'image') !== -1) {
                        $('.source-media').css('width', '100%');
                        $('.source-media').css('background-color', 'rgb(225, 225, 225)')
                        $('#media-source').css('object-fit', 'cover');
                        $('#media-source').attr('src', root_url + 'media/' + res.data.media_slug);
                    } else if (checkType(type, 'pdf') !== -1) {
                        alternativeView('pdf_icon.png');
                    } else if (checkType(type, 'word') !== -1) {
                        alternativeView('docx_icon.png');
                    } else if (checkType(type, 'powerpoint') !== -1 || checkType(type, 'presentation') !== -1) {
                        alternativeView('pptx_icon.png');
                    } else if (checkType(type, 'excel') !== -1 || checkType(type, 'spreadsheet') !== -1) {
                        alternativeView('xlsx_icon.png');
                    }
                    $('.note-media').addClass('active');
                    $('.mymodal').modal('hide');
                } else {
                    resetLoadingBtn(btn, htm);
                    errorMsg(res.message.msg);
                }
                resetLoadingBtn(btn, htm);
                form[0].reset();
            },
            error: function(xhr, status, error) {
                resetLoadingBtn(btn, htm);
                errorMsg(error);
            }
        })
    }

    $(document).ready(function() {
        loadData();

        $(document).on('click', '.mymodal .pagination a', function(e) {
            let keyword = $('.mymodal #keyword').val();
            if ($(this).attr('href')) {
                e.preventDefault();
                let page = $(this).attr('href');
                page = page.split('=');
                loadMedia(page[1], keyword);
            }
        });

        $(document).on('input', '.mymodal #keyword', function() {
            const UpdatedKey = $(this).val();
            viewList(1, UpdatedKey);
        });

        $(document).on('click', '.modal-content .modal-body .tab-content #media-list .row .media', function(e) {
            e.preventDefault();
            e.stopPropagation();
            let btn = $(this).find('#insert-media');
            let htm = btn.html();
            let id = $(this).data('id');
            callMedia(id, btn, htm);
        });

        $('.mymodal').submit('.form-media', function(e) {
            e.preventDefault();
            e.stopPropagation();
            let form = $('.mymodal .form-media');
            let formData = new FormData($('.mymodal .form-media')[0]);
            let btn = form.find('.btn-submit');
            let htm = btn.html();
            setLoadingBtn(btn);
            submitMedia(form, formData, btn, htm);

        });
    });
</script>
<?= $this->endsection() ?>

<?= $this->section('plugin_css') ?>
<?php
datatableCss();
select2Css();
?>
<?= $this->endsection() ?>

<?= $this->section('plugin_js') ?>
<?php
datatableJs();
select2Js();
tinymceJS(); ?>
<?= $this->endsection() ?>
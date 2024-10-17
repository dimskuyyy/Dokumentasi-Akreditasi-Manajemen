<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('title') ?>
Check Dosen
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Check Dosen
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
            url: base_url + '/check-dosen/datatable',
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
    $(document).on('click', '.btn-look', function(e) {
        e.preventDefault();
        let page = $(this).attr('data-page');
        let id = $(this).attr('data-id');
        if (page) {
            $.ajax({
            url: base_url + '/check-dosen/datatable/' + page,
            type: 'post',
            data: {
                id:id
            },
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
    })

    $(document).ready(function() {
        loadData();
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
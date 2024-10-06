<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('title') ?>
Penelitian <?= AuthUser()->type_nama?>
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Penelitian <?= AuthUser()->type_nama?>
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

    function loadData() {
        $.ajax({
            url: base_url + '/penelitian/datatable',
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
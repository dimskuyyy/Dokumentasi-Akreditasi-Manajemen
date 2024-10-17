<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('title') ?>
Check Alumni
<?= $this->endsection() ?>

<?= $this->section('css') ?>
<style>
    .option-check label {
        color: #636363;
    }

    .option-check label:first-child {
        color: black;
    }

    input[type="radio"] {
        -ms-transform: scale(1.2);
        /* IE 9 */
        -webkit-transform: scale(1.2);
        /* Chrome, Safari, Opera */
        transform: scale(1.2);
    }

    .labeling-radio,
    .kuisioner-quest {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px;
    }

    .kuisioner-quest {
        background-color: #F8F9FA;
        border-radius: 4px;
        margin-bottom: 16px;
    }

    .labeling-radio p {
        display: inline-block;
        width: 16%;
        text-align: center;
    }

    .kuisioner-quest label {
        width: 20%;
        display: inline-block;
        text-align: left;
    }

    .kuisioner-quest input {
        width: 16%;
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Check Alumni
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
            url: base_url + '/check-alumni/datatable',
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
        let btn = $(this);
        let htm = btn.html();
        let id = btn.attr('data-id');
        if (id) {
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/check-alumni/form',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == false) {
                        errorMsg(res.msg);
                        resetLoadingBtn(btn, htm);
                    } else {
                        resetLoadingBtn(btn, htm);
                        content.html(res);
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
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
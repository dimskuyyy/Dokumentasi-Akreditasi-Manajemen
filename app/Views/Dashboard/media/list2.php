<div class="row" style="display:flex; align-items: flex-start; flex-wrap: wrap;" id="media-content">
    <?php foreach ($media as $list) : ?>
        <div class="col-xs-6 col-md-4 media" style="margin-top: 2rem; overflow: visible;" data-id="<?= esc($list['media_id']); ?>">
            <div class="box box-primary box-shadow" style="cursor: pointer;position:relative">
                <div class="media-detail" data-id="<?= esc($list['media_id']); ?>" style="position: absolute;inset: 0; z-index:40"></div>
                <div style="position:relative" class="media-content">
                    <div style="background-color: #f1f1f1; display:flex; justify-content: center">
                        <?php
                        if (stripos($list['media_type'], 'image') !== false) { ?>
                            <img src="<?= base_url('media/' . esc($list['media_slug'])); ?>" alt="..." style="width: 100%; height:200px;object-fit: cover;" />
                        <?php } else if (stripos($list['media_type'], 'pdf') !== false) { ?>
                            <img src="<?= base_url('img/pdf_icon.png'); ?>" alt="..." style="height:200px;" />
                        <?php } else if (stripos($list['media_type'], 'word') !== false) { ?>
                            <img src="<?= base_url('img/docx_icon.png'); ?>" alt="..." style="height:200px;" />
                        <?php } else if (stripos($list['media_type'], 'spreadsheet') !== false || stripos($list['media_type'], 'excel') !== false) { ?>
                            <img src="<?= base_url('img/xlsx_icon.png'); ?>" alt="..." style="height:200px;" />
                        <?php } else if (stripos($list['media_type'], 'presentation') !== false || stripos($list['media_type'], 'powerpoint') !== false) { ?>
                            <img src="<?= base_url('img/pptx_icon.png'); ?>" alt="..." style="height:200px;" />
                        <?php }
                        ?>
                    </div>
                    <button class="btn btn-success" id="insert-media" style="position: absolute;right:2rem;bottom:2rem">Insert <i class="fa fa-download" aria-hidden="true"></i></button>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title line-clamp" style="text-transform: capitalize;"><?= esc($list['media_nama']) ?></h3>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div id="pagenation">
    <?= $pager->links('default', 'bootstrap'); ?>
</div>
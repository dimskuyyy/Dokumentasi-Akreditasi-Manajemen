<div class="row" style="display:flex; align-items: flex-start; flex-wrap: wrap;" id="media-content">
    <?php foreach ($media as $list) : ?>
        <div class="col-xs-6 col-md-3 media" style="margin-top: 2rem; overflow: visible;">
            <div class="box box-primary box-shadow" style="cursor: pointer;position:relative">
                <div class="media-detail" data-id="<?= esc($list['media_id']); ?>" style="position: absolute;inset: 0; z-index:40"></div>
                <div style="position:relative" class="media-content">
                    <a target="_blank" href="<?= base_url('media/' . esc($list['media_slug'])); ?>" class="btn btn-success box-shadow" style="position:absolute; bottom: 12px;right:116px; z-index: 50;" download><i class="fa fa-download"></i></a>
                    <button id="btn-copy-thumb" class="btn btn-warning box-shadow" style="position:absolute; bottom: 12px;right:64px; z-index: 50;" data-slug="<?= !empty($list['media_slug']) ? $list['media_slug'] : '' ?>" title="copy link"><i class="fa fa-link"></i></button>
                    <button id="btn-detail-thumb" class="btn btn-primary box-shadow" style="position:absolute; bottom: 12px;right:12px; z-index: 50;" data-id="<?= esc($list['media_id']); ?>" title="Lihat Detail"><i class="fa fa-eye"></i></button>
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
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title line-clamp" style="text-transform: capitalize;"><?= esc($list['media_nama']) ?></h3>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>
<div class="row">
    <div id="pagenation" style="margin-left: 2rem;">
        <?= $pager->links('default', 'bootstrap'); ?>
    </div>
</div>
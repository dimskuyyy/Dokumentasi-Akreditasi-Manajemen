<div class="pull-left" style="display: flex;align-items:center; gap:1rem; margin-bottom: 1rem;">
    <a href="<?=base_url('wbpanel/check-tendik')?>" type="button" class="btn btn-sm btn-flat btn-primary btn-create"><i class="fa fa-arrow-left"></i></a> <h4 style="display: inline-block;">Lama Studi Mahasiswa</h4>
</div><br><br>
<table id="table-lama-studi" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Pengunggah</th>
            <th data-priority='1'>Tahun</th>
            <th data-priority='1'>Lama Studi</th>
            <th data-priority='1'>Tgl. Simpan</th>
            <th data-priority='1'>Tgl. Update</th>
            <th data-priority='1'></th>
        </tr>
    </thead>
</table>
<script>
    let id = <?=$uid?>;
    var oTable = $('#table-lama-studi').dataTable({
        'bFilter': false,
        'autoWidth': true,
        'pagingType': 'full_numbers',
        'paging': true,
        'processing': true,
        'serverSide': true,
        'searching': true,
        'ordering': true,
        'fixedColumns': true,
        'language': {
            processing: '<i class=\'fa fa-refresh fa-spin fa-3x fa-fw\'></i><span class=\'sr-only\'>Loading...</span>'
        },
        'columns': [
            {
                data: 'oleh',
                name: 'oleh'
            },
            {
                data: 'tahun',
                name: 'tahun'
            },
            {
                data: 'lama',
                name: 'lama'
            },
            {
                data: 'tgl_simpan',
                name: 'tgl_simpan'
            },
            {
                data: 'tgl_update',
                name: 'tgl_update'
            },
            {
                'data': null,
                'render': function(data, type, row) {
                    return ' <button data-id=\'' + data.id + '\' type=\'submit\' class=\'btn btn-sm btn-warning btn-flat btn-detail-media\' title=\'klik untuk lihat detail\'><i class=\'fa fa-eye\'></i></button> ' +
                        '<a download target="_blank" href="' + root_url + 'media/' + data.slug + '" type=\'button\' class=\'btn btn-sm btn-info btn-flat btn-copy\' title=\'klik untuk unduh dokumen\'><i class=\'fa fa-download\'></i></a>';
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/check-tendik/lama-studi/list',
                type: 'post',
                data: {
                    datatables: data,
                    id:id
                },
                success: function(r) {
                    callback({
                        recordsTotal: r.recordsTotal,
                        recordsFiltered: r.recordsFiltered,
                        data: r.data
                    });
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                }
            })
        },
        'responsive': true
    });
    $('#table-lama-studi').on('click', '.btn-detail-media', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        if (id) {
            $.ajax({
                url: base_url + '/check-tendik/lama-studi/info',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == false) {
                        errorMsg(res.msg);
                    } else {
                        $('.mymodal').html(res).modal('show');
                        $('#nama').attr('disabled', true);
                        $('#imageInput').remove();
                        $('.btn-submit').remove();
                        $('#myModalLabel').html('Form Show Media');
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                }
            });
        }
    })
</script>

<table id="table-koor-list" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Nama User</th>
            <th data-priority='1'>Kerjasama</th>
            <th data-priority='1'>Kegiatan Fakultas</th>
        </tr>
    </thead>
</table>
<script>
    var oTable = $('#table-koor-list').dataTable({
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
        'columns': [{
                data: 'nama',
                name: 'nama'
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.kerjasama + '</b> Kerjasama</button> ' +
                        ' <button data-page=\'kerjasama\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Surat Tugas\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.kegiatan + '</b> Kegiatan</button> ' +
                        ' <button data-page=\'kegiatan\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Kegiatan Fakultas\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/check-koor/koor-list',
                type: 'post',
                data: {
                    datatables: data
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
</script>
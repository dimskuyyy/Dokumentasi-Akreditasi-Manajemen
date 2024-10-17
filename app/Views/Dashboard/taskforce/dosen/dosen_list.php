
<table id="table-dosen-list" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Nama Dosen</th>
            <th data-priority='1'>SK Pengajaran</th>
            <th data-priority='1'>Penelitian</th>
            <th data-priority='1'>Pengabdian</th>
            <th data-priority='1'>Sertifikat</th>
            <th data-priority='1'>HaKi</th>
            <th data-priority='1'>Kegiatan Luar Kampus</th>
            <th data-priority='1'>Kegiatan Dalam Kampus</th>
            <th data-priority='1'>Kepanitiaan</th>
        </tr>
    </thead>
</table>
<script>
    var oTable = $('#table-dosen-list').dataTable({
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
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.pengajaran + '</b> SK Pengajaran</button> ' +
                        ' <button data-page=\'pengajaran\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat pengajaran\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.penelitian + '</b> Penelitian</button> ' +
                        ' <button data-page=\'penelitian\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Penelitian\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.pengabdian + '</b> Pengabdian</button> ' +
                        ' <button data-page=\'pengabdian\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Pengabdian\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.sertifikat + '</b> Sertifikat</button> ' +
                        ' <button data-page=\'sertifikat\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Sertifikat\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.haki + '</b> HaKi</button> ' +
                        ' <button data-page=\'haki\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat HaKi\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.kegiatan_luar + '</b> Kegiatan</button> ' +
                        ' <button data-page=\'kegiatan_luar\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Kegiatan\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.kegiatan_dalam + '</b> Kegiatan</button> ' +
                        ' <button data-page=\'kegiatan_dalam\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Kegiatan\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.kepanitiaan + '</b> Agenda</button> ' +
                        ' <button data-page=\'kepanitiaan\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Kepanitiaan\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/check-dosen/dosen-list',
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

<table id="table-tendik-list" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Nama User</th>
            <th data-priority='1'>Sertifikat</th>
            <th data-priority='1'>Lama Studi Mahasiswa</th>
            <th data-priority='1'>IPK Mahasiswa</th>
        </tr>
    </thead>
</table>
<script>
    var oTable = $('#table-tendik-list').dataTable({
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
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.sertifikat + '</b> Sertifikat</button> ' +
                        ' <button data-page=\'sertifikat\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Sertifikat\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.lama_studi + '</b> Dokumen</button> ' +
                        ' <button data-page=\'lama_studi\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Dokumen\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
            {
                data: null,
                'render': function(data, type, row) {
                    return ' <button readonly class=\'btn btn-sm btn-default btn-flat btn-look\'><b>' + data.ipk_mahasiswa + '</b> Dokumen</button> ' +
                        ' <button data-page=\'ipk_mahasiswa\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat Dokumen\'><i class=\'fa fa-sign-in\'></i></button> ';
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/check-tendik/tendik-list',
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
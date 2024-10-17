
<table id="table-alumni-list" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Nama Alumni</th>
            <th data-priority='1'>Status Survey</th>
        </tr>
    </thead>
</table>
<script>
    var oTable = $('#table-alumni-list').dataTable({
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
                    let status = '';
                    let btn = '';
                    let lookbtn = '';
                    if(data.survey == 1 && data.kuisioner == 1){
                        status = 'Sudah Diisi';
                        btn = 'success';
                        lookbtn = ' <button data-page=\'survey\' data-id=\''+data.id+'\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-look\' title=\'klik untuk lihat survey\'><i class=\'fa fa-sign-in\'></i></button> ';
                    }else if((data.survey == 0 && data.kuisioner == 1) || (data.survey == 1 && data.kuisioner == 0)){
                        status = 'Belum Lengkap';
                        btn = 'warning';
                    }else if(data.survey == 0 && data.kuisioner == 0){
                        status = 'Belum Diisi';
                        btn = 'danger';
                    }else{
                        status = 'Anomali';
                        btn = 'default';
                    }
                    return ' <button readonly class=\'btn btn-sm btn-'+btn+' btn-flat btn-look\'>Survey <b>' + status + '</b></button> ' +
                        lookbtn;
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/check-alumni/alumni-list',
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
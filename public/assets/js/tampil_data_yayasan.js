$(document).ready(function() {
    $('#draft').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/draft-rekomendasi-terdaftar-yayasan',
            type: 'GET',
            dataSrc: 'data.data'
        },
        buttons: [{
            text: 'My button',
            action: function(e, dt, node, config) {
                alert('Button activated');
            }
        }],
        // ajax: "{{ route('getdata') }}",
        columns: [{
                data: 'no_pendaftaran',
                name: 'no_pendaftaran'
            },
            {
                data: 'nama_lembaga',
                name: 'nama_lembaga'
            },
            {
                data: 'nama_ketua',
                name: 'nama_ketua'
            },
            {
                data: 'nik_pel',
                name: 'nik_pel'
            },
            {
                data: 'nama_pel',
                name: 'nama_pel'
            },
            {
                data: 'alamat_lembaga',
                name: 'alamat_lembaga'
            },
            {
                data: 'status_alur',
                name: 'status_alur'
            },
            {
                data: 'tujuan',
                name: 'tujuan'
            },
            {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                "mRender": function(data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                            '</div>'+
                            // '<div class="btn-group" role="group" aria-label="Actions">'+
                            // '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                            // '</div>'+
                            '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                            '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                            '</div>';

                }
            }
        ],
    });
});
$('#proses').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/diproses-rekomendasi-terdaftar-yayasan',
        type: 'GET',
        dataSrc: 'data.data'
    },
  columns: [{
                data: 'no_pendaftaran',
                name: 'no_pendaftaran'
            },
            {
                data: 'nama_lembaga',
                name: 'nama_lembaga'
            },
            {
                data: 'nama_ketua',
                name: 'nama_ketua'
            },
            {
                data: 'nik_pel',
                name: 'nik_pel'
            },
            {
                data: 'nama_pel',
                name: 'nama_pel'
            },
            {
                data: 'alamat_lembaga',
                name: 'alamat_lembaga'
            },
            {
                data: 'status_alur',
                name: 'status_alur'
            },
            {
                data: 'tujuan',
                name: 'tujuan'
            },
            {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                "mRender": function(data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                            '</div>'+
                            // '<div class="btn-group" role="group" aria-label="Actions">'+
                            // '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                            // '</div>'+
                            '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                            '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                            '</div>';

                }
            }
        ],

});
$('#teruskan').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/teruskan-rekomendasi-terdaftar-yayasan',
        type: 'GET',
        dataSrc: 'data.data'
    },
    // ajax: "{{ route('getdata') }}",
    columns: [{
                data: 'no_pendaftaran',
                name: 'no_pendaftaran'
            },
            {
                data: 'nama_lembaga',
                name: 'nama_lembaga'
            },
            {
                data: 'nama_ketua',
                name: 'nama_ketua'
            },
            {
                data: 'nik_pel',
                name: 'nik_pel'
            },
            {
                data: 'nama_pel',
                name: 'nama_pel'
            },
            {
                data: 'alamat_lembaga',
                name: 'alamat_lembaga'
            },
            {
                data: 'status_alur',
                name: 'status_alur'
            },
            {
                data: 'tujuan',
                name: 'tujuan'
            },
            {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                "mRender": function(data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                            '</div>'+
                            // '<div class="btn-group" role="group" aria-label="Actions">'+
                            // '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                            // '</div>'+
                            '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                            '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                            '</div>';

                }
            }
        ],
});
$('#selesai').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/selesai-rekomendasi-terdaftar-yayasan',
        type: 'GET',
        dataSrc: 'data.data'
    },
    // ajax: "{{ route('getdata') }}",
    columns: [{
            data: 'no_pendaftaran',
            name: 'no_pendaftaran'
        },
        {
            data: 'nama_lembaga',
            name: 'nama_lembaga'
        },
        {
            data: 'nama_ketua',
            name: 'nama_ketua'
        },
        {
            data: 'nik_ter',
            name: 'nik_ter'
        },
        {
            data: 'nama_ter',
            name: 'nama_ter'
        },
        {
            data: 'alamat_lembaga',
            name: 'alamat_lembaga'
        },
        {
            data: 'status_alur',
            name: 'status_alur'
        },
        {
            data: 'tujuan',
            name: 'tujuan'
        },
        {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                "mRender": function(data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                            '</div>'+
                            // '<div class="btn-group" role="group" aria-label="Actions">'+
                            // '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                            // '</div>'+
                            '<div class="btn-group" role="group" aria-label="Actions">' +
                            '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                            '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                            '</div>';

                }
            }
    ],
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
    $(target).find('table').DataTable().columns.adjust().responsive
        .recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
});
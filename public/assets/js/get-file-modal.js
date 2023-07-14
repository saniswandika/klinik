$('#modal_file_ktp_terlapor_bantuan_pendidikans').on('shown.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    // console.log(id);
    // tampilkan data yang sesuai dengan ID
    $.ajax({
      
        url: `/file_permohonan_terdaftar_yayasan/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data.data.akta_notarispendirian);
            // $('#modal-content').html(data.content);
            // $('#myModal').modal('hide');

            $('#modal_file_ktp_terlapor_bantuan_pendidikans').addClass('fade');
            $('#modal_iframe_file_ktp_terlapor_bantuan_pendidikans').modal('show');
            // $('#myModal2').modal('show');
            $('#modal_iframe_file_ktp_terlapor_bantuan_pendidikans').attr('src', data.data.akta_notarispendirian);

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
$('#modal-draft-detail-file').on('shown.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    // tampilkan data yang sesuai dengan ID
    $.ajax({
      
        url: `/file_kk_terlapor_bantuan_pendidikans/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data.data.file_kk_terlapor_bantuan_pendidikans);
            // $('#modal-content').html(data.content);
            // $('#myModal').modal('hide');
            $('#MyModal').addClass('fade');
            // $('#myModal2').modal('show');
            $('#modal-iframe').attr('src', data.data.file_kk_terlapor_bantuan_pendidikans);
            $('#modalKedua').modal('show');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
$('#file_keterangan_dtks_bantuan_pendidikans').on('shown.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    // tampilkan data yang sesuai dengan ID
    $.ajax({
      
        url: `/file_kk_terlapor_bantuan_pendidikans/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data.data.file_keterangan_dtks_bantuan_pendidikans);
            // $('#modal-content').html(data.content);
            // $('#myModal').modal('hide');
            $('#MyModal').addClass('fade');
            // $('#myModal2').modal('show');
            $('#modal-iframe-file_keterangan_dtks_bantuan_pendidikans').attr('src', data.data.file_keterangan_dtks_bantuan_pendidikans);
            $('#file_keterangan_dtks_bantuan_pendidikans').modal('show');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
 $('#modal_file_pendukung_bantuan_pendidikans').on('shown.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    // tampilkan data yang sesuai dengan ID
    $.ajax({
      
        url: `/file_kk_terlapor_bantuan_pendidikans/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data.data.file_pendukung_bantuan_pendidikans);
            // $('#modal-content').html(data.content);
            // $('#myModal').modal('hide');
            $('#MyModal').addClass('fade');
            // $('#myModal2').modal('show');
            $('#modal_iframe_modal_file_pendukung_bantuan_pendidikans').attr('src', data.data.file_pendukung_bantuan_pendidikans);
            $('#file_pendukung_bantuan_pendidikans').modal('show');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
function openModalFilePendukung(id) {
   
    // tampilkan data yang sesuai dengan ID
    $.ajax({
      
        url: `/file_pendukung_bantuan_pendidikans/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data.data.file_pendukung_bantuan_pendidikans);
            // $('#modal-content').html(data.content);
            // $('#myModal').modal('hide');
            $('#MyModal').addClass('fade');
            // $('#myModal2').modal('show');
            $('#modal_iframe_modal_file_pendukung_bantuan_pendidikans').attr('src', data.data.file_pendukung_bantuan_pendidikans);
            $('#file_pendukung_bantuan_pendidikans').modal('show');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
function showModal(id) {
    $.ajax({
        url: `/rekomendasi_terdaftar_yayasans/${id}`,
        type: 'GET',
        success: function(data) {
            // console.log(data.data);
            var button1 = ' <button class="btn btn-primary" data-bs-target="#modal_file_ktp_terlapor_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.data.id + '">Lihat File</button>';
            // var button2 = ' <button class="btn btn-primary" data-bs-target="#modal-draft-detail-file" data-bs-toggle="modal" data-id="' + data.data.id + '">Lihat File</button>';
            // var button3 = ' <button class="btn btn-primary" data-bs-target="#file_keterangan_dtks_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.data.id + '">Lihat File</button>';
            // var button4 = ' <button class="btn btn-primary" data-bs-target="#modal_file_pendukung_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.data.id + '">Lihat File</button>';
            // var button5 = ' <button class="btn btn-primary" data-bs-target="#modal_file_ktp_terlapor_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button6 = ' <button class="btn btn-primary" data-bs-target="#modal-draft-detail-file" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button7 = ' <button class="btn btn-primary" data-bs-target="#file_keterangan_dtks_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button8 = ' <button class="btn btn-primary" data-bs-target="#modal_file_pendukung_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button9 = ' <button class="btn btn-primary" data-bs-target="#modal_file_ktp_terlapor_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button10 = ' <button class="btn btn-primary" data-bs-target="#modal-draft-detail-file" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // var button11= ' <button class="btn btn-primary" data-bs-target="#file_keterangan_dtks_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
            // $('#modal-button').html(button1);
            $('#modal-button1').html(button1);
            // $('#modal-button2').html(button2);
            // $('#modal-button3').html(button3);
            // $('#modal-button4').html(button4);
            // $('#myModal2').modal('hide');
            $('#modal-draft-detail #modal-title').text(data.data.id);
            $('#modal-draft-detail #nama_provinsi').val(data.data.name_prov);
            $('#modal-draft-detail #name_cities').val(data.data.name_cities);
            $('#modal-draft-detail #name_districts').val(data.data.name_districts);
            $('#modal-draft-detail #id_kabkot').val(data.data.name_village);
            $('#modal-draft-detail #nama_pel').val(data.data.nama_pel);
            $('#modal-draft-detail #nik_pel').val(data.data.nik_pel);
            $('#modal-draft-detail #alamat_pel').val(data.data.alamat_pel);
            $('#modal-draft-detail #status_kepengurusan').val(data.data.status_kepengurusan);
            $('#modal-draft-detail #nama_lembaga').val(data.data.nama_lembaga);
            $('#modal-draft-detail #telp_pel').val(data.data.telp_pel);
            $('#modal-draft-detail #alamat_lembaga').val(data.data.alamat_lembaga);
            $('#modal-draft-detail #nama_ketua').val(data.data.nama_ketua);
            $('#modal-draft-detail #nama_notaris').val(data.data.nama_notaris);
            $('#modal-draft-detail #notgl_akta').val(data.data.notgl_akta);
            $('#modal-draft-detail #status').val(data.data.status);
            $('#modal-draft-detail #no_ahu').val(data.data.no_ahu);
            $('#modal-draft-detail #catatan').val(data.data.catatan);
            $('#modal-draft-detail #status_alur').val(data.data.status_alur);
             $('#modal-draft-detail #tujuan').val(data.data.name_roles);
             $('#modal-draft-detail #petugas').val(data.data.name);
            $('#modal-draft-detail').modal('show');
            const table1 = $('#log_permohonan').DataTable({
                bInfo: false,
                searching: true,
                ordering: false,
                paging: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: `/log-bantuan-pendidikan/${id}`,
                    type: 'GET',
                    data: {
                        id
                    },
                },
                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status_alur_bantuan_pendidikans',
                        name: 'status_alur_bantuan_pendidikans'
                    },
                    {
                        data: 'catatan_bantuan_pendidikans',
                        name: 'catatan_bantuan_pendidikans'
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        orderable: false,
                        "mRender": function(data, type, row) {
                            // console.log(data)
                            var button4 = ' <button class="btn btn-primary" data-bs-target="#modal_file_pendukung_bantuan_pendidikans" data-bs-toggle="modal" data-id="' + data.id + '">Lihat File</button>';
                            return button4;

                        }
                    }
                ]
            });
            if (table1) {
                table1.destroy();
            }
        }
    });
}
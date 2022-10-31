<script>
    let verif_id;

    const statusUser = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        verif_id = id;

        $.ajax({
            type: "get",
            url: `/verification/${verif_id}`,
            dataType: "json",
            success: function (response) {
                if(response.image){ $('#profilEdit').attr('src', `/assets/image/profil/${response.image}`); }
                if(response.card_id){ $('#cardEdit').attr('src', `/assets/image/idCard/${response.card_id}`); }
                $('#nameEdit').val(response.detail_to_user.name);
                $('#phoneEdit').val(response.phone);
                $('#genderEdit').val(response.gender);
                $('#addEdit').val(response.address);
                $('#statusEdit').val(response.status);
                $('#cardEditHidden').val(response.card_id);
                Swal.close();
                $('#editStatusModal').modal('show');
            }
        });
    }

    const deleteVer = (id) => {
        Swal.fire({
            title: 'Apa anda yakin untuk menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            Swal.close();

            if(result.value) {
                Swal.fire({
                    title: 'Mohon tunggu',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    type: "delete",
                    url: `/verification/${id}`,
                    dataType: "json",
                    success: function (response) {
                        Swal.close();

                        if(response.status) {
                            Swal.fire(
                                'Success!',
                                response.msg,
                                'success'
                            )

                            $('#verifTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            }
        });
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#verifTable').DataTable({
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], ['10', '25', '50', '100', 'Semua']],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/verification/lihatPenyewa'
            },
            "columns":
            [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'detail.image', name:'member.name'},
                { data: 'name', name:'member.name'},
                { data: 'email', name:'member.detail'},
                { data: 'detail.phone', name:'member.detail'},
                { data: 'detail.gender', name:'member.detail'},
                { data: 'detail.card_id', name:'member.detail'},
                { data: 'detail.status', name:'member.detail'},
                { data: 'action', orderable: false, searchable: false},
            ]
        });

        $('#editStatusSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($('#editStatusForm')[0]);

            Swal.fire({
                title: 'Mohon tunggu',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                type: "post",
                url: `/verification/${verif_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if(data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        verif_id = null;
                        $('#editStatusModal').modal('hide');
                        $('#verifTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            })
        });
    });


</script>

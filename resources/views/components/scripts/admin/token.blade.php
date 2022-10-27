<script>
    let token_id;

    const createToken = () => {
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
            url: `/token`,
            dataType: "json",
            cache: false,
            processData: false,
            success: function(data) {
                Swal.close();

                if(data.status) {
                    Swal.fire(
                        'Token baru : ' + data.token,
                        data.msg,
                        'success'
                    )

                    $('#tokenTable').DataTable().ajax.reload();
                } else {
                    Swal.fire(
                        'Error!',
                        data.msg,
                        'warning'
                    )
                }
            }
        })
    }

    const deleteToken = (id) => {
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
                    url: `/token/${id}`,
                    dataType: "json",
                    success: function (response) {
                        Swal.close();

                        if(response.status) {
                            Swal.fire(
                                'Success!',
                                response.msg,
                                'success'
                            )

                            $('#tokenTable').DataTable().ajax.reload();
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

        $('#tokenTable').DataTable({
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], ['10', '25', '50', '100', 'Semua']],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/token/lihatToken'
            },
            "columns":
            [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'token', name:'member.name'},
                { data: 'status', name:'member.detail'},
                { data: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

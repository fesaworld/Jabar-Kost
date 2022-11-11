<script>
    let inv_id;

    const createInv = () => {
        $('#createInvForm').trigger('reset');
        $('#createInvModal').modal('show');
    }

    const deleteInv = (id) => {
        Swal.fire({
            title: 'Apa anda yakin untuk menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            Swal.close();

            if (result.value) {
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
                    url: `/invoice/${id}`,
                    dataType: "json",
                    cache: false,
                    processData: false,
                    success: function(data) {
                        Swal.close();

                        if (data.status) {
                            Swal.fire(
                                'Success!',
                                data.msg,
                                'success'
                            )

                            $('#invTable').DataTable().ajax.reload();
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
        });
    }


    const statusInv = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        inv_id = id;

        $.ajax({
            type: "get",
            url: `/invoice/${inv_id}`,
            dataType: "json",
            success: function(response) {
                $('#nameStatusInvEdit').val(response.name);
                $('#roomStatusInvEdit').val(response.room_id);
                $('#startStatusInvEdit').val(response.start);
                $('#endStatusInvEdit').val(response.end);
                $('#statusStatusInvEdit').val(response.status);
                Swal.close();
                $('#editStatusInvModal').modal('show');
            }
        });
    }

    const editInv = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        inv_id = id;

        $.ajax({
            type: "get",
            url: `/invoice/${inv_id}`,
            dataType: "json",
            success: function(response) {
                $('#invEditName').val(response.name);
                $('#invEditRoom').val(response.room_id);
                $('#invEditStart').val(response.start);
                $('#invEditEnd').val(response.end);
                $('#invEditDisc').val(response.discount);
                Swal.close();
                $('#editInvModal').modal('show');
            }
        });
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#invTable').DataTable({
            order: [],
            dom: '<"class mb-3"B>lfrtip',
            buttons: ['excel', 'pdf'],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semua']
            ],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/invoice/lihatInvoice'
            },
            "columns": [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'user_id',
                    name: 'to_user.name'
                },
                {
                    data: 'room_id',
                    name: 'to_room.name'
                },
                {
                    data: 'start',
                    name: 'member.name'
                },
                {
                    data: 'end',
                    name: 'member.name'
                },
                {
                    data: 'discount',
                    name: 'member.name'
                },
                {
                    data: 'price',
                    name: 'member.price'
                },
                {
                    data: 'trf_image',
                    name: 'member.stok'
                },
                {
                    data: 'status',
                    name: 'member.detail'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createInvSubmit').click(function(e) {
            e.preventDefault();

            var formData = $('#createInvForm').serialize();

            $('#createInvModal').modal('hide');

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
                url: "/invoice",
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#invTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#createInvModal').modal('show');
                        })

                    }
                }
            })
        });

        $('#editInvSubmit').click(function(e) {
            e.preventDefault();

            var formData = $('#editInvForm').serialize();

            $('#editInvModal').modal('hide');

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
                url: `/invoice/${inv_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        inv_id = null;

                        $('#invTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#editRoomModal').modal('show');
                        })
                    }
                }
            })
        });

        $('#editStatusInvSubmit').click(function(e) {
            e.preventDefault();

            var formData = $('#editStatusInvForm').serialize();

            $('#editStatusInvModal').modal('hide');

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
                url: `/invoiceStatus/${inv_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        inv_id = null;

                        $('#invTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#editStatusInvModal').modal('show');
                        })
                    }
                }
            })
        });
    });
</script>

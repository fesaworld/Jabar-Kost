<script>
    let room_id;

    const createRoom = () => {
        $('#createRoomForm').trigger('reset');
        $('#createRoomModal').modal('show');
        $(".dropify-clear").click();
    }

    const importRoom = () => {
        $('#importRoom').modal('show');
    }

    const deleteRoom = (id) => {
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
                    url: `/room/${id}`,
                    dataType: "json",
                    success: function(response) {
                        Swal.close();

                        if (response.status) {
                            Swal.fire(
                                'Success!',
                                response.msg,
                                'success'
                            )

                            $('#roomTable').DataTable().ajax.reload();
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

    const editRoom = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        room_id = id;

        $.ajax({
            type: "get",
            url: `/room/${room_id}`,
            dataType: "json",
            success: function(response) {
                $('#roomNameEdit').val(response.name);
                $('#roomPriceEdit').val(response.price);
                $('#roomStockEdit').val(response.stok);
                $('#roomDetailEdit').val(response.detail);
                $(".dropify-clear").click();
                Swal.close();
                $('#editRoomModal').modal('show');
            }
        });
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#roomTable').DataTable({
            order: [],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semua']
            ],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/room/lihatRoom'
            },
            "columns": [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'member.name'},
                {data: 'price', name: 'member.price'},
                {data: 'stok', name: 'member.stok'},
                {data: 'detail', name: 'member.detail'},
                {data: 'image', name: 'member.image'},
                {data: 'action', orderable: false, searchable: false},
            ]
        });

        $('.roomPrice').keyup(function(event) {
            if (event.which >= 37 && event.which <= 40) return;

            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        $('#createRoomSubmit').click(function(e) {
            e.preventDefault();

            var formData = new FormData($('#createRoomForm')[0]);

            $('#createRoomModal').modal('hide');

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
                url: "/room",
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#roomTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#createRoomModal').modal('show');
                        })

                    }
                }
            })
        });

        $('#editRoomSubmit').click(function(e) {
            e.preventDefault();

            var formData = new FormData($('#editRoomForm')[0]);

            $('#editRoomModal').modal('hide');

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
                url: `/room/${room_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        member_id = null;

                        $('#roomTable').DataTable().ajax.reload();
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

        $('#printRoom').click(function(e) {
            e.preventDefault();

            var formData = new FormData($('#importForm')[0]);

            $('#importRoom').modal('hide');

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
                url: "/roomImport",
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#roomTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#importRoom').modal('show');
                        })

                    }
                }
            })
        });

    });
</script>

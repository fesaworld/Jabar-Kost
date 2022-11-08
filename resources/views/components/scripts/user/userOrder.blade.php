<script>
    let ord_id;

    const createOrder = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        ord_id = id;

        $.ajax({
            type: "get",
            url: `/room/${ord_id}`,
            dataType: "json",
            success: function(response) {
                $('#orderRoomName').val(response.name);
                $('#orderRoomID').val(response.id);
                Swal.close();
                $('#userOrderModal').modal('show');
            }
        });
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#orderSubmit').click(function(e) {
            e.preventDefault();

            var formData = $('#userOrderForm').serialize();

            $('#userOrderModal').modal('hide');

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
                url: "/userOrder",
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
                        ).then(() => {
                            window.location = "/userBill";
                        })
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        ).then(() => {

                            $('#userOrderModal').modal('show');
                        }
                    )
                    }
                }
            })
        });

    });
</script>

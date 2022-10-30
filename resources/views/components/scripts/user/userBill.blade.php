<script>
    let bill_id;

    const editBill = (id) => { bill_id = id; }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const editBill = (id) => { bill_id = id; }

        $('#editBillSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($('#editBillForm')[0]);

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
                url: `/userBill/${bill_id}`,
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

                        bill_id = null;
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

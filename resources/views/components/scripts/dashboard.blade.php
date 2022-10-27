<script>
    const createTokenDashboard = () => {
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
                    Swal.fire({
                        title: 'Token baru : ' + data.token,
                        text: data.msg,
                        icon: 'success',
                        confirmButtonText: 'Lihat',
                    }).then(() => {
                        window.location = "/token";
                    })
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

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    });
</script>

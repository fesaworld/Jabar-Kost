<script>
    "use strict";
    document.addEventListener("DOMContentLoaded", function (e) {
        {
            document.querySelector("#formAccountDeactivation");
            let e = document.getElementById("profile");
            const t = document.querySelector(".account-file-input"),
                c = document.querySelector(".account-image-reset");
            if (e) {
                const n = e.src;
                (t.onchange = () => {
                    t.files[0] && (e.src = window.URL.createObjectURL(t.files[0]));
                }),
                    (c.onclick = () => {
                        (t.value = ""), (e.src = n);
                    });
            }
            return;
        }
    });

    let profile_id;

    const editProfil = (id) => {
        profile_id = id;

        $( "#userAdd" ).prop( "readonly", false );
        $( "#userPhone" ).prop( "readonly", false );
        $( "#userGender" ).prop( "disabled", false );
        $( "#userCard" ).prop( "readonly", false );
        $( "#userProfile" ).prop( "disabled", false );
        $( "#profileReset" ).prop( "disabled", false );
        $( "#btnUserSubmit" ).prop( "disabled", false );
        $( "#btnUserEdit" ).prop( "disabled", true );

        Swal.fire(
            'Perhatian!',
            'Silahkan isi data diri anda',
            'info'
        );
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.phone').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;

            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
            });
        });

        $('#btnUserSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($('#editProfilForm')[0]);

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
                url: `/userProfile/${profile_id}`,
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
                        ).then(() => {
                            window.location = "/";
                        })

                        profile_id = null;

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

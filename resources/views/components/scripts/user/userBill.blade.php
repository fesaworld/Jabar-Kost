<script>
    "use strict";
    document.addEventListener("DOMContentLoaded", function (e) {
        {
            document.querySelector("#formAccountDeactivation");
            let e = document.getElementById("trfUser");
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

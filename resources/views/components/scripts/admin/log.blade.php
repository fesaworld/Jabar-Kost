<script>
    let log;

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        $('#logTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf', 'print'],
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
                url: '/log'
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
                }
            ]
        });
    })
</script>

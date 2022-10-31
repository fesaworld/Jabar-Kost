<script>
    let history_id;

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#historyTable').DataTable({
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], ['10', '25', '50', '100', 'Semua']],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/userHistory/lihatHistory'
            },
            "columns":
            [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'created_at', name:'member.name'},
                { data: 'room_id', name:'member.name'},
                { data: 'start', name:'member.detail'},
                { data: 'end', name:'member.detail'},
                { data: 'discount', name:'member.detail'},
                { data: 'price', name:'member.detail'},
                { data: 'trf_image', name:'member.detail'},
                { data: 'status', name:'member.detail'},
            ]
        });
    });
</script>

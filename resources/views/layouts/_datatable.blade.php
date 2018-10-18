<!-- Scripts -->
@if(isset($type))
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#data').DataTable({
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: '{{ url($type) }}/data',
                },
                aoColumnDefs: [
                    {
                        targets: 0,
                        checkboxes: {
                           selectRow: true
                        }
                    },
                    {
                        bSortable: false,
                        aTargets: ['nosort']
                    }
                ],
                select: {
                    style: 'multi'
                },
                initComplete: function(settings){
                    var api = this.api();
                    api.cells(
                        api.rows(function(idx, data, node){
                           return ($(node).find('.delete_item').length) ? false : true;
                        }).indexes(),
                        0
                    ).checkboxes.disable();
                  },
                drawCallback: function( settings ) {
                    var api = this.api();
                    api.cells(
                        api.rows(function(idx, data, node){
                           return ($(node).find('.delete_item').length) ? false : true;
                        }).indexes(),
                        0
                    ).checkboxes.disable();
                }
            });
        });

        // delete an item
        @if(isset($title))
        function deleteItem(e) {
            if (!confirm('Delete {{ strtolower($title) }} "'+$(e).data('title')+'" ?')) {
                return false;
            }
            $.ajax({
                url : '{{ url($type) }}/'+$(e).data('id'),
                type : 'post',
                data : {
                    '_method' : 'delete',
                    '_token' : '{{ csrf_token() }}',
                },
                success : function(data) {
                    if (data) {
                        oTable.ajax.reload(null, false);
                    } else {
                        alert('This item could not be deleted because it was used in other functions');
                    }
                }
            })
        }
        @endif

        // // mass delete action
        // $('#mass_delete').click(function(e){
        //     var rows_selected = oTable.column(0).checkboxes.selected();
        //     if (rows_selected.count()) {
        //         if (!confirm('Delete selected items?')) {
        //             return false;
        //         }
        //         var complete = 0;
        //         var done = 0;
        //         $.each(rows_selected, function(index, id){
        //             $.ajax({
        //                 url : '{{ url($type) }}/' + id,
        //                 type : 'post',
        //                 data : {
        //                     '_method' : 'delete',
        //                     '_token' : '{{ csrf_token() }}',
        //                 },
        //                 success: function(data) {
        //                     complete++;
        //                     if (data) {
        //                         done++;
        //                     }
        //                     if (complete == rows_selected.length) {
        //                         if (done != rows_selected.length) {
        //                             alert('Some items could not be deleted because they were used in other functions')
        //                         }
        //                         location.reload();
        //                     }
        //                 }
        //             })
        //         });
        //     } else {
        //         alert('No item selected');
        //     }
        // });

        // // show hide the delete
        // $('body').on('change', '.dt-checkboxes, .dt-checkboxes-select-all', function() {
        //     if($('.dt-checkboxes:checked').length) {
        //         $('#mass_delete').show();
        //     } else {
        //         $('#mass_delete').hide();
        //     }
        // });

    </script>
@endif
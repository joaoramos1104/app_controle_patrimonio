
(function ($) {
    "use strict";

$(document).ready(function () {
    var table = $('#empresas, #table_user').DataTable({
        scrollY: '300px',
        scrollX: true,
        paging: true,

        "lengthMenu": [ [5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "All"] ],
                    "pageLength":10,
                    "language": {
                        "lengthMenu": "Exibir _MENU_ Por Página",
                        "zeroRecords": "Nothing found - sorry",
                        "info": " Página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "sSearchPlaceholder": "Buscar...",
                    },

    });

    // $('a.toggle-vis').on('click', function (e) {
    //     e.preventDefault();

    //     // Get the column API object
    //     var column = table.column($(this).attr('data-column'));

    //     // Toggle the visibility
    //     column.visible(!column.visible());
    // });

});


//Itens

$(document).ready(function () {
    var groupColumn = 7;
    var table = $('#itens, #itens_inativos').DataTable({
        scrollX: true,
        paging: true,
        "lengthMenu":[ [5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "All"] ],
                    "pageLength": 5,
                    "language": {
                        "lengthMenu": "Exibir _MENU_ Por Página",
                        "zeroRecords": "Nothing found - sorry",
                        "info": " Página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "sSearchPlaceholder": "Buscar...",
                    },

        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, 'asc']],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;

            api
                .column(groupColumn, { page: 'current' })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group bg-secondary text-white"><td colspan="10">' + group + '</td></tr>');

                        last = group;
                    }
                });
        },
    });

    // Order by the grouping
    $('#itens tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});


//Itens Empresa
$(document).ready(function () {
    var groupColumn = 7;
    var table = $('#itens_empresa, #full_itens' ).DataTable({
        scrollX: true,
        paging: false,
        "lengthMenu":[ [-1], ["All"] ],
                    "pageLength": -1,
                    "language": {
                        "lengthMenu": "Exibir _MENU_ Por Página",
                        "zeroRecords": "Nothing found - sorry",
                        "info": " Página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "sSearchPlaceholder": "Buscar...",
                    },
    });
});


})(jQuery);

// (function ($) {
//     "use strict";

//     $(document).ready(function () {
//        processing: true,
//         $.ajax({
//             url: "/visitors-users",
//             dataType: 'json',
//             success: function (response) {
//                 var dataSet = [];
//                 $.each(response, function (key, value) {
//                     if(value.admin == 1){
//                         value.admin = 'Sim'
//                     } else {
//                         value.admin = 'Não'
//                     }
//                     if(value.visitor == 1){
//                         value.visitor = 'Sim'
//                     } else {
//                         value.visitor = 'Não'
//                     }
//                     if(value.active == 1){
//                         value.active = 'Ativo'
//                     } else {
//                         value.active = 'Inativo'
//                     }

//                     dataSet.push([
//                         value.id,
//                         value.name,
//                         value.email,
//                         value.phone,
//                         value.admin,
//                         value.visitor,
//                         value.active,
//                         '<a href="/edit_visitor_user/'+ value.id +'" class="btn btn-sm btn-outline-warning border-0 shadow-sm">Editar <i class="text-secondary bi bi-pen"></i></a>'
//                     ]);

//                 })
//                 $('#table_user').DataTable( {
//                     "lengthMenu": [5, 10, 15, 20],
//                     "pageLength": 5,
//                     "language": {
//                         "lengthMenu": "Exibir _MENU_ Por Página",
//                         "zeroRecords": "Nothing found - sorry",
//                         "info": " Página _PAGE_ de _PAGES_",
//                         "infoEmpty": "No records available",
//                         "infoFiltered": "(filtered from _MAX_ total records)",
//                         "sSearchPlaceholder": "Buscar...",
//                     },

//                     data: dataSet,
//                     columns: [
//                         {title: '#'},
//                         {title: 'Nome'},
//                         {title: 'E-mail'},
//                         {title: 'Telefone'},
//                         {title: 'Admin'},
//                         {title: 'Visitante'},
//                         {title: 'status'},
//                         {title: 'Ação'},
//                     ]
//                 } );
//             },
//         });
//     } );

// })(jQuery);

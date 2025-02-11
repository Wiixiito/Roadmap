var porcentajes = null;


function LlenarTablaPorcentaje() {
    porcentajes = $('#porcentajes').DataTable({
        dom: 'Bfrtip',
         responsive: true,
          buttons: [
                {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4]
                },
                 filename: 'TablaPorcentajes'
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "processing": true,
        "serverSide": true,
        lengthMenu: [
            [200, 400, 600],
            [200, 400, 600]
        ],
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        " bFilter ": false,
        " bSort ": false,
        " bInfo ": false,
        " bAutoWidth ": false,
        "bLengthChange": false,
        "order": [],
        "ajax": {
            url: "Ajax/Aj_Revision.php",
            data: {
                Requerimiento: "ConsultarPorcentajes"
            },
            type: "POST"
        },
        scrollY: 380,
        scrollX: true,
        autoWidth: true,
        scroller: {
            loadingIndicator: true
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
           " className": 'select-checkbox',
           "visible" : false,
        }]
    });
}

LlenarTablaPorcentaje();
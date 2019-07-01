$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A3'
            },
            'print'
        ]
    });
});
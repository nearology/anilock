$('.export-table').DataTable({
    dom: 'Bfrtip',
    buttons: {
        buttons: [{
            extend: 'excel',
            text: 'فایل Excel',
            title: $('h1').text(),
            exportOptions: {
                columns: ':not(.no-print)'
            },
            footer: true
        }, {
            extend: 'csv',
            text: 'فایل Csv',
            title: $('h1').text(),
            exportOptions: {
                columns: ':not(.no-print)'
            },
            footer: true
        }, {
            extend: 'print',
            text: 'پرینت',
            title: $('h1').text(),
            exportOptions: {
                columns: ':not(.no-print)'
            },
            footer: true,
            autoPrint: true
        }],
        dom: {
            container: {
                className: 'dt-buttons'
            },
            button: {
                className: 'btn btn-primary'
            }
        }
    }
});

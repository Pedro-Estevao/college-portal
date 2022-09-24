$(function() {
    $('#card-boletim').on('click', function() {
        alert('Clicou no boletim');
    });

    $('#table-aluno').DataTable({
        language: {
            lengthMenu: 'Exibir _MENU_ registros',
            search: 'Buscar:',
            zeroRecords: 'Cliente não encontrado',
            info: '',
            infoEmpty: 'Não há registros disponíveis',
            infoFiltered: '(filtrado de _MAX_ registros totais)',
            paginate: {
                fist: 'Primeiro',
                last: 'Último',
                previous: 'Anterior',
                next: 'Próximo'
            }
        },
        columnDefs: [
            {width: "50%", targets: 0},
            {width: "30%", targets: 1},
            {width: "20%", targets: 2},
        ]
    });
});
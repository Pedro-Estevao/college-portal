$(function() {
    const include_path = $('base').attr('base');

    $('.body-content--table-row.devolutiva-trabalho').on('click', function() {
        let container = $(this).attr('data-trabalho');
        $('#modal-devolutiva-container-'+container).removeClass('d-none');
        let idTrabalho = $(this).attr('id').split('-')[1];
        let idUser = $(this).attr('id').split('-')[2];
        
        if(container == 'agc')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosTrabalhoDevolutiva: [
                        idTrabalho,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-agc .trabalhoDetails-idTrabalho--content').val(idTrabalho);
                $('#modal-devolutiva-container-agc .trabalhoDetails-idUser--content').val(idUser);
                $('#modal-devolutiva-container-agc .trabalhoDetails-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-agc .trabalhoDetails-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-agc .trabalhoDetails-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-agc .trabalhoDetails-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);

                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-situ-devo--content').text(data.Situacao);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-nota-devo--content').text(data.Nota);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-desc-devo--content').text(data.DescDevo);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-material-devo--content-link').text('Visualizar devolutiva').attr('href',include_path+'src/assets/uploads/'+data.MatDevo);
            });
            $('#materia-modal-devolutiva-trabalho-title').text('Corrigir Trabalho');
        }
        else if(container == 'cor')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosTrabalhoDevolutiva: [
                        idTrabalho,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-situ-devo--content').text(data.Situacao);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-nota-devo--content').text(data.Nota);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-desc-devo--content').text(data.DescDevo);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-material-devo--content-link').text('Visualizar devolutiva').attr('href',include_path+'src/assets/uploads/'+data.MatDevo);
            });
            $('#materia-modal-devolutiva-trabalho-title').text('Trabalho Corrigido');
        }

        $('#materia-modal-devolutiva-trabalho').modal('show');
    });
});

const formataData = (data) => {
    let dataHora = data.split(' ');
    let dataC = dataHora[0].split('-');
    let dataAno = dataC[0];
    let dataMes = dataC[1];
    let dataDia = dataC[2];
    let horaC = dataHora[1].split(':');
    let horaHora = horaC[0];
    let horaMin = horaC[1];

    let dataFormatada = dataDia+'/'+dataMes+'/'+dataAno;
    let horaFormatada = horaHora+':'+horaMin;

    return dataFormatada+' às '+horaFormatada;
}
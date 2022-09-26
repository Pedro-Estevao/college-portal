$(function() {
    const include_path = $('base').attr('base');
    
    $('#card-materias').on('click', function() {
        window.location.href = include_path+"materias";
    });
    // $('#card-trabalhos').on('click', function() {
    //     window.location.href = include_path+"trabalhos";
    // });
    // $('#card-provas').on('click', function() {
    //     window.location.href = include_path+"provas";
    // });
    
    $('.body-content--table-row.trabalho').on('click', function() {
        let container = $(this).attr('data-trabalho');
        $('#modal-devolutiva-container-'+container).removeClass('d-none');
        let idTrabalho = $(this).attr('id').split('-')[1];
        let idUser = $(this).attr('id').split('-')[2];

        if(container == 'abe'){
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosTrabalho: [
                        idTrabalho,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-abe .trabalhoDetails-idTrabalho--content').val(idTrabalho);
                $('#modal-devolutiva-container-abe .trabalhoDetails-idUser--content').val(idUser);
                $('#modal-devolutiva-container-abe .trabalhoDetails-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-abe .trabalhoDetails-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-abe .trabalhoDetails-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-abe .trabalhoDetails-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
            });
            $('#materia-modal-devolutiva-trabalho-title').text('Enviar Trabalho');
        }
        else if(container == 'agc')
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
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-idTrabalho--content').val(data.IdTrabalho);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-idUser--content').val(data.IdUser);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-situ-devo--content').text(data.Situacao);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-nota-devo--content').text(data.Nota);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-desc-devo--content').text(data.DescDevo);
                $('#modal-devolutiva-container-agc .trabalhoDetailsDevo-material-devo--content-link').text('Visualizar devolutiva').attr('href',include_path+'src/assets/uploads/'+data.MatDevo);
            });
            $('#materia-modal-devolutiva-trabalho-title').text('Aguardando Correção');
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
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-idTrabalho--content').val(data.IdTrabalho);
                $('#modal-devolutiva-container-cor .trabalhoDetailsDevo-idUser--content').val(data.IdUser);
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
        else if(container == 'ne')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosTrabalho: [
                        idTrabalho,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-idTrabalho--content').val(data.IdTrabalho);
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-idUser--content').val(data.IdUser);
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-ne .trabalhoDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
            });
            $('#materia-modal-devolutiva-trabalho-title').text('Trabalho Não Enviado');
        }

        $('#materia-modal-devolutiva-trabalho').modal('show');
    });

    $('.body-content--table-row.prova').on('click', function() {
        let container = $(this).attr('data-prova');
        $('#modal-devolutiva-container-prova-'+container).removeClass('d-none');
        let idProva = $(this).attr('id').split('-')[1];
        let idUser = $(this).attr('id').split('-')[2];

        if(container == 'abe'){
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosProva: [
                        idProva,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-prova-abe .provaDetails-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-prova-abe .provaDetails-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-prova-abe .provaDetails-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-prova-abe .provaDetails-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
            });
            $('#materia-modal-devolutiva-prova-title').text('Informações da Prova');
        }
        else if(container == 'agc')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosProvaDevolutiva: [
                        idProva,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-situ-devo--content').text(data.Situacao);
                $('#modal-devolutiva-container-prova-agc .provaDetailsDevo-nota-devo--content').text(data.Nota);
            });
            $('#materia-modal-devolutiva-prova-title').text('Aguardando Correção');
        }
        else if(container == 'cor')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosProvaDevolutiva: [
                        idProva,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-situ-devo--content').text((data.Situacao == 'CORRIGIDO') ? ('CORRIGIDA') : (''));
                $('#modal-devolutiva-container-prova-cor .provaDetailsDevo-nota-devo--content').text(data.Nota);
            });
            $('#materia-modal-devolutiva-prova-title').text('Prova Corrigida');
        }
        else if(container == 'nr')
        {
            $.ajax({
                beforeSend: function() {},
                url: include_path+'src/process/process.php',
                method: 'post',
                dataType: 'json',
                data: {
                    recuperaDadosProva: [
                        idProva,
                        idUser
                    ]
                }
            }).done(function(data) {
                $('#modal-devolutiva-container-prova-nr .provaDetailsDevo-title--content').text(data.Titulo);
                $('#modal-devolutiva-container-prova-nr .provaDetailsDevo-data--content').text(formataData(data.Data_final));
                $('#modal-devolutiva-container-prova-nr .provaDetailsDevo-desc--content').text(data.Descricao);
                $('#modal-devolutiva-container-prova-nr .provaDetailsDevo-material--content-link').text('Visualizar material de apoio').attr('href',include_path+'src/assets/uploads/'+data.Material);
            });
            $('#materia-modal-devolutiva-prova-title').text('Prova não Realizada');
        }

        $('#materia-modal-devolutiva-prova').modal('show');
    });

    $('#materia-modal-devolutiva-trabalho').on('hidden.bs.modal', function() {
        $('.modal-body--container.trabalho:not(.d-none)').addClass('d-none');
    });
    $('#materia-modal-devolutiva-prova').on('hidden.bs.modal', function() {
        $('.modal-body--container.prova:not(.d-none)').addClass('d-none');
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

const InputFile = (form,modal) => {
    const selectionProva = $(form+' .upload-container');
    fileInputProva = document.querySelector(form+' .upload-container--input');

    selectionProva.on('click', function() {
        fileInputProva.click();
    });

    fileInputProva.onchange = ({target}) => {
        $(form+' .upload-container').removeClass("selected");
        if($('#file-selected').length)
        {
            $('#file-selected').remove();
        };
        if($('#input-file--invalid-alert').length)
        {
            $('#input-file--invalid-alert').remove();
        };

        let file = target.files[0];

        if(file)
        {
            const acceptType = /(\.pdf)$/i;

            if(!acceptType.exec(file.name))
            {
                $(form+' .upload-container--uploaded').append('<p class="input-file--invalid-alert" id="input-file--invalid-alert">Formato inválido!</p>');
                fileInputProva.value = '';
                return false;
            }
            else
            {
                $(form+' .upload-container').addClass("selected");
                let fileName = file.name;
                let fileSize;
                let fileTotal = (file.size / 1024).toFixed(2);

                if(fileTotal < 1024)
                {
                    fileSize = fileTotal+" KB";
                }
                else
                {
                    fileSize = (fileTotal/1024).toFixed(2)+' MB';
                }

                $(form+' .upload-container--uploaded').append('<li class="row" id="file-selected"><div class="content upload"><i class="fas fa-file-alt"></i><div class="details"><span class="name">'+fileName+'</span><span class="size">'+fileSize+'</span></div></div><i class="fas fa-check"></i></li>');
                return true;
            }
        };
    };

    $(modal).on('hidden.bs.modal', function() {
        fileInputProva.value = '';
        $(form+' .upload-container').removeClass("selected");
        if($(form+' input').val())
        {
            $(form+' input').val('');
        }
        if($('#file-selected').length)
        {
            $('#file-selected').remove();
        };
        if($('#input-file--invalid-alert').length)
        {
            $('#input-file--invalid-alert').remove();
        };
    });
}

InputFile('.devolutiva-trabalho-form','#materia-modal-devolutiva-trabalho');
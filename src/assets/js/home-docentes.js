$(function() {
    const include_path = $('base').attr('base');

    $('#card-materias').on('click', function() {
        window.location.href = include_path+"materias";
    });
    // $('#card-trabalhos').on('click', function() {
    //     window.location.href = include_path+"trabalhos";
    // });

    const selectionTrabalho = $('.novo-trabalho-form .upload-container');
    fileInputTrabalho = document.querySelector('.novo-trabalho-form .upload-container--input');

    selectionTrabalho.on('click', function() {
        fileInputTrabalho.click();
    });

    fileInputTrabalho.onchange = ({target}) => {
        $('.novo-trabalho-form .upload-container').removeClass("selected");
        if($('#file-selected').length) {
            $('#file-selected').remove();
        };
        if($('#input-file--invalid-alert').length) {
            $('#input-file--invalid-alert').remove();
        };

        let file = target.files[0];

        if(file) {
            $('.novo-trabalho-form .upload-container').addClass("selected");

            const acceptType = /(\.pdf)$/i;

            if(!acceptType.exec(file.name)) {
                $('.novo-trabalho-form .upload-container--uploaded').append('<p class="input-file--invalid-alert" id="input-file--invalid-alert">Formato inválido!</p>');
                fileInput.value = '';
                return false;
            }else {
                let fileName = file.name;
                let fileSize;
                let fileTotal = (file.size / 1024).toFixed(2);

                if(fileTotal < 1024) {
                    fileSize = fileTotal+" KB";
                }else {
                    fileSize = (fileTotal/1024).toFixed(2)+' MB';
                }

                $('.novo-trabalho-form .upload-container--uploaded').append('<li class="row" id="file-selected"><div class="content upload"><i class="fas fa-file-alt"></i><div class="details"><span class="name">'+fileName+'</span><span class="size">'+fileSize+'</span></div></div><i class="fas fa-check"></i></li>');
                return true;
            }
        };
    };

    const selectionProva = $('.nova-prova-form .upload-container');
    fileInputProva = document.querySelector('.nova-prova-form .upload-container--input');

    selectionProva.on('click', function() {
        fileInputProva.click();
    });

    fileInputProva.onchange = ({target}) => {
        $('.nova-prova-form .upload-container').removeClass("selected");
        if($('#file-selected').length) {
            $('#file-selected').remove();
        };
        if($('#input-file--invalid-alert').length) {
            $('#input-file--invalid-alert').remove();
        };

        let file = target.files[0];

        if(file) {
            $('.nova-prova-form .upload-container').addClass("selected");

            const acceptType = /(\.pdf)$/i;

            if(!acceptType.exec(file.name)) {
                $('.nova-prova-form .upload-container--uploaded').append('<p class="input-file--invalid-alert" id="input-file--invalid-alert">Formato inválido!</p>');
                fileInput.value = '';
                return false;
            }else {
                let fileName = file.name;
                let fileSize;
                let fileTotal = (file.size / 1024).toFixed(2);

                if(fileTotal < 1024) {
                    fileSize = fileTotal+" KB";
                }else {
                    fileSize = (fileTotal/1024).toFixed(2)+' MB';
                }

                $('.nova-prova-form .upload-container--uploaded').append('<li class="row" id="file-selected"><div class="content upload"><i class="fas fa-file-alt"></i><div class="details"><span class="name">'+fileName+'</span><span class="size">'+fileSize+'</span></div></div><i class="fas fa-check"></i></li>');
                return true;
            }
        };
    };

    $('.body-content--table-row.trabalho .corrigir-trabalho').on('click', function() {
        let idTrabalho = $(this).attr('id').split('_')[1];
        let idMateria = $(this).attr('id').split('_')[2];
        window.location.href = include_path+'trabalhos?disciplina='+idMateria+'&trabalho='+idTrabalho;
    });
});
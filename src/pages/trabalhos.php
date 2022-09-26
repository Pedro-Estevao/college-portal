<?php
$disciplina = false;

if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];

    if($category == 'Aluno')
    {
        Controle::redirectAcessoNegado();
    }
}

if((isset($_GET['disciplina'])) && (isset($_GET['trabalho'])))
{
    $disciplina = true;
    $materia_id = intval($_GET['disciplina']);
    $trabalho_id = intval($_GET['trabalho']);

    $trabalhos = Trabalho::recuperaDevolutivas($materia_id,$trabalho_id);
}

if(isset($_POST['devolutiva-trabalho-submit']))
{
    Trabalho::enviaCorrecaoDevolucao('trabalhos?disciplina='.$materia_id.'&trabalho='.$trabalho_id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barão de Mauá :: PAINEL</title>
    <link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH; ?>src/assets/img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DataTable Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>src/assets/css/style.css" />
</head>
<body>
    <base base="<?php echo INCLUDE_PATH; ?>" />

    <?php include('src/pages/layout/header.php'); ?>

    <?php
        if (isset($_SESSION["mensagem-alert"]))
        {
            echo $_SESSION["mensagem-alert"];
            unset($_SESSION["mensagem-alert"]);
        }
    ?>

    <div class="cn-content--main">
        <main class="cn-main">
            <div class="cn-main-content container trabalhos-page">
                <?php if(($disciplina == true) && ($category == 'Professor')) { ?>
                    <nav aria-label="breadcrumb" class="cn-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo INCLUDE_PATH; ?>materias">Matérias</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo INCLUDE_PATH; ?>materias?disciplina=<?= $materia_id ?>"><?php echo Controle::recuperaDadosMateria($materia_id,'MATERIA'); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Devolutivas</li>
                        </ol>
                    </nav>
                <?php } ?>

                <div class="card cn-card" id="card-trabalhos">
                    <div class="card-body">
                        <div class="card-content d-flex flex-column">
                            <div class="card-content--header d-flex align-items-center justify-content-between">
                                <div class="card-content--header-title d-flex">
                                    <span class="title-text">Trabalhos</span>
                                </div>
                            </div>
                            <div class="card-content--body">
                                <?php if($disciplina == true) { ?>
                                <div class="body-content--table">
                                    <div class="body-content--table-header">
                                        <div class="table-header--caption">Status</div>
                                        <div class="table-header--caption">Trabalho</div>
                                        <div class="table-header--caption">Curso</div>
                                        <div class="table-header--caption trabalho-nota">Nota</div>
                                        <div class="table-header--caption">Data de Entrega</div>
                                    </div>
                                    <?php foreach($trabalhos as $key => $value) { ?>
                                    <a href="#" class="body-content--table-row devolutiva-trabalho" id="corrigir_trabalho-<?= $value['IdTrabalhoDevo'].'-'.$value['IdAluno'] ?>" <?= (Trabalho::verificaSituacaoDevolutiva($value['IdTrabalhoDevo'],$value['IdAluno']) == 'AGUARDANDO CORREÇÃO') ? ('data-trabalho="agc"') : ('data-trabalho="cor"') ?>>
                                        <div class="table-row--content">
                                            <div class="table-row--content-field status-field">
                                                <div class="status-field--icon <?= (Trabalho::verificaSituacaoDevolutiva($value['IdTrabalhoDevo'],$value['IdAluno']) == 'AGUARDANDO CORREÇÃO') ? ('warning') : ('success') ?>"></div>
                                                <div class="status-field--text"><span><?= (Trabalho::verificaSituacaoDevolutiva($value['IdTrabalhoDevo'],$value['IdAluno']) == 'AGUARDANDO CORREÇÃO') ? ('Aguardando Correção') : ('Corrigido') ?></span></div>
                                            </div>
                                            <div class="table-row--content-field"><span><?= $value['Titulo']; ?></span></div>
                                            <div class="table-row--content-field"><span><?= $value['Curso']; ?></span></div>
                                            <div class="table-row--content-field"><span class="trabalho-nota"><?= (Trabalho::verificaSituacaoDevolutiva($value['IdTrabalhoDevo'],$value['IdAluno']) == 'AGUARDANDO CORREÇÃO') ? ('---') : (Trabalho::recuperaNotaDevolutiva($value['IdTrabalhoDevo'],$value['IdAluno'])) ?></span></div>
                                            <div class="table-row--content-field"><span><?= date_format(date_create($value['Data_final']), 'd/m/Y').' às '.date_format(date_create($value['Data_final']), 'H:i'); ?></span></div>
                                        </div>
                                    </a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Entregar Trabalho -->
    <div class="cn-modal modal fade" id="materia-modal-devolutiva-trabalho" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="materia-modal-devolutiva-trabalho-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body--container trabalho d-none" id="modal-devolutiva-container-agc">
                        <div class="modal-body--container-trabalhoDetails">
                            <div class="trabalhoDetails-title">
                                <span class="trabalhoDetails-title--text">Trabalho</span>
                                <span class="trabalhoDetails-title--content"></span>
                            </div>
                            <div class="trabalhoDetails-data">
                                <span class="trabalhoDetails-data--text">Data de Entrega</span>
                                <span class="trabalhoDetails-data--content"></span>
                            </div>
                            <div class="trabalhoDetails-desc">
                                <span class="trabalhoDetails-desc--text">Orientações</span>
                                <span class="trabalhoDetails-desc--content"></span>
                            </div>
                            <div class="trabalhoDetails-material">
                                <span class="trabalhoDetails-material--text">Material de Apoio</span>
                                <span class="trabalhoDetails-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="trabalhoDetails-material--content-link"></a>
                                </span>
                            </div>

                            <div class="trabalhoDetailsDevo-situ-devo mt-4">
                                <span class="trabalhoDetailsDevo-situ-devo--text">Situação</span>
                                <span class="trabalhoDetailsDevo-situ-devo--content" style="background-color: #ffc107; color: #000; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-nota-devo">
                                <span class="trabalhoDetailsDevo-nota-devo--text">Nota</span>
                                <span class="trabalhoDetailsDevo-nota-devo--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-desc-devo">
                                <span class="trabalhoDetailsDevo-desc-devo--text">Descrição do Aluno</span>
                                <span class="trabalhoDetailsDevo-desc-devo--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-material-devo mb-4">
                                <span class="trabalhoDetailsDevo-material-devo--text">Devolução</span>
                                <span class="trabalhoDetailsDevo-material-devo--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="trabalhoDetailsDevo-material-devo--content-link"></a>
                                </span>
                            </div>
                        </div>
                        <form class="devolutiva-trabalho-form" id="devolutiva-trabalho-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="devolutiva-trabalho-id-trabalho" class="trabalhoDetails-idTrabalho--content" id="devolutiva-trabalho-id-trabalho" />
                            <input type="hidden" name="devolutiva-trabalho-id-user" class="trabalhoDetails-idUser--content" id="devolutiva-trabalho-id-user" />
                            <div class="form-group">
                                <input type="number" id="devolutiva-trabalho-nota" name="devolutiva-trabalho-nota" min="0" max="10" step="0.01" class="devolutiva-trabalho-form--input" placeholder="Informe a nota do trabalho" required />
                                <label for="devolutiva-trabalho-nota" class="devolutiva-trabalho-form--label">Nota</label>
                            </div>
                            <div class="form-group footer">
                                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="devolutiva-trabalho-submit" id="devolutiva-trabalho-submit" class="btn btn-primary save">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body--container trabalho d-none" id="modal-devolutiva-container-cor">
                        <div class="modal-body--container-trabalhoDetailsDevo">
                            <div class="trabalhoDetailsDevo-title">
                                <span class="trabalhoDetailsDevo-title--text">Trabalho</span>
                                <span class="trabalhoDetailsDevo-title--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-data">
                                <span class="trabalhoDetailsDevo-data--text">Data de Entrega</span>
                                <span class="trabalhoDetailsDevo-data--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-desc">
                                <span class="trabalhoDetailsDevo-desc--text">Orientações</span>
                                <span class="trabalhoDetailsDevo-desc--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-material">
                                <span class="trabalhoDetailsDevo-material--text">Material de Apoio</span>
                                <span class="trabalhoDetailsDevo-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="trabalhoDetailsDevo-material--content-link"></a>
                                </span>
                            </div>
                            <div class="trabalhoDetailsDevo-situ-devo mt-4">
                                <span class="trabalhoDetailsDevo-situ-devo--text">Situação</span>
                                <span class="trabalhoDetailsDevo-situ-devo--content" style="background-color: #1cd27e; color: #fff; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-nota-devo">
                                <span class="trabalhoDetailsDevo-nota-devo--text">Nota</span>
                                <span class="trabalhoDetailsDevo-nota-devo--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-desc-devo">
                                <span class="trabalhoDetailsDevo-desc-devo--text">Descrição</span>
                                <span class="trabalhoDetailsDevo-desc-devo--content"></span>
                            </div>
                            <div class="trabalhoDetailsDevo-material-devo mb-4">
                                <span class="trabalhoDetailsDevo-material-devo--text">Material de Apoio</span>
                                <span class="trabalhoDetailsDevo-material-devo--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="trabalhoDetailsDevo-material-devo--content-link"></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then JQuery Mask, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Style JS -->
    <script type="text/javascript" src="<?= INCLUDE_PATH; ?>src/assets/js/trabalhos.js"></script>
</body>
</html>
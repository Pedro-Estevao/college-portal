<?php
$disciplina = false;

if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];

    if($category == 'Aluno') 
    {
        $materias = Controle::listarMateriasAlunos(Controle::recuperaDadosMatricula($_SESSION['idUser'], 'CURSO'));
    }
    else
    {
        $materias = Controle::listarMateriasDocentes($_SESSION["idUser"]);
    }
}

if(isset($_GET['disciplina']))
{
    $disciplina = true;
    $materia_id = intval($_GET['disciplina']);

    $trabalhos = Trabalho::listarTrabalhos($materia_id);
    $provas = Prova::listarProvas($materia_id);
}

if(isset($_POST['novo-trabalho-submit']))
{
    Trabalho::verificaTrabalho('materias?disciplina='.$materia_id);
}
if(isset($_POST['nova-prova-submit']))
{
    Prova::verificaProva('materias?disciplina='.$materia_id);
}

if(isset($_POST['devolutiva-trabalho-submit']))
{
    Trabalho::verificaDevolutivaTrabalho('materias?disciplina='.$materia_id);
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
            <div class="cn-main-content container materias-page">
                <?php if($disciplina == true) { ?>
                    <nav aria-label="breadcrumb" class="cn-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo INCLUDE_PATH; ?>materias">Matérias</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo Controle::recuperaDadosMateria($materia_id,'MATERIA'); ?></li>
                        </ol>
                    </nav>
                <?php } ?>

                <?php if($disciplina == true) { ?>
                    <div class="cn-main-content--body">
                        <div class="card cn-card" id="card-materias-trabalhos">
                            <div class="card-body">
                                <div class="card-content d-flex flex-column">
                                    <div class="card-content--header d-flex align-items-center justify-content-between">
                                        <div class="card-content--header-title d-flex">
                                            <span class="title-text">Trabalhos</span>
                                        </div>
                                        <?php if($category == 'Professor') { ?>
                                        <div class="card-content--header-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materia-modal-novo-trabalho">Criar Trabalho</button>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-content--body">
                                        <div class="body-content--table">
                                            <div class="body-content--table-header">
                                                <div class="table-header--caption">Status</div>
                                                <div class="table-header--caption">Trabalho</div>
                                                <div class="table-header--caption <?= ($category == 'Professor') ? ('trabalho-devolutiva') : (null) ?>"><?= ($category == 'Aluno') ? ('Curso') : ('Devolutivas') ?></div>
                                                <div class="table-header--caption <?= ($category == 'Aluno') ? ('trabalho-nota') : (null) ?>"><?= ($category == 'Aluno') ? ('Nota') : ('Data de Entrega') ?></div>
                                                <div class="table-header--caption"><?= ($category == 'Aluno') ? ('Data de Entrega') : ('Corrigir') ?></div>
                                            </div>
                                            <?php if($category == 'Aluno') { ?>
                                                <?php foreach($trabalhos as $key => $value) { ?>
                                                <a href="#" class="body-content--table-row trabalho" id="trabalho-<?= $value['Id'].'-'.$_SESSION['idUser'] ?>" <?= (Trabalho::verificaExisteDevolutiva($value['Id'],$_SESSION['idUser'])) ? ((Trabalho::verificaSituacaoDevolutiva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('data-trabalho="agc"') : ('data-trabalho="cor"')) : ((Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('data-trabalho="abe"') : ('data-trabalho="ne"')) ?> >
                                                    <div class="table-row--content">
                                                        <div class="table-row--content-field status-field">
                                                            <div class="status-field--icon <?= (Trabalho::verificaExisteDevolutiva($value['Id'],$_SESSION['idUser'])) ? ((Trabalho::verificaSituacaoDevolutiva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('warning') : ('info')) : ((Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('success') : ('danger')) ?>"></div>
                                                            <div class="status-field--text"><span><?= (Trabalho::verificaExisteDevolutiva($value['Id'],$_SESSION['idUser'])) ? ((Trabalho::verificaSituacaoDevolutiva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('Aguardando Correção') : ('Corrigido')) : ((Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('Aberto') : ('Não Entregue')) ?></span></div>
                                                        </div>
                                                        <div class="table-row--content-field"><span><?= $value['Titulo']; echo Trabalho::verificaPrazoTrabalho($value['Id']); ?></span></div>
                                                        <div class="table-row--content-field"><span><?= $value['Curso']; ?></span></div>
                                                        <div class="table-row--content-field"><span class="trabalho-nota"><?= (Trabalho::verificaExisteDevolutiva($value['Id'],$_SESSION['idUser'])) ? ((Trabalho::verificaSituacaoDevolutiva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('---') : (Trabalho::recuperaNotaDevolutiva($value['Id'],$_SESSION['idUser']))) : ('---') ?></span></div>
                                                        <div class="table-row--content-field"><span><?= date_format(date_create($value['Data_final']), 'd/m/Y').' às '.date_format(date_create($value['Data_final']), 'H:i'); ?></span></div>
                                                    </div>
                                                </a>
                                                <?php } ?>
                                            <?php }else { ?>
                                                <?php foreach($trabalhos as $key => $value) { ?>
                                                <a href="#" class="body-content--table-row trabalho">
                                                    <div class="table-row--content">
                                                        <div class="table-row--content-field status-field">
                                                            <div class="status-field--icon <?= (Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('success') : ('danger') ?>"></div>
                                                            <div class="status-field--text"><span><?= (Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('Aberto') : ('Fechado') ?></span></div>
                                                        </div>
                                                        <div class="table-row--content-field"><span><?= $value['Titulo']; ?></span></div>
                                                        <div class="table-row--content-field"><span class="trabalho-devolutiva"><?= Trabalho::countDevolutivaTrabalhos($value['Id']); ?></span></div>
                                                        <div class="table-row--content-field"><span><?= date_format(date_create($value['Data_final']), 'd/m/Y').' às '.date_format(date_create($value['Data_final']), 'H:i'); ?></span></div>
                                                        <div class="table-row--content-field"><?= (Trabalho::verificaPrazoTrabalho($value['Id'])) ? ('<span>Aguarde o fechamento</span>') : ('<button type="button" class="btn btn-primary corrigir-trabalho" id="trabalho-aplicado_'.$value['Id'].'_'.$materia_id.'">Corrigir</button>') ?></div>
                                                    </div>
                                                </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card cn-card" id="card-materias-provas">
                            <div class="card-body">
                                <div class="card-content d-flex flex-column">
                                    <div class="card-content--header d-flex align-items-center justify-content-between">
                                        <div class="card-content--header-title d-flex">
                                            <span class="title-text">Provas</span>
                                        </div>
                                        <?php if($category == 'Professor') { ?>
                                        <div class="card-content--header-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materia-modal-nova-prova">Criar Prova</button>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-content--body">
                                        <div class="body-content--table">
                                            <div class="body-content--table-header">
                                                <div class="table-header--caption">Status</div>
                                                <div class="table-header--caption">Prova</div>
                                                <div class="table-header--caption <?= ($category == 'Professor') ? ('prova-correcao') : (null) ?>"><?= ($category == 'Aluno') ? ('Curso') : ('Corrigidas') ?></div>
                                                <div class="table-header--caption <?= ($category == 'Aluno') ? ('prova-nota') : (null) ?>"><?= ($category == 'Aluno') ? ('Nota') : ('Data de Entrega') ?></div>
                                                <div class="table-header--caption"><?= ($category == 'Aluno') ? ('Data de Entrega') : ('Corrigir') ?></div>
                                            </div>
                                            <?php if($category == 'Aluno') { ?>
                                                <?php foreach($provas as $key => $value) { ?>
                                                <a href="#" class="body-content--table-row prova" id="prova-<?= $value['Id'].'-'.$_SESSION['idUser'] ?>" <?= (Prova::verificaExisteCorrecao($value['Id'],$_SESSION['idUser'])) ? ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('data-prova="agc"') : ('data-prova="cor"')) : ((Prova::verificaPrazoProva($value['Id'])) ? ('data-prova="abe"') : ('data-prova="nr"')) ?>>
                                                    <div class="table-row--content">
                                                        <div class="table-row--content-field status-field">
                                                            <div class="status-field--icon <?= (Prova::verificaPrazoProva($value['Id'])) ? ('success') : ((Prova::verificaExisteCorrecao($value['Id'],$_SESSION['idUser'])) ? ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('warning') : ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'CORRIGIDO') ? ('info') : ('danger'))) : ('danger')) ?>"></div>
                                                            <div class="status-field--text"><span><?= (Prova::verificaPrazoProva($value['Id'])) ? ('Não Aplicada') : ((Prova::verificaExisteCorrecao($value['Id'],$_SESSION['idUser'])) ? ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('Aguardando Correção') : ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'CORRIGIDO') ? ('Corrigida') : (Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser'])))) : ('Aplicada')) ?></span></div>
                                                        </div>
                                                        <div class="table-row--content-field"><span><?= $value['Titulo']; ?></span></div>
                                                        <div class="table-row--content-field"><span><?= $value['Curso']; ?></span></div>
                                                        <div class="table-row--content-field"><span class="prova-nota"><?= (Prova::verificaExisteCorrecao($value['Id'],$_SESSION['idUser'])) ? ((Prova::verificaSituacaoProva($value['Id'],$_SESSION['idUser']) == 'AGUARDANDO CORREÇÃO') ? ('---') : (Prova::recuperaNotaProva($value['Id'],$_SESSION['idUser']))) : ('---') ?></span></div>
                                                        <div class="table-row--content-field"><span><?= date_format(date_create($value['Data']), 'd/m/Y').' às '.date_format(date_create($value['Data']), 'H:i'); ?></span></div>
                                                    </div>
                                                </a>
                                                <?php } ?>
                                            <?php }else { ?>
                                                <?php foreach($provas as $key => $value) { ?>
                                                <a href="#" class="body-content--table-row prova">
                                                    <div class="table-row--content">
                                                        <div class="table-row--content-field status-field">
                                                            <div class="status-field--icon <?= (Prova::verificaPrazoProva($value['Id'])) ? ('success') : ('danger') ?>"></div>
                                                            <div class="status-field--text"><span><?= (Prova::verificaPrazoProva($value['Id'])) ? ('Não Aplicada') : ('Aplicada') ?></span></div>
                                                        </div>
                                                        <div class="table-row--content-field"><span><?= $value['Titulo']; ?></span></div>
                                                        <div class="table-row--content-field"><span class="prova-correcao"><?= Prova::countRealizacaoProvas($value['Id']); ?></span></div>
                                                        <div class="table-row--content-field"><span><?= date_format(date_create($value['Data']), 'd/m/Y').' às '.date_format(date_create($value['Data']), 'H:i'); ?></span></div>
                                                        <div class="table-row--content-field"><?= (Prova::verificaPrazoProva($value['Id'])) ? ('<span>Aguarde a aplicação</span>') : ('<button type="button" class="btn btn-primary corrigir-trabalho" id="prova-aplicada-'.$value['Id'].'">Corrigir</button>') ?></div>
                                                    </div>
                                                </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="cn-main-content--cards">
                        <?php foreach($materias as $key => $value) { ?>
                            <div class="card cn-card" title="<?php echo $value['MATERIA']; ?>" onclick="window.location.href='<?php echo INCLUDE_PATH.'materias?disciplina='.$value['ID']; ?>';">
                                <div class="card-body">
                                    <div class="card-content d-flex flex-column">
                                        <div class="card-content--image">
                                            <img src="<?php echo INCLUDE_PATH; ?>src/assets/img/diciplinas/<?php echo $value['IMG']; ?>" alt="" />
                                        </div>
                                        <div class="card-content--info">
                                            <div class="card-content--info-course">
                                                <span class=""><?php echo $value['CURSO']; ?></span>
                                            </div>
                                            <div class="card-content--info-matter">
                                                <span class=""><?php echo $value['MATERIA']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>

    <?php if(($disciplina == true) && ($category == 'Professor')) { ?>
    <!-- Modal Novo Trabalho -->
    <div class="cn-modal modal fade" id="materia-modal-novo-trabalho" tabindex="-1" role="dialog" aria-labelledby="materia-modal-novo-trabalho-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="materia-modal-novo-trabalho-label">Criar Trabalho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="novo-trabalho-form" id="novo-trabalho-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-0">
                            <input type="text" id="novo-trabalho-titulo" name="novo-trabalho-titulo" class="novo-trabalho-form--input" placeholder="Informe o título" required />
                            <label for="novo-trabalho-titulo" class="novo-trabalho-form--label">Título</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="novo-trabalho-descricao" name="novo-trabalho-descricao" class="novo-trabalho-form--input" placeholder="Dê uma breve descrição" required />
                            <label for="novo-trabalho-descricao" class="novo-trabalho-form--label">Descrição</label>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" id="novo-trabalho-data-final" name="novo-trabalho-data-final" class="novo-trabalho-form--input" placeholder="Informe a data final" required />
                            <label for="novo-trabalho-data-final" class="novo-trabalho-form--label">Data Final</label>
                        </div>
                        <div class="form-group upload mb-5">
                            <div class="upload-container">
                                <input type="file" id="novo-trabalho-material" name="novo-trabalho-material" class="upload-container--input" accept="application/pdf">
                                <i class="upload-container--icon fas fa-cloud-upload-alt"></i>
                                <p class="upload-container--text">Enviar Apoio</p>
                            </div>
                            <div class="upload-container--uploaded"></div>
                        </div>
                        <div class="form-group footer">
                            <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="novo-trabalho-submit" id="novo-trabalho-submit" class="btn btn-primary save">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nova Prova -->
    <div class="cn-modal modal fade" id="materia-modal-nova-prova" tabindex="-1" role="dialog" aria-labelledby="materia-modal-nova-prova-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="materia-modal-nova-prova-label">Criar Prova</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="nova-prova-form" id="nova-prova-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-0">
                            <input type="text" id="nova-prova-titulo" name="nova-prova-titulo" class="nova-prova-form--input" placeholder="Informe o título" required />
                            <label for="nova-prova-titulo" class="nova-prova-form--label">Título</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="nova-prova-descricao" name="nova-prova-descricao" class="nova-prova-form--input" placeholder="Dê uma breve descrição" required />
                            <label for="nova-prova-descricao" class="nova-prova-form--label">Descrição</label>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" id="nova-prova-data" name="nova-prova-data" class="nova-prova-form--input" placeholder="Informe a data final" required />
                            <label for="nova-prova-data" class="nova-prova-form--label">Data Final</label>
                        </div>
                        <div class="form-group upload mb-5">
                            <div class="upload-container">
                                <input type="file" id="nova-prova-material" name="nova-prova-material" class="upload-container--input" accept="application/pdf">
                                <i class="upload-container--icon fas fa-cloud-upload-alt"></i>
                                <p class="upload-container--text">Enviar Apoio</p>
                            </div>
                            <div class="upload-container--uploaded"></div>
                        </div>
                        <div class="form-group footer">
                            <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="nova-prova-submit" id="nova-prova-submit" class="btn btn-primary save">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if(($disciplina == true) && ($category == 'Aluno')) { ?>
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
                    <div class="modal-body--container trabalho d-none" id="modal-devolutiva-container-abe">
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
                        </div>
                        <form class="devolutiva-trabalho-form" id="devolutiva-trabalho-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="devolutiva-trabalho-id-trabalho" class="trabalhoDetails-idTrabalho--content" id="devolutiva-trabalho-id-trabalho" />
                            <input type="hidden" name="devolutiva-trabalho-id-user" class="trabalhoDetails-idUser--content" id="devolutiva-trabalho-id-user" />
                            <div class="form-group">
                                <input type="text" id="devolutiva-trabalho-descricao" name="devolutiva-trabalho-descricao" class="devolutiva-trabalho-form--input" placeholder="Dê uma breve descrição" required />
                                <label for="devolutiva-trabalho-descricao" class="devolutiva-trabalho-form--label">Descrição</label>
                            </div>
                            <div class="form-group upload">
                                <div class="upload-container">
                                    <input type="file" id="devolutiva-trabalho-material" name="devolutiva-trabalho-material" class="upload-container--input" accept="application/pdf" required>
                                    <i class="upload-container--icon fas fa-cloud-upload-alt"></i>
                                    <p class="upload-container--text">Enviar Arquivo</p>
                                </div>
                                <div class="upload-container--uploaded"></div>
                            </div>
                            <div class="form-group footer">
                                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="devolutiva-trabalho-submit" id="devolutiva-trabalho-submit" class="btn btn-primary save">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body--container trabalho d-none" id="modal-devolutiva-container-agc">
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
                                <span class="trabalhoDetailsDevo-situ-devo--content" style="background-color: #ffc107; color: #000; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;"></span>
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
                                <span class="trabalhoDetailsDevo-material-devo--text">Arquivo Enviado</span>
                                <span class="trabalhoDetailsDevo-material-devo--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="trabalhoDetailsDevo-material-devo--content-link"></a>
                                </span>
                            </div>
                        </div>
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
                    <div class="modal-body--container trabalho d-none" id="modal-devolutiva-container-ne">
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
                            <div class="trabalhoDetailsDevo-situ-devo mt-4 mb-4">
                                <span class="trabalhoDetailsDevo-situ-devo--text">Situação</span>
                                <span class="trabalhoDetailsDevo-situ-devo--content" style="background-color: #dc3545; color: #fff; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;">Trabalho não entregue</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info Prova -->
    <div class="cn-modal modal fade" id="materia-modal-devolutiva-prova" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="materia-modal-devolutiva-prova-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body--container prova d-none" id="modal-devolutiva-container-prova-abe">
                        <div class="modal-body--container-provaDetails">
                            <div class="provaDetails-title">
                                <span class="provaDetails-title--text">Prova</span>
                                <span class="provaDetails-title--content"></span>
                            </div>
                            <div class="provaDetails-data">
                                <span class="provaDetails-data--text">Data de Aplicação</span>
                                <span class="provaDetails-data--content"></span>
                            </div>
                            <div class="provaDetails-desc">
                                <span class="provaDetails-desc--text">Orientações</span>
                                <span class="provaDetails-desc--content"></span>
                            </div>
                            <div class="provaDetails-material mb-4">
                                <span class="provaDetails-material--text">Material de Apoio</span>
                                <span class="provaDetails-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="provaDetails-material--content-link"></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body--container prova d-none" id="modal-devolutiva-container-prova-agc">
                        <div class="modal-body--container-provaDetailsDevo">
                            <div class="provaDetailsDevo-title">
                                <span class="provaDetailsDevo-title--text">Prova</span>
                                <span class="provaDetailsDevo-title--content"></span>
                            </div>
                            <div class="provaDetailsDevo-data">
                                <span class="provaDetailsDevo-data--text">Data de Aplicação</span>
                                <span class="provaDetailsDevo-data--content"></span>
                            </div>
                            <div class="provaDetailsDevo-desc">
                                <span class="provaDetailsDevo-desc--text">Orientações</span>
                                <span class="provaDetailsDevo-desc--content"></span>
                            </div>
                            <div class="provaDetailsDevo-material">
                                <span class="provaDetailsDevo-material--text">Material de Apoio</span>
                                <span class="provaDetailsDevo-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="provaDetailsDevo-material--content-link"></a>
                                </span>
                            </div>
                            <div class="provaDetailsDevo-situ-devo mt-4">
                                <span class="provaDetailsDevo-situ-devo--text">Situação</span>
                                <span class="provaDetailsDevo-situ-devo--content" style="background-color: #ffc107; color: #000; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;"></span>
                            </div>
                            <div class="provaDetailsDevo-nota-devomb-4">
                                <span class="provaDetailsDevo-nota-devo--text">Nota</span>
                                <span class="provaDetailsDevo-nota-devo--content"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body--container prova d-none" id="modal-devolutiva-container-prova-cor">
                        <div class="modal-body--container-provaDetailsDevo">
                            <div class="provaDetailsDevo-title">
                                <span class="provaDetailsDevo-title--text">Prova</span>
                                <span class="provaDetailsDevo-title--content"></span>
                            </div>
                            <div class="provaDetailsDevo-data">
                                <span class="provaDetailsDevo-data--text">Data de Aplicação</span>
                                <span class="provaDetailsDevo-data--content"></span>
                            </div>
                            <div class="provaDetailsDevo-desc">
                                <span class="provaDetailsDevo-desc--text">Orientações</span>
                                <span class="provaDetailsDevo-desc--content"></span>
                            </div>
                            <div class="provaDetailsDevo-material">
                                <span class="provaDetailsDevo-material--text">Material de Apoio</span>
                                <span class="provaDetailsDevo-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="provaDetailsDevo-material--content-link"></a>
                                </span>
                            </div>
                            <div class="provaDetailsDevo-situ-devo mt-4">
                                <span class="provaDetailsDevo-situ-devo--text">Situação</span>
                                <span class="provaDetailsDevo-situ-devo--content" style="background-color: #1cd27e; color: #fff; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;"></span>
                            </div>
                            <div class="provaDetailsDevo-nota-devo mb-4">
                                <span class="provaDetailsDevo-nota-devo--text">Nota</span>
                                <span class="provaDetailsDevo-nota-devo--content"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body--container prova d-none" id="modal-devolutiva-container-prova-nr">
                        <div class="modal-body--container-provaDetailsDevo">
                            <div class="provaDetailsDevo-title">
                                <span class="provaDetailsDevo-title--text">Prova</span>
                                <span class="provaDetailsDevo-title--content"></span>
                            </div>
                            <div class="provaDetailsDevo-data">
                                <span class="provaDetailsDevo-data--text">Data de Aplicação</span>
                                <span class="provaDetailsDevo-data--content"></span>
                            </div>
                            <div class="provaDetailsDevo-desc">
                                <span class="provaDetailsDevo-desc--text">Orientações</span>
                                <span class="provaDetailsDevo-desc--content"></span>
                            </div>
                            <div class="provaDetailsDevo-material">
                                <span class="provaDetailsDevo-material--text">Material de Apoio</span>
                                <span class="provaDetailsDevo-material--content">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <a href="#" target="_blank" class="provaDetailsDevo-material--content-link"></a>
                                </span>
                            </div>
                            <div class="provaDetailsDevo-situ-devo mt-4 mb-4">
                                <span class="provaDetailsDevo-situ-devo--text">Situação</span>
                                <span class="provaDetailsDevo-situ-devo--content" style="background-color: #dc3545; color: #fff; padding: 2px 5px 0px 5px; border-radius: 3px; width: fit-content;">Você não realizou esta prova</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- jQuery first, then JQuery Mask, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Style JS -->
    <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/<?php echo ($category === 'Aluno') ? ("home-alunos.js") : ("home-docentes.js"); ?>"></script>
</body>
</html>
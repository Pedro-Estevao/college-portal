<?php 
if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];
}
?>

<div class="card cn-card" id="card-materias-trabalhos">
    <div class="card-body">
        <div class="card-content d-flex flex-column">
            <div class="card-content--header d-flex align-items-center justify-content-between">
                <div class="card-content--header-title d-flex">
                    <span class="title-text">Trabalhos</span>
                </div>
                <div class="card-content--header-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materia-modal-novo-trabalho">Criar Trabalho</button>
                </div>
            </div>
            <div class="card-content--body">
                <div class="body-content--table">
                    <div class="body-content--table-header">
                        <div class="table-header--caption">Status</div>
                        <div class="table-header--caption">Trabalho</div>
                        <div class="table-header--caption">Curso</div>
                        <div class="table-header--caption">Devolutivas</div>
                        <div class="table-header--caption">Data de Entrega</div>
                    </div>
                    <?php foreach($trabalhos as $key => $value) { ?>
                    <a href="#" class="body-content--table-row">
                        <div class="table-row--content">
                            <div class="table-row--content-field status-field">
                                <div class="status-field--icon <?php echo (Controle::verificaPrazo(date('d/m/Y H:i'),date_format(date_create($value['Data_final']), 'd/m/Y H:i'))) ? ('success') : ('danger'); ?>"></div>
                                <div class="status-field--text"><?php echo (Controle::verificaPrazo(date('d/m/Y H:i'),date_format(date_create($value['Data_final']), 'd/m/Y H:i'))) ? ('Aberto') : ('Fechado'); ?></div>
                            </div>
                            <div class="table-row--content-field"><?php echo $value['Titulo']; ?></div>
                            <div class="table-row--content-field"><?php echo $value['Curso']; ?></div>
                            <div class="table-row--content-field"><?php echo Trabalho::countDevolutivaTrabalhos($value['Curso']); ?></div>
                            <div class="table-row--content-field"><?php echo date_format(date_create($value['Data_final']), 'd/m/Y').' às '.date_format(date_create($value['Data_final']), 'H:i'); ?></div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];
}
?>

<div class="cn-main-content--cards">
    <div class="card cn-card" id="card-materias">
        <div class="card-body">
            <div class="card-content d-flex">
                <div class="card-content--icone d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-chalkboard-user text-success"></i>
                    <div class="card-content--icone-fill bg-success"></div>
                </div>
                <div class="card-content--info w-100 d-flex flex-column">
                    <span class="card-content--info-title">Matérias</span>
                    <h3 class="card-content--info-number d-flex align-items-center"><?= Controle::countMateriasVinculadas($category,$_SESSION['idUser']) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card cn-card" id="card-trabalhos">
        <div class="card-body">
            <div class="card-content d-flex">
                <div class="card-content--icone d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-file-lines text-warning"></i>
                    <div class="card-content--icone-fill bg-warning"></div>
                </div>
                <div class="card-content--info w-100 d-flex flex-column">
                    <span class="card-content--info-title">Trabalhos</span>
                    <h3 class="card-content--info-number d-flex align-items-center"><?= Controle::countTrabalhosVinculados($category,$_SESSION['idUser']) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card cn-card" id="<?php echo ($category === 'Aluno') ? ("card-provas") : ("card-alunos-dp"); ?>">
        <div class="card-body">
            <div class="card-content d-flex">
                <div class="card-content--icone d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-users-rectangle text-danger"></i>
                    <div class="card-content--icone-fill bg-danger"></div>
                </div>
                <div class="card-content--info w-100 d-flex flex-column">
                    <span class="card-content--info-title"><?php echo ($category === 'Aluno') ? ("Próxima Prova") : ("Alunos em DP"); ?></span>
                    <h3 class="card-content--info-number d-flex align-items-center"><?= ($category === 'Aluno') ? (date_format(date_create(Controle::dataProximaProva($_SESSION['idUser'])), 'd').' de '.date_format(date_create(Controle::dataProximaProva($_SESSION['idUser'])), 'M')) : (Controle::countAlunosEmDP($_SESSION['idUser'])); ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card cn-card" id="<?php echo ($category === 'Aluno') ? ("card-boletim") : ("card-novo-trabalho"); ?>">
        <div class="card-body">
            <div class="card-content d-flex">
                <div class="card-content--icone d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-file-circle-plus text-fill"></i>
                    <div class="card-content--icone-fill"></div>
                </div>
                <div class="card-content--info w-100 d-flex align-items-center">
                    <span><?php echo ($category === 'Aluno') ? ("Gerar Boletim") : ("Criar Trabalho"); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
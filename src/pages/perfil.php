<?php
if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];

    if($category == 'Aluno')
    {
        $dados = Controle::recuperaConfigUserAluno($_SESSION['idUser']);
    }
    else
    {
        $dados = Controle::recuperaConfigUserProfessor($_SESSION['idUser']);
    }
}

if(isset($_POST['update-info-user-submit']))
{
    // Controle::updateConfigUserAluno();
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
            <div class="cn-main-content container perfil-page">
                <div class="card cn-card perfil-card">
                    <div class="card-body">
                        <div class="perfil-card--image">
                            <div class="perfil-card--image-content">
                                <div class="perfil-card--image-content__moldura">
                                    <img class="perfil-card--image-content__moldura--container" src="<?php echo INCLUDE_PATH; ?>src/assets/img/mold-3.png" />
                                    <div class="perfil-card--image-content__moldura-content">
                                        <img class="" src="<?php echo INCLUDE_PATH; ?>src/assets/img/usuarios/<?= $dados['IMG'] ?>" alt="Imagem Perfil" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="perfil-card--image-name">
                                <h3 class="perfil-name mb-0">Pedro Estevão Paulista</h3>
                                <p class="perfil-curso mb-0">Ciência da Computação</p>
                            </div> -->
                        </div>
                        <div class="perfil-card--info">
                            <form class="info-form" id="">
                                <input type="hidden" name="perfil-id" value="<?= $dados['ID'] ?>" />
                                <div class="form-group">
                                    <input type="text" id="perfil-nome" name="perfil-nome" class="info-form--input" placeholder="Informe o nome" value="<?= $dados['NOME'] ?>" required />
                                    <label for="perfil-nome" class="info-form--label">Nome</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="perfil-email" name="perfil-email" class="info-form--input" placeholder="Informe o e-mail" value="<?= $dados['EMAIL'] ?>" required />
                                    <label for="perfil-email" class="info-form--label">E-mail</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="perfil-telefone" name="perfil-telefone" class="info-form--input" placeholder="Informe o telefone" value="<?= $dados['TELEFONE'] ?>" required />
                                    <label for="perfil-telefone" class="info-form--label">Telefone</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="perfil-pass" name="perfil-pass" class="info-form--input" placeholder="Informe a nova senha" />
                                    <label for="perfil-pass" class="info-form--label">Senha</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="update-info-user-submit" class="btn btn-default info-form--submit mb-0">SALVAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- jQuery first, then JQuery Mask, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Style JS -->
    <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/<?php echo ($category === 'Aluno') ? ("home-alunos.js") : ("home-docentes.js"); ?>"></script>
</body>
</html>
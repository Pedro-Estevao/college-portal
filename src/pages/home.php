<?php
    if(isset($_SESSION['category']))
    {
        $category = $_SESSION['category'];
    }

    if (isset($_GET['loggout']))
    {
        Controle::loggout();
    }

    // if(isset($_POST['btn-cadastrar-cliente'])) {
    //     Cliente::verificaCliente();
    // }
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

    <div class="cn-content--header">
        <header class="cn-content__header container">
            <div class="cn-content__header-wrapper">
                <div class="cn-content__header-wrapper__logo">
                    <a class="cn-content__header-wrapper__logo--link" rel="nofollow" href="<?php echo INCLUDE_PATH; ?>" title="Voltar a página inicial">
                        <img class="cn-content__header-wrapper__logo-img" src="<?php echo INCLUDE_PATH; ?>src/assets/img/logo-extend.jpg" alt="Universidade Barão de Mauá" title="Universidade Barão de Mauá">
                    </a>
                </div>
                <nav class="navbar navbar-expand-sm">
                    <ul class="cn-content__header-wrapper__menu mb-0">
                        <li class="cn-content__header-wrapper__menu--item desktop">
                            <a class="cn-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>">Home</a>
                        </li>
                        <li class="cn-content__header-wrapper__menu--item desktop">
                            <a class="cn-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>materias">Matérias</a>
                        </li>
                        <li class="cn-content__header-wrapper__menu--item desktop">
                            <a class="cn-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>chat">Chat da Sala</a>
                        </li>
                        <li class="cn-content__header-wrapper__menu--item desktop notification">
                            <div class="navbar-collapse" id="navbar-list-notification">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown notification">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotificationLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-bell"></i>
                                        </a>
                                        <div class="dropdown-menu notification" aria-labelledby="navbarDropdownNotificationLink">
                                            <a class="cn-content__header-wrapper__menu--item-link dropdown-item" href="#" role="button"><scan>Sem notificações!</scan></a>
                                            <!-- <div class="dropdown-divider"></div>
                                            <a class="cn-content__header-wrapper__menu--item-link dropdown-item" href="<?php echo INCLUDE_PATH; ?>?loggout"><i class="fa-solid fa-right-from-bracket"></i><span>Sair</span></a> -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="cn-content__header-wrapper__menu--item desktop menu">
                            <div class="navbar-collapse" id="navbar-list">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="cn-content__header-wrapper__menu--item-link mobile dropdown-item" href="<?php echo INCLUDE_PATH; ?>"><i class="fa-solid fa-house"></i><span>Home</span></a>
                                            <a class="cn-content__header-wrapper__menu--item-link mobile dropdown-item" href="<?php echo INCLUDE_PATH; ?>materias"><i class="fa-solid fa-book"></i><span>Matérias</span></a>
                                            <a class="cn-content__header-wrapper__menu--item-link mobile dropdown-item" href="<?php echo INCLUDE_PATH; ?>chat"><i class="fa-solid fa-message"></i><span>Chat da Sala</span></a>
                                            <div class="dropdown-divider mobile"></div>
                                            <a class="cn-content__header-wrapper__menu--item-link dropdown-item" href="<?php echo INCLUDE_PATH; ?>perfil"><i class="fa-solid fa-user"></i><span>Meu Perfil</span></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="cn-content__header-wrapper__menu--item-link dropdown-item" href="<?php echo INCLUDE_PATH; ?>?loggout"><i class="fa-solid fa-right-from-bracket"></i><span>Sair</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>

    <?php
        if (isset($_SESSION["mensagem-alert"]))
        {
            echo $_SESSION["mensagem-alert"];
            unset($_SESSION["mensagem-alert"]);
        }
    ?>

    <div class="cn-content--main">
        <main class="cn-main">
            <div class="cn-main-content container">
                <div class="cn-main-content--cards">
                    <div class="card cn-card">
                        <div class="card-content d-flex">
                            <div class="card-content--icone d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-chalkboard-user text-success"></i>
                                <div class="card-content--icone-fill bg-success"></div>
                            </div>
                            <div class="card-content--info w-100 d-flex flex-column">
                                <span class="card-content--info-title">Matérias</span>
                                <h3 class="card-content--info-number d-flex align-items-center">4</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card cn-card">
                        <div class="card-content d-flex">
                            <div class="card-content--icone d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-file-lines text-warning"></i>
                                <div class="card-content--icone-fill bg-warning"></div>
                            </div>
                            <div class="card-content--info w-100 d-flex flex-column">
                                <span class="card-content--info-title">Trabalhos</span>
                                <h3 class="card-content--info-number d-flex align-items-center">4</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card cn-card">
                        <div class="card-content d-flex">
                            <div class="card-content--icone d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users-rectangle text-danger"></i>
                                <div class="card-content--icone-fill bg-danger"></div>
                            </div>
                            <div class="card-content--info w-100 d-flex flex-column">
                                <span class="card-content--info-title">Alunos em DP</span>
                                <h3 class="card-content--info-number d-flex align-items-center">4</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card cn-card">
                        <div class="card-content d-flex">
                            <div class="card-content--icone d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-file-circle-plus text-fill"></i>
                                <div class="card-content--icone-fill"></div>
                            </div>
                            <div class="card-content--info w-100 d-flex align-items-center">
                                <span>Criar Trabalho</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cn-main-content--body">
                    <div class="row">
                        <div class="col col-sm-9">
                            <div class="card cn-card">
                                <?php if($category == 'Aluno'){ ?>
                                    <canvas id="chartAluno" class="cn-chart" width="400" height="400"></canvas>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="card cn-card">
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                                <p>Apenas teste</p>
                            </div>
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

    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Style JS -->
    <!-- <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/file_input.js"></script> -->
    <script type="module" src="<?php echo INCLUDE_PATH; ?>src/assets/js/initialize-chartjs.js"></script>
    <!-- <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/style.js"></script> -->
</body>
</html>
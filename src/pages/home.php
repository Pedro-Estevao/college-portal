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

    <div class="ad-content--header">
        <header class="ad-content__header container">
            <div class="ad-content__header-wrapper">
                <div class="ad-content__header-wrapper__logo">
                    <a class="ad-content__header-wrapper__logo--link"rel="nofollow" href="<?php echo INCLUDE_PATH; ?>" title="Voltar a página inicial">
                        <img class="ad-content__header-wrapper__logo-img" src="<?php echo INCLUDE_PATH; ?>src/assets/img/logo.png" alt="Especializada em Toldos, Cortinas, Motorização e Automação - AD- Lux" title="Especializada em Toldos, Cortinas, Motorização e Automação - AD- Lux">
                    </a>
                </div>
                <div class="ad-content__header-wrapper__menu">
                    <li class="ad-content__header-wrapper__menu--item desktop">
                        <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>">Home</a>
                    </li>
                    <li class="ad-content__header-wrapper__menu--item desktop">
                        <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>clientes">Clientes</a>
                    </li>
                    <li class="ad-content__header-wrapper__menu--item desktop">
                        <a class="ad-content__header-wrapper__menu--item-link" target="_blank" href="<?php echo INCLUDE_PATH; ?>visualizar">Ver PDF atual</a>
                    </li>
                    <li class="ad-content__header-wrapper__menu--item desktop">
                        <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>?loggout">Sair</a>
                    </li>
                    <li class="ad-content__header-wrapper__menu--item mobile">
                        <span class="ad-content__header-wrapper__menu--item-link" id="btn-show-menu-mobile">
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </li>
                </div>
                <div class="ad-content__header-wrapper__menu--mobile d-none" id="menu-mobile">
                    <div class="ad-content__header-wrapper__menu--mobile-background" id="area-close-menu-mobile"></div>
                    <div class="ad-content__header-wrapper__menu--mobile-box">
                        <div class="ad-content__header-wrapper__menu--mobile-box__header">
                            <h3 class="ad-content__header-wrapper__menu--mobile-box__header--title">Menu</h3>
                            <span class="ad-content__header-wrapper__menu--mobile-box__header--btn-close" id="btn-close-menu-mobile">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                        </div>
                        <div class="ad-content__header-wrapper__menu--mobile-box__main">
                            <li class="ad-content__header-wrapper__menu--item mobile">
                                <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>">Home</a>
                            </li>
                            <li class="ad-content__header-wrapper__menu--item mobile">
                                <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>clientes">Clientes</a>
                            </li>
                            <li class="ad-content__header-wrapper__menu--item mobile">
                                <a class="ad-content__header-wrapper__menu--item-link" target="_blank" href="<?php echo INCLUDE_PATH; ?>visualizar">Ver PDF atual</a>
                            </li>
                            <div class="ad-content__header-wrapper__menu--divisor"></div>
                            <li class="ad-content__header-wrapper__menu--item mobile">
                                <a class="ad-content__header-wrapper__menu--item-link" href="<?php echo INCLUDE_PATH; ?>?loggout">Sair</a>
                            </li>
                        </div>
                    </div>
                </div>
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

    <div class="ad-content--main">
        <div class="ad-content__main container">
            <div class="ad-content__main-wrapper">
                <div class="ad-content__main-wrapper__area">
                    <h5 class="ad-content__main-wrapper__area--title">Cadastrar Cliente <?php echo $category; ?></h5>
                    <form class="ad-content__main-wrapper__area--form" id="cliente-form" method="POST">    
                        <div class="ad-content__main-wrapper__area--form-group--input">
                            <input type="text" id="cliente-nome" name="cliente-nome" class="ad-content__main-wrapper__area--form-group--input-text" placeholder="Informe o nome" required />
                            <label for="cliente-nome" class="ad-content__main-wrapper__area--form-group--input-label">Nome</label>
                        </div>
                        <div class="ad-content__main-wrapper__area--form-group--input">
                            <input type="text" id="cliente-cnpj" name="cliente-cnpj" class="ad-content__main-wrapper__area--form-group--input-text" minlength="14" data-mask="00.000.000/0000-00" data-mask-reverse="true" placeholder="Informe o CNPJ" required />
                            <label for="cliente-cnpj" class="ad-content__main-wrapper__area--form-group--input-label">CNPJ</label>
                            <p class="d-none text-validation-alert" id="text-validation-alert">CNPJ inválido</p>
                        </div>
                        <div class="ad-content__main-wrapper__area--form-group--input">
                            <input type="password" id="cliente-pass" name="cliente-pass" class="ad-content__main-wrapper__area--form-group--input-text" placeholder="Informe a senha" required />
                            <label for="cliente-pass" class="ad-content__main-wrapper__area--form-group--input-label">Senha</label>
                        </div>
                        <div class="ad-content__main-wrapper__area--form-group--footer form-group">
                            <button class="ad-content__main-wrapper__area--form-group--submit" name="btn-cadastrar-cliente" type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div class="ad-content__main-wrapper__delimiter"></div>
                <div class="ad-content__main-wrapper__area">
                    <h5 class="ad-content__main-wrapper__area--title">Enviar PDF</h5>    
                    <form class="ad-content__main-wrapper__area--form form-file" id="upload-pdf-form" method="POST" enctype="multipart/form-data">
                        <div class="ad-content__main-wrapper__area--form form-file--group">
                            <div class="ad-content__main-wrapper__area--form__upload-pdf">
                                <input type="file" id="pdf-file" name="pdf-file" class="ad-content__main-wrapper__area--form__upload-pdf--input" accept="application/pdf" required>
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Enviar PDF</p>
                            </div>
                            <div class="ad-content__main-wrapper__area--fileUpload uploaded"></div>
                        </div>
                        
                        <div class="ad-content__main-wrapper__area--form-group--footer form-group">
                            <button class="ad-content__main-wrapper__area--form-group--submit" name="btn-cadastrar-pdf" type="submit" id="upload-pdf-btn">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if($category == 'Aluno'){ ?>
        <canvas id="myChart" width="400" height="400"></canvas>
    <?php } ?>

    <!-- jQuery first, then JQuery Mask, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Style JS -->
    <!-- <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/file_input.js"></script> -->
    <script type="module" src="<?php echo INCLUDE_PATH; ?>src/assets/js/initialize-chartjs.js"></script>
    <!-- <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/style.js"></script> -->
</body>
</html>
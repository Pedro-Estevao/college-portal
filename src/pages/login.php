<?php
    Controle::logar();
    Controle::lembrar();
    if(Controle::logado()) {
        Controle::redirectAcessoNegado();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barão de Mauá :: LOGIN</title>
    <link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH; ?>src/assets/img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>src/assets/css/style.css" />
</head>
<body>
    <?php include('src/pages/layout/header.php'); ?>

    <?php
        if (isset($_SESSION["mensagem-alert"]))
        {
            echo $_SESSION["mensagem-alert"];
            unset($_SESSION["mensagem-alert"]);
        }
    ?>

    <div class="cn-content--login">
        <form class="cn-login--form" autocomplete="off" method="POST">
            <input autocomplete="false" name="hidden" type="email" style="display:none;">    
            <div class="cn-login--form-group--input">
                <input type="email" id="email" name="email-login" class="cn-login--form-group--input-text" placeholder="Informe o e-mail" required />
                <label for="email" class="cn-login--form-group--input-label">E-mail</label>
            </div>
            <div class="cn-login--form-group--input">
                <input type="password" id="password" name="pass-login" class="cn-login--form-group--input-text" placeholder="Informe a senha" required />
                <label for="password" class="cn-login--form-group--input-label">Senha</label>
            </div>
            <div class="cn-login--form-group--options">
                <input type="checkbox" name="lembrar" class="cn-login--form-group--options-checkbox--input" id="lembrar">
                <label for="lembrar" name="labelLembrar" class="cn-login--form-group--options-checkbox">Lembrar-me</label>
                <a class="cn-login--form-group--options-recPass" href="#" data-toggle="modal" data-target="#recPass">Recuperar Senha</a>
            </div>
            <div class="cn-login--form-group--footer form-group">
                <button class="cn-login--form-group--submit" type="submit" name="login-btn" id="login-btn">LOGAR</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade cn-modal--recPass" id="recPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center justify-content-center">
                    <h4 class="modal-title" id="exampleModalLabel">Recuperar Senha</h4>
                </div>
                <div class="modal-body">
                    <p>Informe seu login abaixo para receber sua senha:</p>
                    <div class="cn-login--form-group--input">
                        <input type="email" id="email" class="cn-login--form-group--input-text" placeholder="Informe o e-mail" required />
                        <label for="email" class="cn-login--form-group--input-label">E-mail</label>
                    </div>
                    <p>Se ele estiver cadastrado em nossa base de dados, logo você receberá uma mensagem com instruções de como recuperar seu acesso.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary rec">Recuperar</button>
                </div>
            </div>
        </div>
    </div>

	<!-- jQuery first, then JQuery Mask, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
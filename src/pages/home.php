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
            <div class="cn-main-content container">
                <?php include('src/pages/layout/cards.php'); ?>

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
    <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>src/assets/js/<?php echo ($category === 'Aluno') ? ("home-alunos.js") : ("home-docentes.js"); ?>"></script>
</body>
</html>
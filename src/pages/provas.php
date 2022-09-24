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
            <div class="cn-main-content container materiais-page">
                <div class="card cn-card materiais-card">
                    <div class="card-body">
                        <div class="">
                            <div class="table-header">
                                <h4 class="no-space-bottom">Orders</h4>
                            </div>
                            <div class="table-content">
                                <div class="table-list">
                                    <div class="w-layout-grid table-headers _5-columns">
                                        <div class="caption-large">Order</div>
                                        <div class="caption-large">Status</div>
                                        <div class="caption-large">customer</div>
                                        <div class="caption-large">Total</div>
                                        <div class="caption-large">Date</div>
                                    </div>
                                    <a href="#" class="table-row-link w-inline-block">
                                        <div class="w-layout-grid table-row _5-columns">
                                            <div id="w-node-_5521c124-0f92-8dbc-1ac2-8e7319e308ce-a83755f0" class="table-title">#10423</div>
                                            <div class="status"><div class="indication-color bg-primary-green"></div>
                                            <div>Shipped</div>
                                        </div>
                                        <div id="w-node-_615c3cff-330e-8cea-cda9-fd603b82f842-a83755f0">Johan D.</div>
                                        <div id="w-node-_4f66ef2c-f5e4-013a-33f4-d541a0a4cfc2-a83755f0">$140.99</div>
                                        <div id="w-node-d4d54e6d-8393-a477-68d3-d0b23521355f-a83755f0">05/05/21</div>
                                    </a>
                                    <a href="#" class="table-row-link w-inline-block">
                                        <div class="w-layout-grid table-row _5-columns">
                                            <div id="w-node-_867b4908-d8a8-4eec-2018-3f07d056152c-a83755f0" class="table-title">#10422</div>
                                            <div class="status"><div class="indication-color bg-primary-green"></div>
                                            <div>Shipped</div>
                                        </div>
                                        <div id="w-node-_867b4908-d8a8-4eec-2018-3f07d0561532-a83755f0">James A.</div>
                                        <div id="w-node-_867b4908-d8a8-4eec-2018-3f07d0561534-a83755f0">$220.99</div>
                                        <div id="w-node-_867b4908-d8a8-4eec-2018-3f07d0561536-a83755f0">05/05/21</div>
                                    </a>
                                    <a href="#" class="table-row-link w-inline-block">
                                        <div class="w-layout-grid table-row _5-columns">
                                            <div id="w-node-_2d5fe243-e37f-9f17-b131-e5e23050fb78-a83755f0" class="table-title">#10421</div>
                                            <div class="status"><div class="indication-color bg-primary-green"></div>
                                            <div>Shipped</div>
                                        </div>
                                        <div id="w-node-_2d5fe243-e37f-9f17-b131-e5e23050fb7e-a83755f0">Rose G.</div>
                                        <div id="w-node-_2d5fe243-e37f-9f17-b131-e5e23050fb80-a83755f0">$109.00</div>
                                        <div id="w-node-_2d5fe243-e37f-9f17-b131-e5e23050fb82-a83755f0">05/05/21</div>
                                    </a>
                                </div>
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

    
</body>
</html>
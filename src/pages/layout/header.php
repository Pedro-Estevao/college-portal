<div class="cn-content--header">
    <header class="cn-content__header container">
        <div class="cn-content__header-wrapper">
            <div class="cn-content__header-wrapper__logo">
                <a class="cn-content__header-wrapper__logo--link" rel="nofollow" href="<?php echo INCLUDE_PATH; ?>" title="Voltar a página inicial">
                    <img class="cn-content__header-wrapper__logo-img" src="<?php echo INCLUDE_PATH; ?>src/assets/img/logo-extend.jpg" alt="Universidade Barão de Mauá" title="Universidade Barão de Mauá">
                </a>
            </div>
            <?php if(Controle::logado()) { ?>
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
            <?php } ?>
        </div>
    </header>
</div>
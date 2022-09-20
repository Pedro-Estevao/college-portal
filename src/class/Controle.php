<?php
    class Controle
    {
        public static function logar()
        {
            if(isset($_POST['login-btn']))
            {
                $user = $_POST['email-login'];
                $pass = md5($_POST['pass-login']."+c0ntrol3-de_notas");

                $verificaUser = Controle::procuraUsuario($user);
                
                if($verificaUser['resultado'][0])
                {

                    $verifica_acesso = Controle::verificaAcesso($verificaUser['resultado'][1],$user,$pass);

                    if($verifica_acesso['Total'] == 1)
                    {
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $pass;
                        $_SESSION['nome'] = Controle::recuperaDadosUser($user,'NOME',$verificaUser['resultado'][1]);
                        $_SESSION['category'] = $verificaUser['resultado'][1];
            
                        if(isset($_POST['lembrar']))
                        {
                            setcookie('lembrar',true,time()+(60*60*24*7),'/');
                            setcookie('user',$user,time()+(60*60*24*7),'/');
                            setcookie('password',$pass,time()+(60*60*24*7),'/');
                            setcookie('category',$verificaUser['resultado'][1],time()+(60*60*24*7),'/');
                        };

                        header('Location: '.INCLUDE_PATH);
                        die();
                    }
                    else
                    {
                        header('Location: '.INCLUDE_PATH);
                        Controle::alert('erro', 'Senha incorreta.');
                        die();
                    }
                }
                else
                {
                    header('Location: '.INCLUDE_PATH);
                    Controle::alert('erro', 'Usuário não encontrado!');
                    die();
                }
            }
        }

        public static function logado() 
        {
            return isset($_SESSION['login']) ? true : false;
        }

        public static function loggout() 
        {
            setcookie('lembrar','true',time()-1,'/');
            session_destroy();
            header('Location: '.INCLUDE_PATH);
            die();
        }

        public static function verificaAcesso($table,$email,$senha)
        {
            $sql_acesso = Conn::Conectar()->prepare(($table == "Aluno") ? ("SELECT COUNT(*) AS Total FROM alunos WHERE EMAIL = ? AND SENHA = ?") : ("SELECT COUNT(*) AS Total FROM professores WHERE EMAIL = ? AND SENHA = ?"));
            $sql_acesso->execute(array($email,$senha));

            return $sql_acesso->fetch();
        }

        public static function recuperaDadosUser($email,$info,$table)
        {
            $sql = Conn::Conectar()->prepare(($table == 'Aluno') ? ("SELECT ? FROM alunos WHERE EMAIL = ?") : ("SELECT ? FROM professores WHERE EMAIL = ?"));
            $sql->execute(array($info,$email));
            $retorno = $sql->fetch();
            return $retorno[$info];
        }

        public static function procuraUsuario($email)
        {
            $data = array();

            $sql_email_aluno = Conn::Conectar()->prepare("SELECT COUNT(EMAIL) AS Total FROM `alunos` WHERE EMAIL = ?");
            $sql_email_aluno->execute(array($email));
            $verifica_email_aluno = $sql_email_aluno->fetch();
    
            if($verifica_email_aluno['Total'] == 1)
            {
                $data['resultado'] = [true, 'Aluno', 'alunos'];
                return $data;
            }
            else
            {
                $sql_email_prof = Conn::Conectar()->prepare("SELECT COUNT(EMAIL) AS Total FROM `professores` WHERE EMAIL = ?");
                $sql_email_prof->execute(array($email));
                $verifica_email_prof = $sql_email_prof->fetch();

                if($verifica_email_prof['Total'] == 1)
                {
                    $data['resultado'] = [true, 'Professor', 'professores'];
                    return $data;
                }
                else {
                    $data['resultado'] = [false];
                    return $data;
                }
            }
        }

        public static function lembrar()
        {
            if(isset($_COOKIE['lembrar']))
            {
                $user = $_COOKIE['user'];
                $pass = $_COOKIE['password'];
                $category = $_COOKIE['category'];

                $verifica_acesso = Controle::verificaAcesso($category,$user,$pass);

                if($verifica_acesso['Total'] == 1)
                {
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $pass;
                    $_SESSION['category'] = $category;
                    $_SESSION['nome'] = Controle::recuperaDadosUser($user,'NOME',$category);
                    header('Location: '.INCLUDE_PATH);
                    die();
                }
            }
        }

        public static function verificaPermissaoPagina()
        {
            if(Controle::logado() == false)
            {
                if(isset($_GET['url']))
                {
                    header('Location: '.INCLUDE_PATH);
                    die();
                }
                else
                {
                    include('src/pages/login.php');
                    die();
                }
            }
            else if(Controle::logado() == true)
            {
                if(isset($_GET['url']))
                {
                    $url = explode('/',$_GET['url']);

                    if(file_exists('src/pages/'.$url[0].'.php'))
                    {
                        include('src/pages/'.$url[0].'.php');
                        die();
                    }
                    else
                    {
                        header('Location: '.INCLUDE_PATH);
                        die();
                    }
                }
                else
                {
                    include('src/pages/home.php');
                    die();
                }
            }
        }

        public static function alert($tipo,$mensagem) 
        {
            if($tipo == 'sucesso')
            {
                $_SESSION['mensagem-alert'] =  '<div class="alert-form-sucesso d-flex align-items-center" id="alert-form-sucesso">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </span>
                                                    <span>
                                                        <b> SUCESSO - </b> '.$mensagem.'
                                                    </span>
                                                </div>';
            }
            else if($tipo == 'erro')
            {
                $_SESSION['mensagem-alert'] = '<div class="alert-form-erro d-flex align-items-center" id="alert-form-erro">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </span>
                                                    <span>
                                                        <b> ERRO - </b> '.$mensagem.'
                                                    </span>
                                                </div>';
            }
            else if($tipo == 'alerta')
            {
                $_SESSION['mensagem-alert'] = '<div class="alert-form-alerta d-flex align-items-center" id="alert-form-alerta">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </span>
                                                    <span>
                                                        <b> AVISO - </b> '.$mensagem.'
                                                    </span>
                                                </div>';
            }
        }

        public static function redirectAcessoNegado()
        {
            header('Location: '.INCLUDE_PATH);
            die();
        }
    }
?>
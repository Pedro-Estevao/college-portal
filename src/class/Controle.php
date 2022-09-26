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
                        $_SESSION['nome'] = Controle::recuperaDadosUser($user,'NOME',$verificaUser['resultado'][2]);
                        $_SESSION['category'] = $verificaUser['resultado'][1];
                        if($verificaUser['resultado'][1] == 'Aluno')
                        {
                            $_SESSION['idUser'] = Controle::recuperaDadosUser($user,'ID',$verificaUser['resultado'][2]);
                            $_SESSION['matricula'] = Controle::recuperaDadosMatricula($_SESSION['idUser'],'MATRICULA');
                            $_SESSION['curso'] = Controle::recuperaDadosCurso(Controle::recuperaDadosMatricula($_SESSION['idUser'],'CURSO'),'CURSO');
                        }
                        else
                        {
                            $_SESSION['idUser'] = Controle::recuperaDadosUser($user,'ID',$verificaUser['resultado'][2]);
                        }
            
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

        public static function recuperaDadosMatricula($id,$info)
        {
            $sql = Conn::Conectar()->prepare("SELECT `$info` FROM matricula WHERE ALUNO = ?");
            $sql->execute(array($id));
            $retorno = $sql->fetch();
            return $retorno[$info];
        }

        public static function recuperaDadosCurso($id,$info)
        {
            $sql = Conn::Conectar()->prepare("SELECT `$info` FROM cursos WHERE ID = ?");
            $sql->execute(array($id));
            $retorno = $sql->fetch();
            return $retorno[$info];
        }

        public static function recuperaDadosMateria($id,$info)
        {
            $sql = Conn::Conectar()->prepare("SELECT `$info` FROM materias WHERE ID = ?");
            $sql->execute(array($id));
            $retorno = $sql->fetch();
            return $retorno[$info];
        }

        public static function recuperaDadosUser($email,$info,$table)
        {
            $sql = Conn::Conectar()->prepare("SELECT `$info` FROM `$table` WHERE EMAIL = ?");
            $sql->execute(array($email));
            $retorno = $sql->fetch();
            return $retorno[$info];
        }

        public static function listarMateriasAlunos($curso)
        {
            $sql = Conn::Conectar()->prepare("SELECT materias.ID, materias.MATERIA, materias.IMG, cursos.CURSO FROM grade INNER JOIN materias ON grade.MATERIA = materias.ID INNER JOIN cursos ON grade.CURSO = cursos.ID WHERE grade.CURSO = ?");
            $sql->execute(array($curso));
            return $sql->fetchAll();
        }

        public static function listarMateriasDocentes($professor)
        {
            $sql = Conn::Conectar()->prepare("SELECT materias.ID, materias.MATERIA, materias.IMG, cursos.CURSO FROM grade INNER JOIN materias ON grade.MATERIA = materias.ID INNER JOIN cursos ON grade.CURSO = cursos.ID WHERE grade.PROFESSOR = ?");
            $sql->execute(array($professor));
            return $sql->fetchAll();
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
                    if($category == 'Aluno')
                    {
                        $_SESSION['idUser'] = Controle::recuperaDadosUser($user,'ID',$category);
                        $_SESSION['matricula'] = Controle::recuperaDadosMatricula($_SESSION['idUser'],'MATRICULA');
                        $_SESSION['curso'] = Controle::recuperaDadosCurso(Controle::recuperaDadosMatricula($_SESSION['idUser'],'CURSO'),'CURSO');
                    }
                    else
                    {
                        $_SESSION['idUser'] = Controle::recuperaDadosUser($user,'ID',$category);
                    }
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

        public static function verificaPrazo($date_i,$date_f)
        {
            if(strtotime($date_i) > strtotime($date_f))
            {
                return strtotime($date_i) > strtotime($date_f);
            }
            else
            {
                return strtotime($date_i) > strtotime($date_f);
            }
        }

        public static function countMateriasVinculadas($category,$id)
        {
            if($category == 'Aluno')
            {
                $sql = Conn::Conectar()->prepare("SELECT COUNT(grade.MATERIA) AS Total FROM matricula INNER JOIN grade ON matricula.CURSO = grade.CURSO WHERE matricula.ALUNO = ?");
            }
            else
            {
                $sql = Conn::Conectar()->prepare("SELECT COUNT(MATERIA) AS Total FROM grade WHERE PROFESSOR = ?");
            }

            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Total'];
        }

        public static function countAlunosEmDP($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(alunos.ID) AS Total FROM grade INNER JOIN relacao_notas ON grade.ID = relacao_notas.GRADE INNER JOIN matricula ON relacao_notas.MATRICULA = matricula.ID INNER JOIN alunos ON matricula.ALUNO = alunos.ID WHERE ((grade.PROFESSOR = ?) AND (relacao_notas.SITUACAO = 'DP'))");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Total'];
        }

        public static function countTrabalhosVinculados($category,$id)
        {
            if($category == 'Aluno')
            {
                $sql = Conn::Conectar()->prepare("SELECT COUNT(trabalhos.ID) AS Total FROM matricula INNER JOIN grade ON matricula.CURSO = grade.CURSO INNER JOIN relacao_materia ON grade.ID = relacao_materia.GRADE INNER JOIN trabalhos ON relacao_materia.ID = trabalhos.RELACAO WHERE ((trabalhos.DATA_FIM > NOW()) AND (matricula.ALUNO = ?))");
            }
            else
            {
                $sql = Conn::Conectar()->prepare("SELECT COUNT(devolutiva_trabalhos.ID) AS Total FROM grade INNER JOIN relacao_materia ON grade.ID = relacao_materia.GRADE INNER JOIN trabalhos ON relacao_materia.ID = trabalhos.RELACAO INNER JOIN devolutiva_trabalhos ON trabalhos.ID = devolutiva_trabalhos.TRABALHO WHERE ((trabalhos.DATA_FIM > NOW()) AND (grade.PROFESSOR = ?))");
            }
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Total'];
        }

        public static function dataProximaProva($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT provas.DATA AS Prova FROM matricula INNER JOIN grade ON matricula.CURSO = grade.CURSO INNER JOIN relacao_materia ON grade.ID = relacao_materia.GRADE INNER JOIN provas ON relacao_materia.ID = provas.RELACAO WHERE ((provas.DATA > NOW()) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Prova'];
        }

        public static function recuperaConfigUserAluno($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT ID,NOME,EMAIL,TELEFONE FROM alunos WHERE ID = ?");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado;
        }

        public static function recuperaConfigUserProfessor($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT ID,NOME,EMAIL,TELEFONE FROM professores WHERE ID = ?");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado;
        }

        // public static function updateConfigUserAluno($redirect = null)
        // {
        //     $idUser = $_POST['perfil-id'];
        //     $nome = $_POST['perfil-nome'];
        //     $email = $_POST['perfil-nome'];
        //     $telefone = $_POST['perfil-nome'];
        //     $senha = $_POST['perfil-nome'];

        //     if(($idUser == '') && ($nome == '') && ($email == '') && ($telefone == ''))
        //     {
        //         header('Location: '.INCLUDE_PATH.$redirect);
        //         Controle::alert('erro', 'O formulário está vazio');
        //         die();
        //     }
        //     else if($idUser == '')
        //     {
        //         header('Location: '.INCLUDE_PATH.$redirect);
        //         Controle::alert('erro', 'Usuário não encontrado');
        //         die();
        //     }
        //     else if($nome == '')
        //     {
        //         header('Location: '.INCLUDE_PATH.$redirect);
        //         Controle::alert('erro', 'Nome não informado');
        //         die();
        //     }
        //     else if($email== '')
        //     {
        //         header('Location: '.INCLUDE_PATH.$redirect);
        //         Controle::alert('erro', 'E-mail não informado');
        //         die();
        //     }
        //     else if($telefone== '')
        //     {
        //         header('Location: '.INCLUDE_PATH.$redirect);
        //         Controle::alert('erro', 'E-mail não informado');
        //         die();
        //     }
        //     else
        //     {
        //         $sql = Conn::Conectar()->prepare("UPDATE devolutiva_trabalhos SET NOTA=?,SITUACAO=? WHERE ((MATRICULA = ?) AND (TRABALHO = ?))");
        //         $sql->execute(array(str_replace(',', '.', $nota),'CORRIGIDO',Controle::recuperaDadosMatricula($idUser,'ID'),$idTrabalho));

        //         // str_replace(',', '.', $nota)
        //         if($sql->rowCount() == 1)
        //         {
        //             header('Location: '.INCLUDE_PATH.$redirect);
        //             Controle::alert('sucesso', 'Correção enviada');
        //             die();
        //         }
        //         else
        //         {
        //             header('Location: '.INCLUDE_PATH.$redirect);
        //             Controle::alert('erro', 'Erro ao enviar correção');
        //             die();
        //         }
        //     }
        // }
    }
?>
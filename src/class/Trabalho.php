<?php
    class trabalho
    {
        public static function verificaTrabalho($redirect)
        {
            $title = $_POST['novo-trabalho-titulo'];
            $desc = $_POST['novo-trabalho-descricao'];
            $date = $_POST['novo-trabalho-data-final'];
            $material = $_FILES['novo-trabalho-material'];

            if(($title == '') && ($desc == '') && ($date == ''))
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'O formulário está vazio');
                die();
            }
            else if($title == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'O título está vazio');
                die();
            }
            else if($desc == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'A descrição está vazia');
                die();
            }
            else if($date == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'A data de entrega está vazia');
                die();
            }
            else
            {
                if(Trabalho::trabalhoExiste($title))
                {
                    header('Location: '.INCLUDE_PATH.$redirect);
                    Controle::alert('erro', 'Título já cadastrado!');
                    die();
                }
                else
                {
                    Trabalho::cadastrarTrabalho($redirect,$title,$desc,$date,$material);
                }
            }
        }

        public static function cadastrarTrabalho($redirect,$title,$desc,$date,$material = null)
        {
            $disciplina = explode('=', $redirect)[1];

            if($material != null)
            {
                $material = Trabalho::cadastraMaterialTrabalho($material);
            }

            $data_final = new DateTime($date);

            $sql = Conn::Conectar()->prepare("INSERT INTO trabalhos VALUES (null,?,?,?,?,?,?)");
            $sql->execute(array($title,date('Y-m-d H:i:s'),$data_final->format('Y-m-d H:i:s'),$desc,$material,Trabalho::recuperaRelacaoMateria($disciplina)));

            if($sql->rowCount() == 1)
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('sucesso', 'Trabalho cadastrado');
                die();
            }
            else
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Erro ao cadastrar trabalho');
                die();
            }
        }

        public static function cadastraMaterialTrabalho($material)
        {
            $file_name = $material['name'];
            $tmp_name = $material['tmp_name'];
            $file_up_name = md5(time().$file_name).".".explode('.', $file_name)[1];
            $moved = move_uploaded_file($tmp_name, "src/assets/uploads/".$file_up_name);

            if($moved)
            {
                return $file_up_name;
            }
        }

        public static function recuperaRelacaoMateria($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT relacao_materia.ID AS Relacao FROM relacao_materia INNER JOIN grade ON relacao_materia.GRADE = grade.ID WHERE grade.MATERIA = ?");
            $sql->execute(array($id));
            $retorno = $sql->fetch();
            return $retorno['Relacao'];
        }

        public static function listarTrabalhos($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, cursos.CURSO AS Curso FROM trabalhos INNER JOIN relacao_materia ON trabalhos.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN cursos ON grade.CURSO = cursos.ID WHERE grade.MATERIA = ? ORDER BY Data_final DESC");
            $sql->execute(array($id));
            return $sql->fetchAll();
        }

        public static function verificaExisteDevolutiva($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(devolutiva_trabalhos.ID) AS Total FROM devolutiva_trabalhos INNER JOIN matricula ON devolutiva_trabalhos.MATRICULA = matricula.ID WHERE ((devolutiva_trabalhos.TRABALHO = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id,$idUser));
            $resultado = $sql->fetch();
            if($resultado['Total'] == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function verificaSituacaoDevolutiva($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT devolutiva_trabalhos.SITUACAO AS Situacao FROM devolutiva_trabalhos INNER JOIN matricula ON devolutiva_trabalhos.MATRICULA = matricula.ID WHERE ((devolutiva_trabalhos.TRABALHO = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id,$idUser));
            $resultado = $sql->fetch();
            return $resultado['Situacao'];
        }

        public static function verificaPrazoTrabalho($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT DATA_FIM AS Data_final FROM trabalhos WHERE (ID = ?)");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            $data_final = strtotime($resultado['Data_final']);
            $data_atual = strtotime(date('Y/m/d H:i:s'));
            $diferença = $data_final - $data_atual;
            if($diferença > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function recuperaNotaDevolutiva($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT devolutiva_trabalhos.NOTA AS Nota FROM devolutiva_trabalhos INNER JOIN matricula ON devolutiva_trabalhos.MATRICULA = matricula.ID WHERE ((devolutiva_trabalhos.TRABALHO = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id,$idUser));
            $resultado = $sql->fetch();
            return $resultado['Nota'];
        }

        public static function countDevolutivaTrabalhos($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(ID) AS Total FROM devolutiva_trabalhos WHERE TRABALHO = ?");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Total'];
        }

        public static function trabalhoExiste($title)
        {
            $sql = Conn::Conectar()->prepare("SELECT ID FROM trabalhos WHERE TRABALHO = ?");
            $sql->execute(array($title));

            if($sql->rowCount() == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function verificaDevolutivaTrabalho($redirect = null)
        {
            $idUser = $_POST['devolutiva-trabalho-id-user'];
            $idTrabalho = $_POST['devolutiva-trabalho-id-trabalho'];
            $desc = $_POST['devolutiva-trabalho-descricao'];
            $dev = $_FILES['devolutiva-trabalho-material'];

            if(($idUser == '') && ($idTrabalho == '') && ($desc == '') && ($dev == ''))
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'O formulário está vazio');
                die();
            }
            else if($idUser == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Usuário não encontrado');
                die();
            }
            else if($idTrabalho == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Trabalho não encontrado');
                die();
            }
            else if($desc == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Descrição está vazia');
                die();
            }
            else if($dev == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Devolução está vazia');
                die();
            }
            else
            {
                if(Trabalho::devolutivaExiste($idUser,$idTrabalho))
                {
                    header('Location: '.INCLUDE_PATH.$redirect);
                    Controle::alert('erro', 'Devolutiva já realizada');
                    die();
                }
                else
                {
                    Trabalho::enviarDevolutivaTrabalho($redirect,$idUser,$idTrabalho,$desc,$dev);
                }
            }
        }

        public static function enviarDevolutivaTrabalho($redirect,$idUser,$idTrabalho,$desc,$material)
        {
            $dev = Trabalho::cadastraMaterialTrabalho($material);

            $sql = Conn::Conectar()->prepare("INSERT INTO devolutiva_trabalhos VALUES (null,?,?,?,?,?,?)");
            $sql->execute(array($desc,$dev,0.00,'AGUARDANDO CORREÇÃO',Controle::recuperaDadosMatricula($idUser,'ID'),$idTrabalho));

            if($sql->rowCount() == 1)
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('sucesso', 'Trabalho enviado');
                die();
            }
            else
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Erro ao enviar trabalho');
                die();
            }
        }

        public static function devolutivaExiste($idUser,$idTrabalho)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(devolutiva_trabalhos.ID) AS Total FROM devolutiva_trabalhos INNER JOIN trabalhos ON devolutiva_trabalhos.TRABALHO = trabalhos.ID INNER JOIN relacao_materia ON trabalhos.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO WHERE ((trabalhos.ID = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($idTrabalho,$idUser));
            $resultado = $sql->fetch();

            if($resultado['Total'] == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function enviaCorrecaoDevolucao($redirect)
        {
            $idUser = $_POST['devolutiva-trabalho-id-user'];
            $idTrabalho = $_POST['devolutiva-trabalho-id-trabalho'];
            $nota = $_POST['devolutiva-trabalho-nota'];

            if(($idUser == '') && ($idTrabalho == '') && ($nota == ''))
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'O formulário está vazio');
                die();
            }
            else if($idUser == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Usuário não encontrado');
                die();
            }
            else if($idTrabalho == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Trabalho não encontrado');
                die();
            }
            else if($nota == '')
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Nota não informada');
                die();
            }
            else
            {
                $sql = Conn::Conectar()->prepare("UPDATE devolutiva_trabalhos SET NOTA=?,SITUACAO=? WHERE ((MATRICULA = ?) AND (TRABALHO = ?))");
                $sql->execute(array(str_replace(',', '.', $nota),'CORRIGIDO',Controle::recuperaDadosMatricula($idUser,'ID'),$idTrabalho));

                // str_replace(',', '.', $nota)
                if($sql->rowCount() == 1)
                {
                    header('Location: '.INCLUDE_PATH.$redirect);
                    Controle::alert('sucesso', 'Correção enviada');
                    die();
                }
                else
                {
                    header('Location: '.INCLUDE_PATH.$redirect);
                    Controle::alert('erro', 'Erro ao enviar correção');
                    die();
                }
            }
        }

        public static function recuperaDevolutivas($idMateria,$idTrabalho)
        {
            $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, devolutiva_trabalhos.ID AS IdDevo, devolutiva_trabalhos.NOTA AS Nota, devolutiva_trabalhos.SITUACAO AS Situacao, devolutiva_trabalhos.TRABALHO AS IdTrabalhoDevo, cursos.CURSO AS Curso, matricula.ALUNO AS IdAluno FROM devolutiva_trabalhos INNER JOIN trabalhos ON devolutiva_trabalhos.TRABALHO = trabalhos.ID INNER JOIN relacao_materia ON trabalhos.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN materias ON grade.MATERIA = materias.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO INNER JOIN cursos ON grade.CURSO = cursos.ID WHERE ((materias.ID = ?) && (trabalhos.ID = ?))");
            $sql->execute(array($idMateria,$idTrabalho));
            return $sql->fetchAll();
        }

        public static function listarTrabalhosAluno($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, materias.MATERIA AS Materia FROM matricula INNER JOIN grade ON matricula.CURSO = grade.CURSO INNER JOIN relacao_materia ON grade.ID = relacao_materia.GRADE INNER JOIN trabalhos ON relacao_materia.ID = trabalhos.RELACAO INNER JOIN materias ON grade.MATERIA = materias.ID WHERE matricula.ALUNO = ? ORDER BY trabalhos.DATA_FIM DESC");
            $sql->execute(array($id));
            return $sql->fetchAll();
        }

        public static function listarTrabalhosDocente($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, materias.MATERIA AS Materia FROM matricula INNER JOIN grade ON matricula.CURSO = grade.CURSO INNER JOIN relacao_materia ON grade.ID = relacao_materia.GRADE INNER JOIN trabalhos ON relacao_materia.ID = trabalhos.RELACAO INNER JOIN materias ON grade.MATERIA = materias.ID WHERE matricula.ALUNO = ? ORDER BY trabalhos.DATA_FIM DESC");
            $sql->execute(array($id));
            return $sql->fetchAll();
        }
    }
?>
<?php
    class Prova
    {
        public static function verificaProva($redirect)
        {
            $title = $_POST['nova-prova-titulo'];
            $desc = $_POST['nova-prova-descricao'];
            $date = $_POST['nova-prova-data'];
            $material = $_FILES['nova-prova-material'];

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
                Controle::alert('erro', 'A data de prova está vazia');
                die();
            }
            else
            {
                if(Prova::provaExiste($title))
                {
                    header('Location: '.INCLUDE_PATH.$redirect);
                    Controle::alert('erro', 'Título já cadastrado!');
                    die();
                }
                else
                {
                    Prova::cadastrarProva($redirect,$title,$desc,$date,$material);
                }
            }
        }

        public static function cadastrarProva($redirect,$title,$desc,$date,$material = null)
        {
            $disciplina = explode('=', $redirect)[1];

            if($material != null)
            {
                $material = Prova::cadastraMaterialProva($material);
            }

            $data = new DateTime($date);

            $sql = Conn::Conectar()->prepare("INSERT INTO provas VALUES (null,?,?,?,?,?)");
            $sql->execute(array($title,$data->format('Y-m-d H:i:s'),$desc,$material,Prova::recuperaRelacaoMateria($disciplina)));

            if($sql->rowCount() == 1)
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('sucesso', 'Prova cadastrada');
                die();
            }
            else
            {
                header('Location: '.INCLUDE_PATH.$redirect);
                Controle::alert('erro', 'Erro ao cadastrar prova');
                die();
            }
        }

        public static function cadastraMaterialProva($material)
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

        public static function listarProvas($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT provas.ID AS Id, provas.PROVA AS Titulo, provas.DATA AS Data, cursos.CURSO AS Curso FROM provas INNER JOIN relacao_materia ON provas.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN cursos ON grade.CURSO = cursos.ID WHERE grade.MATERIA = ? ORDER BY Data DESC");
            $sql->execute(array($id));
            return $sql->fetchAll();
        }

        public static function verificaPrazoProva($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT DATA AS Data_aplicacao FROM provas WHERE (ID = ?)");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            $data_final = strtotime($resultado['Data_aplicacao']);
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

        public static function verificaExisteCorrecao($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(notas_provas.ID) AS Total FROM notas_provas INNER JOIN matricula ON notas_provas.MATRICULA = matricula.ID WHERE ((notas_provas.PROVA = ?) AND (matricula.ALUNO = ?))");
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

        public static function verificaSituacaoProva($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT notas_provas.SITUACAO AS Situacao FROM notas_provas INNER JOIN matricula ON notas_provas.MATRICULA = matricula.ID WHERE ((notas_provas.PROVA = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id,$idUser));
            $resultado = $sql->fetch();
            return $resultado['Situacao'];
        }

        public static function recuperaNotaProva($id,$idUser)
        {
            $sql = Conn::Conectar()->prepare("SELECT notas_provas.NOTA AS Nota FROM notas_provas INNER JOIN matricula ON notas_provas.MATRICULA = matricula.ID WHERE ((notas_provas.PROVA = ?) AND (matricula.ALUNO = ?))");
            $sql->execute(array($id,$idUser));
            $resultado = $sql->fetch();
            return $resultado['Nota'];
        }

        public static function countRealizacaoProvas($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT COUNT(ID) AS Total FROM notas_provas WHERE PROVA = ?");
            $sql->execute(array($id));
            $resultado = $sql->fetch();
            return $resultado['Total'];
        }

        public static function recuperaRelacaoMateria($id)
        {
            $sql = Conn::Conectar()->prepare("SELECT relacao_materia.ID AS Relacao FROM relacao_materia INNER JOIN grade ON relacao_materia.GRADE = grade.ID WHERE grade.MATERIA = ?");
            $sql->execute(array($id));
            $retorno = $sql->fetch();
            return $retorno['Relacao'];
        }

        public static function provaExiste($title)
        {
            $sql = Conn::Conectar()->prepare("SELECT ID FROM provas WHERE PROVA = ?");
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
    }
?>
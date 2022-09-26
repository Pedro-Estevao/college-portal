<?php
include('../../config.php');

if(isset($_POST['recuperaDadosTrabalho']))
{
    $data = array();
    $idTrabalho = $_POST['recuperaDadosTrabalho'][0];
    $idUser = $_POST['recuperaDadosTrabalho'][1];

    $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, trabalhos.DESCRICAO AS Descricao, trabalhos.MATERIAL AS Material FROM trabalhos INNER JOIN relacao_materia ON trabalhos.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO WHERE ((trabalhos.ID = ?) AND (matricula.ALUNO = ?))");
    $sql->execute(array($idTrabalho,$idUser));
    $resultado = $sql->fetch();
    $data['Id'] = $idTrabalho;
    $data['IdUser'] = $idUser;
    $data['Titulo'] = $resultado['Titulo'];
    $data['Data_final'] = $resultado['Data_final'];
    $data['Descricao'] = $resultado['Descricao'];
    $data['Material'] = $resultado['Material'];
    die(json_encode($data));
}

if(isset($_POST['recuperaDadosTrabalhoDevolutiva']))
{
    $data = array();
    $idTrabalho = $_POST['recuperaDadosTrabalhoDevolutiva'][0];
    $idUser = $_POST['recuperaDadosTrabalhoDevolutiva'][1];

    $sql = Conn::Conectar()->prepare("SELECT trabalhos.ID AS Id, trabalhos.TRABALHO AS Titulo, trabalhos.DATA_FIM AS Data_final, trabalhos.DESCRICAO AS Descricao, trabalhos.MATERIAL AS Material, devolutiva_trabalhos.DESCRICAO AS DescDevo, devolutiva_trabalhos.DEVOLUTIVA AS MatDevo, devolutiva_trabalhos.SITUACAO AS Situacao, devolutiva_trabalhos.NOTA AS Nota FROM trabalhos INNER JOIN relacao_materia ON trabalhos.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO INNER JOIN devolutiva_trabalhos ON trabalhos.ID = devolutiva_trabalhos.TRABALHO WHERE ((trabalhos.ID = ?) AND (matricula.ALUNO = ?))");
    $sql->execute(array($idTrabalho,$idUser));
    $resultado = $sql->fetch();
    $data['Id'] = $idTrabalho;
    $data['IdUser'] = $idUser;
    $data['Titulo'] = $resultado['Titulo'];
    $data['Data_final'] = $resultado['Data_final'];
    $data['Descricao'] = $resultado['Descricao'];
    $data['Material'] = $resultado['Material'];
    $data['Situacao'] = $resultado['Situacao'];
    $data['Nota'] = ($resultado['Situacao'] == 'CORRIGIDO') ? ($resultado['Nota']) : ('---');
    $data['DescDevo'] = $resultado['DescDevo'];
    $data['MatDevo'] = $resultado['MatDevo'];
    die(json_encode($data));
}

if(isset($_POST['recuperaDadosProva']))
{
    $data = array();
    $idProva = $_POST['recuperaDadosProva'][0];
    $idUser = $_POST['recuperaDadosProva'][1];

    $sql = Conn::Conectar()->prepare("SELECT provas.ID AS Id, provas.PROVA AS Titulo, provas.DATA AS Data_final, provas.DESCRICAO AS Descricao, provas.MATERIAL AS Material FROM provas INNER JOIN relacao_materia ON provas.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO WHERE ((provas.ID = ?) AND (matricula.ALUNO = ?))");
    $sql->execute(array($idProva,$idUser));
    $resultado = $sql->fetch();
    $data['Titulo'] = $resultado['Titulo'];
    $data['Data_final'] = $resultado['Data_final'];
    $data['Descricao'] = $resultado['Descricao'];
    $data['Material'] = $resultado['Material'];
    die(json_encode($data));
}

if(isset($_POST['recuperaDadosProvaDevolutiva']))
{
    $data = array();
    $idProva = $_POST['recuperaDadosProvaDevolutiva'][0];
    $idUser = $_POST['recuperaDadosProvaDevolutiva'][1];

    $sql = Conn::Conectar()->prepare("SELECT provas.ID AS Id, provas.PROVA AS Titulo, provas.DATA AS Data_final, provas.DESCRICAO AS Descricao, provas.MATERIAL AS Material, notas_provas.DESCRICAO AS DescDevo, notas_provas.SITUACAO AS Situacao, notas_provas.NOTA AS Nota FROM provas INNER JOIN relacao_materia ON provas.RELACAO = relacao_materia.ID INNER JOIN grade ON relacao_materia.GRADE = grade.ID INNER JOIN matricula ON grade.CURSO = matricula.CURSO INNER JOIN notas_provas ON provas.ID = notas_provas.PROVA WHERE ((provas.ID = ?) AND (matricula.ALUNO = ?))");
    $sql->execute(array($idProva,$idUser));
    $resultado = $sql->fetch();
    $data['Titulo'] = $resultado['Titulo'];
    $data['Data_final'] = $resultado['Data_final'];
    $data['Descricao'] = $resultado['Descricao'];
    $data['Material'] = $resultado['Material'];
    $data['Situacao'] = $resultado['Situacao'];
    $data['Nota'] = ($resultado['Situacao'] == 'CORRIGIDO') ? ($resultado['Nota']) : ('---');
    die(json_encode($data));
}
?>
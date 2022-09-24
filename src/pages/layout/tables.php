<?php 
if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];
}
?>

<div class="card cn-card">
    <div class="card-body">
        <table id="<?php echo ($category === 'Aluno') ? ("table-aluno") : ("table-docente"); ?>" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>NOME</td>
                    <td>CNPJ</td>
                    <td>AÇÕES</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Teste</td>
                    <td>Teste1</td>
                    <td>Teste2</td>
                </tr>
                <!-- <?php foreach ($clientes as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['NOME'] ?></td>
                        <td><?php echo $value['CNPJ'] ?></td>
                        <td>
                            <a class="btn edit" id="btn-editar-cliente" href="<?php echo INCLUDE_PATH; ?>clientes?id=<?php echo $value['ID']; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                            <a class="btn delete" id="btn-excluir-cliente" href="<?php echo INCLUDE_PATH; ?>clientes?excluir=<?php echo $value['ID']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?> -->
            </tbody>
        </table>
    </div>
</div>
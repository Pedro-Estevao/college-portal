<?php 
if(isset($_SESSION['category']))
{
    $category = $_SESSION['category'];
}
?>

<div class="card cn-card">
    <div class="card-body">
        <?php if($category == 'Aluno'){ ?>
            <canvas id="<?php echo ($category === 'Aluno') ? ("chart-aluno") : ("chart-docente"); ?>" class="cn-chart" width="400" height="400"></canvas>
        <?php } ?>
    </div>
</div>
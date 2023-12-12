<?php include 'layout-top.php' ?>

<br><br>
<h1>DADOS DE SUA CONSULTA</h1>
<h6>MED.ONLINE</h6><br>


<div class='row'>
    <label class='col-md-1'>
        <b>Data</b>
    </label>
    <label class='col-md-3'>
        <?=$consulta['data_agenda']?> <?=$consulta['hora']?>
    </label>
</div>

<div class='row'>
    <label class='col-md-1'>
        <b>Médico</b>
    </label>
    <label class='col-md-3'>
        <?=$consulta['medico_nome']?>
    </label>
</div>

<div class='row'>
    <label class='col-md-1'>
        <b>Paciente</b>
    </label>
    <label class='col-md-3'>
        <?=$consulta['paciente_nome']?>
    </label>
</div>

<br><br>
<hr>
<br>


<?php include 'layout-bottom.php' ?>

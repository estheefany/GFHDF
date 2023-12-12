<?php include 'layout-top.php' ?>

<link rel="stylesheet" href="<?=assets("css/consulta.css")?>" />

<section class="container">
    <header>AGENDAMENTO</header>
    <form class="form" method='GET' action='<?=route('consulta/index/')?>'>
        <label class='input-box'>
            Data
            <input type="date" class="form-control" name="data_agenda" value="<?=_v($_GET,"data_agenda")?>">
        </label><br>

        <label class="input-box">
            Hora
            <input type="time" class="form-control" name="hora" min="09:00" max="18:00" value="<?=_v($_GET,"hora")?>">
        </label><br>

        <label class='input-box'>
            Médico | Enfermeiro | Dentista
            <select name="medico_id" class="form-select" class="form-control">
                <option></option>
                <?php
            foreach($medicos as $med){
                _v($_GET,"medico_id") == $med['id'] ? $selected='selected' : $selected='';
                print "<option value='{$med['id']}'  $selected>{$med['nome']}</option>";
            }
            ?>
            </select>
        </label>

    <!--  <button class='btn btn-primary col-12 col-md-3 mt-3'>Buscar</button> -->

        <div class="input-box"><button>Buscar</button></div>
                

    </form>
    <br><br>
    <hr>


    <br>
    <table class='table'>

        <tr>
            <?php if ($_SESSION['user']['tipo']== 'paciente'): ?>
            <th>Agendar</th>
            <?php endif; ?>
            <th>Data</th>
            <th>Hora</th>
            <th>Medico</th>
            <th>Paciente</th>
            <th>Deletar</th>
        </tr>

        <?php foreach($lista as $item): ?>

        <tr>
            <?php if ($_SESSION['user']['tipo']== 'paciente'): ?>
            <td>
                <?php if ($item['paciente_id'] == ""): ?>
                <button id="agenda" class="button"><a href='<?=route("Consulta/agendar/{$item['id']}")?>'>Agendar</a></button>
               
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td><?=$item['data_agenda']?></td>
            <td><?=$item['hora']?></td>
            <td><?=$item['medico_nome']?></td>
            <td>
                <?=$item['paciente_nome']?>
                <?php if ($item['cancelado']):?>
                <span style="color:red;">(Desmarcado)</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($item['paciente_id'] != "" && $item['cancelado'] == ""): ?>
                <button  id="desmarcarBTN" class="button"><a href='<?=route("consulta/desmarcar/{$item['id']}")?>'>Desmarcar consulta</a></button>
                <?php endif; ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</section>

<?php include 'layout-bottom.php' ?>
<?php include 'layout-top.php' ?>

<link rel="stylesheet" href="<?=assets("css/frontt.css")?>" />

<section class="container">
    <header>CADASTRO DE ESPECIALISTAS</header>
    <form class="form" method='POST' action='<?=route('medico/salvar/'._v($data,"id"))?>'>
        <label class='input-box'>
            Nome Completo
            <input type="text" class="form-control" name="nome" value="<?=_v($data,"nome")?>" placeholder="Insira seu nome completo">

            <div class='invalid-feedback'><?=getValidationError("nome") ?></div>
        </label><br>

        <label class='input-box'>
            Conselho Regional
            <input type="text" class="form-control" name="crm" value="<?=_v($data,"crm")?>" placeholder="Insira sua inscrição no Conselho Regional">
        </label><br>

        <label class='input-box'>
            Especialidade
            <select name="especialidade" class="form-select" class="form-control">
                <?php
            foreach($especialidades as $k=>$esp){
                _v($data,"especialidade") == $k ? $selected='selected' : $selected='';
                print "<option value='{$k}'  $selected>{$esp}</option>";
            }
            ?>
            </select>
        </label>

       <!-- <button class='btn btn-primary col-12 col-md-3 mt-3'>Salvar</button>
        <a class='btn btn-secondary col-12 col-md-3 mt-3' href="<?=route("medico")?>">Novo</a> -->

        <div class="column">
                <div class="input-box">
                     <button>Salvar</button>
                </div>
                <div class="input-box">
                     <button href="<?=route("paciente")?>">Novo</button>
                </div>
        </div>

    </form>
    <br><br>
    <hr>
    <br>
    <table class='table'>

        <tr>
            <th>Editar</th>
            <th>Nome Completo</th>
            <th>CRM/CRO/COREN</th>
            <th>Especialidade</th>
            <th>Deletar</th>
        </tr>

        <?php foreach($lista as $item): ?>

        <tr>
            <td>
                <button id="editar" class="button"><a href='<?=route("medico/index/{$item['id']}")?>'>Editar</a></button>  
            </td>
            <td><?=$item['nome']?></td>
            <td><?=$item['crm']?></td>
            <td><?=$especialidades[$item['especialidade']]?></td>
            <td>
                <button id="deletar" class="button"><a href='<?=route("medico/deletar/{$item['id']}")?>'>Deletar</a></button>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</section>

<?php include 'layout-bottom.php' ?>
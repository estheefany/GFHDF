<?php include 'layout-top.php' ?>

<link rel="stylesheet" href="<?=assets("css/frontt.css")?>" />

    <section class="container">
        <header>CADASTRO DE FUNCIONÁRIOS</header>
        <form  class="form" method='POST' action='<?=route('funcionario/salvar/'._v($data,"id"))?>'>
            <label class='input-box'>
                Nome Completo
                <input type="text" class="form-control" <?=hasError("nome","is-invalid")?> name="nome" value="<?=old("nome", _v($data,"nome"))?>" placeholder="Insira seu nome completo">
                <div class='invalid-feedback'><?=getValidationError("nome") ?></div>
            </label><br>

            <label class='input-box'>
                Email
                <input type="email" class="form-control" name="email" value="<?=_v($data,"email")?>" placeholder="Insira seu email">
            </label><br>

            <label class='input-box'>
                Senha
                <input type="password" class="form-control" name="senha" value="<?=_v($data,"senha")?>" placeholder="Insira sua senha">
            </label><br>


          <!--  <button class='btn btn-primary col-12 col-md-3 mt-3'>Salvar</button>
            <a class='btn btn-secondary col-12 col-md-3 mt-3' href="<?=route("funcionario")?>">Novo</a> -->

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
                <th>Email</th>
                <th>Deletar</th>
            </tr>

            <?php foreach($lista as $item): ?>

            <tr>
                <td>
                    <button id="editar" class="button"><a href='<?=route("funcionario/index/{$item['id']}")?>'>Editar</a></button>
                </td>
                <td><?=$item['nome']?></td>
                <td><?=$item['email']?></td>
                <td>
                   <button id="deletar" class="button"><a href='<?=route("funcionario/deletar/{$item['id']}")?>'>Deletar</a></button> 
                </td>


            <?php endforeach; ?>
        </table>
    </section>

<?php include 'layout-bottom.php' ?>
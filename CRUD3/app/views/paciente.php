<?php include 'layout-top.php' ?>

<link rel="stylesheet" href="<?=assets("css/frontt.css")?>" />

<section class="container">
    <header>CADASTRO DE PACIENTES</header>
    <form class="form" method='POST' action='<?=route('paciente/salvar/'._v($data,"id"))?>'>
        <div class="column">
                <div class="input-box">
                    <label class=''>
                          Sus
                          <input type="text" id="sus" class="inputUser" name="sus" value="<?=_v($data,"sus")?>" placeholder="Insira o número do sus">
                    </label>
                </div>
                <div class="input-box">
                    <label class=''>
                        Data de nascimento
                        <input type="date" class="inputUser" <?=hasError("dataNascimento","is-invalid")?>  name="dataNascimento" 
                        value="<?=old("dataNascimento", _v($data,"dataNascimento"))?>">
                        <div class="invalid-tooltip"><?=getValidationError("dataNascimento") ?></div>
                     </label>
                </div>
        </div>

        <!--<label class='col-md-6'>
            Sus
            <input type="text" class="form-control" name="sus" value="<?=_v($data,"sus")?>">
        </label>-->

        <label class='input-box'>
            Nome Completo
            <input type="text" class="form-control" name="nome" value="<?=_v($data,"nome")?>" placeholder="Insira seu nome completo">
        </label>

        <label class='input-box'>
            Email
            <input type="email" class="form-control" name="email" value="<?=_v($data,"email")?>" placeholder="Insira seu email">
        </label>

        <label class='input-box'>
            Senha
            <input type="password" class="form-control" name="senha" value="" placeholder="Insira sua senha">
        </label>

        <!--<label class='col-md-6'>
            Data de nascimento
            <input type="text" class="form-control" name="dataNascimento" value="<?=_v($data,"dataNascimento")?>">
        </label>-->

        <!--<label class='col-md-4 d-flex'>
            Sexo <br>
            <label class='col-md-2'>
                <input type="radio" class="form-check-input" name="sexo" value="m"
                    <?=_v($data,"sexo") == "m" ? 'checked' : '' ?>>
                M
            </label>

            <label class='col-md-2'>
                <input type="radio" class="form-check-input" name="sexo" value="f"
                    <?=_v($data,"sexo") == "f" ? 'checked' : '' ?>>
                F
            </label>
        </label><br> -->
        <br>
        <label class="boxSpaciente">
            Sexo
            <label class="">
                <label >
                    <input type="radio" name="sexo" value="m"
                        <?=_v($data,"sexo") == "m" ? 'checked' : '' ?>>
                    M
                </label>
                <label >
                    <input type="radio" class="" name="sexo" value="f"
                        <?=_v($data,"sexo") == "f" ? 'checked' : '' ?>>
                    F
                </label>
            </label>
        </label>

       <!-- <button>Salvar</button>
        <button href="<?=route("paciente")?>">Novo</button> -->

        <div class="column">
                <div class="input-box">
                     <button>Salvar</button>
                </div>
                <div class="input-box">
                     <button href="<?=route("paciente")?>">Novo</button>
                </div>
        </div>

    </form>

 
    <hr>

    <table class='table'>

        <tr>
            <th>Editar</th>
            <th>Sus</th>
            <th>Nome Completo</th>
            <th>Email</th>
            <th>Data de nascimento</th>
            <th>Sexo</th>
            <th>Deletar</th>
        </tr>

        <?php foreach($lista as $item): ?>

        <tr>
            <td>
                 <button id="editar" class="button"><a href='<?=route("paciente/index/{$item['id']}")?>'>Editar</a></button>
            </td>
            <td><?=$item['sus']?></td>
            <td><?=$item['nome']?></td>
            <td><?=$item['email']?></td>
            <td><?=$item['dataNascimento']?></td>
            <td><?=$item['sexo']?></td>
            <td>
                <button id="deletar" class="button"><a href='<?=route("paciente/deletar/{$item['id']}")?>'>Deletar</a></button> 
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</section>

<?php include 'layout-bottom.php' ?>
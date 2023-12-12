<?php include 'app/views/layout-top.php' ?>

<form method='POST' action='<?=route('autenticacao/salvar_usuario/'._v($data,"id"))?>'>

    <label class='col-md-6'>
        Nome
        <input type="text" class="form-control" name="nome" value="<?=old("nome")?>" >
    </label>

    <label class='col-md-4'>
        E-mail
        <input type="text" class="form-control" name="email" value="<?=old("email")?>" >
    </label>

    <label class='col-md-2'>
        Senha
        <input type="password" class="form-control" name="senha" >
    </label>

    <label class='col-md-2'>
        Confirmação da senha
        <input type="password" class="form-control" name="senhaConfirm" >
    </label>

    <button class='btn btn-primary col-12 col-md-3 mt-3'>Salvar</button>
    <a class='btn btn-secondary col-12 col-md-3 mt-3' href="<?=route("autenticacao/novo_usuario")?>">Novo</a>

</form>


<?php include 'app/views/layout-bottom.php' ?>
<?php include 'app/views/layout-top.php' ?>

<form method='POST' action='<?=route('autenticacao/salvar_alteracao_senha/')?>'>

    <input type="hidden" name="token" value="<?=$token?>">

    <label class='col-md-4'>
        Digite a sua nova senha
        <input type="password" class="form-control" name="senha" >
    </label>

    <label class='col-md-4'>
        Confirme a senha
        <input type="password" class="form-control" name="senhaConfirm" >
    </label>

    <button class='btn btn-primary col-12 col-md-3 mt-3'>Alterar senha</button>

</form>

<?php include 'app/views/layout-bottom.php' ?>

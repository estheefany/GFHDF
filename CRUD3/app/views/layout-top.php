<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med.Online - Agendamentos de Consultas Médicas</title>
    <link rel="shortcut icon" href="public/imgs/faviconn.ico" type="image/x-icon">


    <link rel="stylesheet" href="<?=assets('bootstrap/css/bootstrap.min.css')?>" />
    <script src="<?=assets('bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <link rel="stylesheet" href="<?=assets('css/estilo.css')?>" />
    <link rel="stylesheet" href="<?=assets("css/frontt.css")?>" />

    <script src="https://unpkg.com/imask"></script>
    <script src="<?=assets('js/main.js')?>"></script>
<body>


    <?php if (isset($_SESSION['user'])): ?>

    <!-- MENU -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=route('principal')?>">Início</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php 
                    
                    if ($_SESSION['user']['tipo'] == 'funcionario'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=route('paciente')?>">Paciente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=route('funcionario')?>">Funcionário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=route('medico')?>">Especialidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=route('horarios')?>">Horarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=route('consulta')?>">Consulta</a>
                        </li>
                    <?php endif; ?>

                   
                    <?php if ($_SESSION['user']['tipo'] == 'paciente'): ?>
                        <li class="nav-item">
                        <a class="nav-link" href="<?=route('consulta')?>">Consulta</a>
                        </li>
                    <?php endif; ?>
                        
                    <li class="nav-item">
                        <a class="nav-link" href="<?=route('autenticacao/logout')?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php endif; ?>

    <div class="container">

    <?php

        if (getFlash("success")){
            print "<div class='alert alert-success' role='alert'>".getFlash("success")."</div>";
        } else
        if (getFlash("error")){
            print "<div class='alert alert-danger' role='alert'>".getFlash("error")."</div>";
        }

    ?>

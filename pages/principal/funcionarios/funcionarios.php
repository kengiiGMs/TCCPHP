<?php
    session_start();
    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
     unset($_SESSION['usuario']);
     unset($_SESSION['senha']);
     header('location: ../../index.php');
    }else if ($_SESSION['tipo'] != 'A'){
          echo "<script LANGUAGE= 'JavaScript'>
                window.alert('Você não possui acesso a essa página');
                window.location.href='../home.php';
                </script>";
    }else{
         include_once('../../../connection/conexao.php');
    $logado = $_SESSION['usuario'];
    $banco = new conexao();
    $con = $banco->getConexao();
    $sql = "select imagem_usuario from usuario where nome_usuario = '$logado'";
    $result = $con->query($sql);
    if ($result->rowCount() > 0) {

    while ($row = $result->fetch()) {
    $imagemU = $row['imagem_usuario'];
}
}
    }

   

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../imgs/favicon.ico" type="image/x-icon">
    <title>Funcionario</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
    <?php include '../../style.css';
    ?>
    </style>
</head>

<header style="margin-bottom: 100px;">
    <nav class="navbar navbar-expand-lg" style="background-color: white;position: fixed;z-index: 1000;width: 100%;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../home.php"><img src='../../../imgs/logo2.png' width="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="../responsavelFamilia/responsavelFamilia.php"
                            style="color:green">FAMILIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cestas/cestas.php" style="color:green">CESTAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard/dashboard.php" style="color:green">FINANCEIRO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../funcionarios/funcionarios.php" style="color:green">FUNCIONÁRIOS</a>
                    </li>

                </ul>
                <li class="nav-item dropdown " style="list-style: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="color:green">
                        <?php echo '<img src="data:../../../imgs/conta;base64,' . base64_encode($imagemU) . '" style="border-radius:50px;width: 40px; height: 40px;">' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../conta/conta.php" style="color:green">VER PERFIL</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../../crud/login/sair.php" style="color:green">SAIR</a>
                        </li>
                    </ul>
                </li>

            </div>
        </div>
    </nav>
</header>

<body style="background-color:whitesmoke">

    <div class="container-fluid">
        <div class="row" style="margin-bottom:15px">
            <div class="col m-auto" style="text-align:center">
                <div id="modalCadastro">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" style="font-size: 1.2em; width: 200px; margin-top:50px">Cadastrar
                        <br> Funcionários</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container" style="text-align:center">
                                        <h5 class="modal-title" style="color: green;">Funcionários</h5>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../../../crud/criarConta/controleCriarConta.php"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <h1
                                            style="text-align:center; font-size:25px; padding:15px; color:rgba(25,135,84,255)">
                                            CRIAR CONTA</h1>
                                        <div class="form-floating mb-3 mt-3">
                                            <input type="text" class="form-control inputCadastro" placeholder="Digite o seu Usuario"
                                                required name="cadastrarULogin">
                                            <label class="labelCadastro">Digite o Nome de Usuario</label>
                                        </div>
                                        <div class="form-floating mt-3 mb-3">
                                            <input type="email" class="form-control inputCadastro" placeholder="Digite o seu Email"
                                                name='cadastrarUEmail' required>
                                            <label class="labelCadastro">Digite o Email</label>
                                        </div>
                                        <div class="form-floating mt-3 mb-3">
                                            <input type="password" class="form-control inputCadastro" placeholder="Digite a sua Senha"
                                                name='cadastrarUSenha' required>
                                            <label class="labelCadastro">Digite a Senha</label>
                                        </div>
                                        <div class="form-floating mt-3 mb-3">
                                            <input type="password" class="form-control inputCadastro" placeholder="Repita a sua Senha"
                                                name='cadastrarUCSenha' required>
                                            <label class="labelCadastro">Repita a Senha</label>
                                        </div>
                                        <div class="mt-3 mb-3">

                                            <label for="arquivo" class="form-control labelCadastro" id="lblArquivoCriarConta">Escolha
                                                uma Foto de Perfil</label>
                                            <input type="file" class="form-control" name="arquivo" id="arquivo">
                                        </div>
                                        <div style="margin-bottom:15px">
                                            <select class="form-select labelCadastro" name="cadastrarUTipo">
                                                <option value="F" name="cadastrarUTipo" class="labelCadastro">Funcionario</option>
                                                <option value="A" name="cadastrarUTipo" class="labelCadastro">Administrador</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-danger btn-lg btn-block"
                                                style="font-size:16px"
                                                onclick="window.location.href='funcionarios.php'">Voltar</button>
                                            <button type="submit" class="btn btn-outline-success btn-lg btn-block"
                                                style="font-size:16px" value="cadastrar" name="botao">Cadastrar</button>
                                    </form> 
                                    </div>       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="overflow-auto">
            <div class="column">
                <div class="m-2 ">
                    <table class="table" style="color:green">
                        <thead>
                            <th scope="col" style='text-align:center'>#</th>
                            <th scope="col" style='text-align:center'>Nome</th>
                            <th scope="col" style='text-align:center'>Tipo</th>
                            <th scope="col" style='text-align:center'>Email</th>
                            <th scope="col">Ações</th>
                        </thead>
                        <tbody>
                            <?php 
                                
                                include_once ("../../../connection/conexao.php");
                                $sql= "SELECT * FROM usuario";
                                $banco = new conexao();
                                $con = $banco->getConexao();
                                $result = $con->query($sql);
                                while($row = $result->fetch()){
                                    ?>
                            <tr>
                                <td><span
                                        id="nome<?php echo $row['id_usuario']; ?>"><?php echo $row['id_usuario']; ?></span>
                                </td>
                                <td><span
                                        id="nome<?php echo $row['nome_usuario']; ?>"><?php echo $row['nome_usuario']; ?></span>
                                </td>
                                <td><span
                                        id="tipo<?php echo $row['tipo_usuario']; ?>"><?php echo $row['tipo_usuario']; ?></span>
                                </td>
                                <td><span
                                        id="email<?php echo $row['email_usuario']; ?>"><?php echo $row['email_usuario']; ?></span>
                                </td>
                                <td>
                                <button class='btn btn-sm btn-outline-primary edit'
                                        value="<?php echo $row['id_usuario']; ?>">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                                            fill='currentColor' class='bi bi-clipboard' viewBox='0 0 16 16'>
                                            <path
                                                d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z' />
                                            <path
                                                d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z' />
                                        </svg>
                                    </button>
                                    <button class='btn btn-sm btn-outline-danger delete'
                                        value="<?php echo $row['id_usuario']; ?>">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                                            fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                            <path
                                                d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z' />
                                            <path fill-rule='evenodd'
                                                d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z' />
                                        </svg>
                                    </button>

                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <?php
                                    }
                                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- <?php include('modalEdit.php'); ?>
    <?php include('modalDelete.php'); ?>
    <script src="customEdit.js"></script>
    <script src="customDelete.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
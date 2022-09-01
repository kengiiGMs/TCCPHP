<?php
session_start();
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location: ../../indexlogin.php');
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../Js/consultaCEP.js"></script>
    <title>Consulta</title>



    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            $("#header").load("header.php");
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        <?php include '../style.css';
        ?>
    </style>
</head>

<body>
    <header id="header"></header>
    <div class="container-fluid">

        <div class="row" style="margin-bottom:15px">
            <!-- Deletar -->
            <div class="col m-auto" style="text-align:center">
                <div id="modalCadastrar">
                    <!-- Button Deletar -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalCadastrar" style="font-size: 1.2em; width: 200px; margin-top:50px">Cadastrar <br> Família</button>
                    <!-- Button Deletar -->
                    <!-- Modal Deletar -->
                    <div class="modal fade" id="exampleModalCadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">Família</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action='../../crud/familia/controleFamilia.php' method='GET'>
                                        <p>
                                            <input class="inputModalCadastro" type="text" name="nome" placeholder="Nome" required />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="date" name="dataNasc" placeholder="Data de Nascimento" required />
                                        </p>
                                        <p>
                                            <select class="form-select" aria-label="Default select example" name="sexoP">
                                                <option value="F" name="sexoP">Feminino</option>
                                                <option value="M" name="sexoP">Masculino</option>
                                            </select>
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" name="celular" placeholder="Celular" />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" name="telefone" placeholder="Telefone" />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="email" name="email" placeholder="Email" />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" onblur="pesquisacep(this.value);" id="cep" name="cep" placeholder="CEP" required />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" id="endereco" name="rua" placeholder="Rua" />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" id="bairro" name="bairro" placeholder="Bairro" />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" id="cidade" name="cidade" placeholder="Cidade" />
                                        </p>
                                        <p>
                                            <input type="text" name="estado" id="estado" value="Estado">
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="number" name="numRes" placeholder="Número da Residência" required />
                                        </p>
                                        <p>
                                            <input class="inputModalCadastro" type="text" name="complemento" placeholder="Complemento" />
                                        </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Fechar
                                    </button>
                                    <p><input type="submit" class="btn btn-success" name='botao' value='Cadastrar'>
                                    </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="overflow-auto">
                <table class="table" style="color:green;">
                    <thead>
                        <tr><a href="#">
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Celular</th>
                        </tr></a>
                    </thead>
                    <tbody>
                        <?php

                        include_once("../../connection/conexao.php");
                        $sql = "SELECT familia.idFamilia, familia.nome_familia,
                                familia.data_nascimento_familia,familia.sexo_familia,contato.celular FROM familia INNER JOIN contato ON familia.idFamilia = contato.IdContato";
                        $sqlSelect = "SELECT familia.idFamilia, familia.nome_familia,familia.data_nascimento_familia,
                                familia.sexo_familia,contato.celular,contato.telefone,contato.email,familia.complemento_familia,
                                familia.n_familia,familia.data_atendimento,codigoEnderecoPostal.cep,codigoEnderecoPostal.rua,
                                codigoEnderecoPostal.bairro,codigoEnderecoPostal.estado,codigoEnderecoPostal.cidade	 
                                FROM familia INNER JOIN contato ON familia.idFamilia = contato.IdContato 
                                INNER JOIN codigoEnderecoPostal on familia.idFamilia = codigoEnderecoPostal.idCep 
                                where idFamilia=idFamilia";
                        $banco = new conexao();
                        $con = $banco->getConexao();
                        $resultados_familia = $con->query($sql);
                        $result = $con->query($sqlSelect);

                        if ($result->rowCount() > 0) {

                            while ($user_data = $result->fetch()) {
                                $idFamilia = $user_data['idFamilia'];
                                $nome_familia = $user_data['nome_familia'];
                                $data_nascimento_familia = $user_data['data_nascimento_familia'];
                                $sexo_familia = $user_data['sexo_familia'];
                                $complemento_familia = $user_data['complemento_familia'];
                                $n_familia = $user_data['n_familia'];
                                $data_atendimento = $user_data['data_atendimento'];

                                $celular = $user_data['celular'];
                                $telefone = $user_data['telefone'];
                                $email = $user_data['email'];

                                $cep = $user_data['cep'];
                                $rua = $user_data['rua'];
                                $bairro = $user_data['bairro'];
                                $estado = $user_data['estado'];
                                $cidade = $user_data['cidade'];
                            }
                        }


                        while ($row = $resultados_familia->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['idFamilia'] . "</td>";
                            echo "<td>" . $row['nome_familia'] . "</td>";
                            echo "<td>" . $row['data_nascimento_familia'] . "</td>";
                            echo "<td>" . $row['sexo_familia'] . "</td>";
                            echo "<td>" . $row['celular'] . "</td>";
                            echo "<td>
                                   
                            <a class='btn btn-sm btn-outline-danger' data-bs-toggle='modal' data-bs-target='#taticBackdrop'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                              <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                              <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                            </svg>
                                </a>
                                 <div class='modal fade' id='taticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='staticBackdropLabel'>Excluir Cesta</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='../../crud/familia/editFamilia.php' method='GET'>
                                            <p>
                                                <input class='inputModalEdit' type='number' min='0' name='idFamilia' placeholder='Id'
                                                    value='$idFamilia' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' name='nome' placeholder='Nome'
                                                    value='$nome_familia' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='date' name='dataNasc' placeholder='Data de Nascimento'
                                                    value='$data_nascimento_familia'/>
                                            </p>
                                            <p>
                                                <select class='form-select' aria-label='Default select example' name='sexoP'>
                                                    <option value= '$sexo_familia' name='sexoP'>
                                                    </option>
                                                    <option value='F' name='sexoP'>Feminino</option>
                                                    <option value='M' name='sexoP'>Masculino</option>
                                                </select>
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' name='celular' placeholder='Celular'
                                                    value='$celular' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' name='telefone' placeholder='Telefone'
                                                    value='$telefone' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='email' name='email' placeholder='Email'
                                                    value='$email' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' onblur='pesquisacep(this.value);' id='cep' name='cep'
                                                    placeholder='CEP' value='$cep' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' id='endereco' name='rua' placeholder='Rua'
                                                    value='$rua' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' id='bairro' name='bairro' placeholder='Bairro'
                                                    value='$bairro' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' id='cidade' name='cidade' placeholder='Cidade'
                                                    value='$cidade' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' name='estado' id='estado'
                                                    value='$estado' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='number' name='numRes' placeholder='Número da Residência'
                                                    value='$n_familia' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='text' name='complemento' placeholder='Complemento'
                                                    value='$complemento_familia' />
                                            </p>
                                            <p>
                                                <input class='inputModalEdit' type='date' name='dataAtendimento'
                                                    placeholder='Data de Atendimento' value='$data_atendimento' />
                                            </p>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-warning' data-bs-dismiss='modal'>Cancelar</button>
                                                <p style='text-align:center'><input type='submit' class='btn btn-success' name='update' value='update'>
                                            </div> 
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>



</html>
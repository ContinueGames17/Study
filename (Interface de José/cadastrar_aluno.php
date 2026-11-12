<!DOCTYPE html>
<html lang="pt-br">
        <head>
                <meta charset="UTF-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <link rel="stylesheet" href="enfeite/css.css"/>
                <link rel="shortcut icon" href="enfeite/sigafavicon.png" type="image/x-icon"/>
                <title>Cadastrar aluno • SIGA</title>
                <style>
                        /* Classes de componente */
                        body {
                                font-family: Arial, Helvetica, sans-serif;
                                background-color: grey;
                        }
                        input {
                                padding: 15px;
                                border: none; border-radius: 10px;
                                outline: none;
                                font-size: 15px;
                        }

                        /* Classes customizadas */
                        .mainwindow {
                                padding: 40px;
                        }
                        .labelmudarcor {
                                font-size: 15px;
                                background-color: dodgerblue;
                                border-radius: 10px;
                                color: black;
                                padding: 5px;
                                position: fixed;
                                flex-direction: row; flex: 5px; right: 5px;
                        }

                        /* Classes de ID */
                        #bCadastrar {
                                transition: filter 0.5s ease;
                        }
                        #bCadastrar:hover {
                                filter: brightness(145%);
                                transition: filter 0.5s ease;
                        }
                </style>
        </head>
        <body>
                <div style="background-color: rgb(0, 0, 0); position: absolute; border-radius: 10px; padding: 10px">
                        <img src="enfeite/siga.png" alt="SIGA" width="150px" style="position: relative">
                </div>

                <label class="labelmudarcor" style="padding-right: 55px" for="BackColor">Mudar cor de fundo:</label>
                <input type="color" id="BackColor" class="labelmudarcor" value="grey">

                <div class="mainwindow">
                        <form action="" method="POST">
                                <h1 style="text-align: center">Cadastrar</h1>

                                <input type="text" name="Nome" style="margin-bottom: 10px; width: 91%" placeholder="Digite o nome" title="Digite o nome do aluno" required/><br>
                                <input type="date" name="Senha" style="margin-bottom: 10px; width: 91%" title="Defina a data de nascimento do aluno" required/><br>
                                <input type="submit" id="bCadastrar" value="Cadastrar aluno" title="Clique para cadastrar aluno" style="width: 100%; cursor: pointer; background-color: dodgerblue"/>
                        </form>
                        <div style="padding-top: 10px; text-align: center">
                                <?php
                                        $acentos   = ['á','à','ã','â','é','ê','í','ó','ô','õ','ú','ü','ç','Á','À','Ã','Â','É','Ê','Í','Ó','Ô','Õ','Ú','Ü','Ç'];
                                        $semAcento = ['a','a','a','a','e','e','i','o','o','o','u','u','c','A','A','A','A','E','E','I','O','O','O','U','U','C'];

                                        $host = "localhost"; $usuario = "root"; $senha = ""; $banco = "bdSIGA";
                                        $sql = mysqli_connect($host, $usuario, $senha, $banco);
                                        $sql->set_charset("utf8mb4");
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                $nome = htmlspecialchars($_POST['Nome']);
                                                $tempp = str_replace($acentos, $semAcento, $nome);

                                                $temp = explode(' ', $tempp);
                                                $email = strtolower($temp[0].".".end($temp)."@fatec.sp.gov.br");

                                                $data = $_POST["Senha"];
                                                $temp2 = explode('-', $data);
                                                $data = $temp2[2].$temp2[1].$temp2[0];

                                                try {
                                                        $metodo = "INSERT INTO alunos (nome, email, senha) VALUES ('$nome', '$email', '$data')";
                                                        $resultado = $sql->query($metodo);
                                                        echo "<label>Cadastro efetuado com êxito: $nome</label>";
                                                }
                                                catch (Exception $e) {
                                                        echo "<label>Erro ao cadastrar dados no banco: $e</label>";
                                                }
                                        }
                                ?>
                        </div>
                </div>


                <!--* SCRIPTS *-->
                <script> // COMANDOS GERAIS PARA DEFINIR A COR DE FUNDO DO SITE
                        CarregarCorSalva();
                        
                        function CarregarCorSalva() {
                                const CorSalva = localStorage.getItem('BackColorr');
                                if (CorSalva) {
                                        document.body.style.backgroundColor = CorSalva
                                        BackColor.value = CorSalva;
                                }
                        }



                        BackColor.addEventListener("input", function() {
                                const CorSelecionada = BackColor.value;
                                document.body.style.backgroundColor = CorSelecionada;
                                localStorage.setItem("BackColorr", CorSelecionada);
                        });
                </script>
        </body>
</html>

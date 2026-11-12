<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="enfeite/sigafavicon.png" type="image/x-icon">
    <link rel="stylesheet" href="enfeite/css.css">
    <link rel="import" href="js/main.js">
    <title>Login • SIGA</title>
    <style>
      /* Classes de componente */
      body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: grey;
      }
      input {
        padding: 15px;
        border: none;
        border-radius: 10px;
        outline: none;
        font-size: 15px;
      }

      /* Classes customizadas */
      .botãoentrar {
        background-color: dodgerblue;
        color: black;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 15px;
        font-size: 15px;
        transition: filter 0.5s ease;
      }
      .botãoentrar:hover {
        filter: brightness(125%);
        cursor: pointer;
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
    </style>
  </head>
  <body>
    <label class="labelmudarcor" style="padding-right: 55px" for="BackColor">Mudar cor de fundo:</label>
    <input type="color" id="BackColor" class="labelmudarcor" value="grey">

    <div class="mainwindow">
      <form action="" method="GET">
        <img src="enfeite/siga.png" alt="SIGA" width="150px" style="position: relative; transform: translate(25%, 0%)">

        <h1 style="text-align: center">Fazer login</h1>
        <input type="email" name="Email" style="margin-bottom: 10px" placeholder="Digite seu e-mail"/><br/>
        <input type="password" name="Senha" style="margin-bottom: 10px" placeholder="Digite sua senha"/><br/>

        <input type="submit" class="botãoentrar" value="Entrar">
      </form>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          $email = $_GET["Email"];
          $senha = $_GET["Senha"];
          $email = strtolower($email);
          $sql = mysqli_connect("localhost", "root", "", "bdSIGA");
          $sql->set_charset("utf8mb4");
          $metodo = "SELECT * FROM alunos WHERE email = '$email' AND senha = '$senha'";

          try {
            $resultado = $sql->query($metodo);
            if ($resultado->num_rows > 0) {
              echo "Login realizado com sucesso!";
            } else {
              echo "E-mail ou senha incorretos.";
            }
          }
          catch (Exception $e) {
            echo "Erro ao inserir dados no banco de dados: $e.";
          }
        }
      ?>
    </div>


    
    <!-- SCRIPTS -->
    <script>
      const CorSelecionada = document.getElementById('BackColor');
      CarregarCorSalva();

      function CarregarCorSalva() {
        const CorSalva = localStorage.getItem('BackColorr');
        if (CorSalva) {
          document.body.style.backgroundColor = CorSalva;         // Define a propriedade de estilo background-color do <body> do documento para a cor salvada
          CorSelecionada.value = CorSalva;                        // Atualiza o seletor visualmente
        }
      }

      // Escuta a mudança de cor no seletor (on 'evento').
      CorSelecionada.addEventListener('input', (evento) => {
        const CorSelecionada = evento.target.value;
        document.body.style.backgroundColor = CorSelecionada;
        localStorage.setItem('BackColorr', CorSelecionada);         // Define, localmente, a cor de background do HTML pela cor selecionada
      });
    </script>
  </body>
</html>
<?php
    include_once("conexao/conexao.php");
    $url = isset($_GET['pagina']) ? $_GET['pagina'] : "home";
    $pagina = "$url.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Crud</title>
        <base href="/projeto_thread_sistemas/">
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    </head>
    <body>
        <nav>
            <div class="container">
                <div class="row">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?pagina=cadastrar">Cadastro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <main>
            <div class="container">
                
                <?php
                    include_once($pagina);
                ?>

            </div>
        </main>

        <script src="assets/jquery/jquery-3.3.1.slim.min.js"></script>
        <script src="assets/jquery/jquery.mask.js"></script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.cpf').mask('000.000.000-00', {reverse: true});
                $('.phone_with_ddd').mask('(00) 00000-0000');
            });

            function imagePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        $('#imagem').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#foto").change(function() {
                imagePreview(this);
            });
        </script>
    </body>
</html>
<?php
  if(isset($_POST['cadastrar'])) {
    list($width, $height, $extension) = getimagesize($_FILES['foto']['tmp_name']);
    $extension = image_type_to_extension($extension);
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $celular = $_POST['celular'];
    $cpf = $_POST['cpf'];
    $foto = $_FILES['foto'];

    if(empty($nome))
		  $erro = "Campo nome obrigatório";
	  else if(empty($email))
		  $erro = "Campo e-mail obrigatório";
    else if(empty($celular))
      $erro = "Campo celular obrigatório";
    else if(empty($cpf))
      $erro = "Campo cpf obrigatório";
    else if($extension !== '.jpg' && $extension !== '.jpeg')
      $erro = "A imagem deve ter o formato .jp(e)g";
    else if($width < 800 || $height < 800 )
      $erro = "A imagem deve ter a resolução mínima de 800x800 pixels";
    else {

      $arquivo_temporario = $foto['tmp_name'];
      $nome_arquivo = basename($foto['name']);
      $diretorio = "imagens";
      $caminho_arquivo = $diretorio . "/" . str_replace(" ", "", date("Y-m-d H-i-s")) . $nome_arquivo;

      try {
        $stmt = $connection->prepare("INSERT INTO usuario (nome_completo, email, sexo, telefone_celular, cpf, foto) 
                                      VALUES (:nome_completo, :email, :sexo, :telefone_celular, :cpf, :foto)");
        $stmt->bindValue(':nome_completo', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':sexo', $sexo);
        $stmt->bindValue(':telefone_celular', $celular);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':foto', $caminho_arquivo);
        if($stmt->execute())
          $upload = move_uploaded_file($arquivo_temporario, $caminho_arquivo);
        echo "<script>alert('Dados cadastrados com sucesso!');</script>"; 
      } catch (PDOException $e) {
        $erro = $e->getMessage();
      }
    }
  }
?>

<h1>Cadastrar</h1>
<div class="row">
  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data" class="col-12">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" required>
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="sexo">Sexo</label>
      <select name="sexo" class="form-control" id="sexo">
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>
    </div>
    <div class="form-group">
      <label for="celular">Telefone Celular</label>
      <input type="tel" class="form-control phone_with_ddd" name="celular" id="celular" required>
    </div>
    <div class="form-group">
      <label for="cpf">CPF</label>
      <input type="text" class="form-control cpf" name="cpf" id="cpf" required>
    </div>
    <div class="form-group">
      <div style="width: 100%; height: 250px; display: flex; justify-content: left; align-items: center;">
        <img style="max-width: 300px; max-height: 100%;" id="imagem" src="#" alt="foto de perfil" />
      </div>
      <label for="foto">Foto</label>
      <input type="file" class="form-control-file" name="foto" id="foto" required>
    </div>
    <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
    <?php
      if(isset($erro))
        echo '<div style="color:#F00">* '.$erro.'</div><br/><br/>';
    ?>
  </form>
</div>
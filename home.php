<div class="row">
  <ul class="list-group col-12">
  
<?php
  $query = 'SELECT id, 
                   nome_completo 
              FROM usuario 
          ORDER BY nome_completo';
  $stmt = $connection->query($query);
  $totalRegistros = $stmt->rowCount();
  if($totalRegistros > 0) {
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
?>
    <li class="list-group-item">
      <?= $row['nome_completo'] ?>
      <a class="float-right col-1" onclick="return confirm('Deseja mesmo excluir o registro?')" href="?pagina=remover&id=<?= $row['id'] ?>">Excluir</a>
      <a class="float-right col-1" href="?pagina=alterar&id=<?= $row['id'] ?>">Editar</a>
    </li>
<?php
    }
  } else {
?>
    <li class="list-group-item">Nenhum usuário cadastrado.</li>
<?php
  }
?>
  </ul>
</div>
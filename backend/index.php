<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php require_once 'process.php'; ?>

    <?php 
      $mysqli = new mysqli('localhost', 'root', '', 'hibridoback') or die(mysqli_error($mysqli));
      $results = $mysqli->query("SELECT * FROM users") or die($mysqli->error);
    ?>

    <div class="container mt-5">
      <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>CPF</th>
              <th>Telefone</th>
              <th colspan="2">Ação</th>
            </tr>
          </thead>

          <?php 
            while($row = $results->fetch_assoc()):
          ?>

          <tr>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['cpf']; ?></td>
              <td><?php echo $row['tel']; ?></td>
              <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Deletar</a>
              </td>
          </tr>
            <?php endwhile; ?>

        </table>
      </div>
    </div>

    <?php
      function pre_r( $array ) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
      }
    ?>
    <div class="container mt-5">
      <div class="row justify-content-center">
          <form action="process.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id ?>">
              <div class="form-group">
                  <label>Nome</label>
                  <input type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo $name ?>"
                        placeholder="Digite seu nome completo"
                  >
              </div>

              <div class="form-group">
                  <label>E-mail</label>
                  <input type="text"
                        name="email"
                        class="form-control"
                        value="<?php echo $email ?>"
                        placeholder="Digite seu E-mail"
                  >
              </div>

              <div class="form-group">
                  <label>CPF</label>
                  <input type="text"
                        name="cpf"
                        class="form-control"
                        value="<?php echo $cpf ?>"
                        placeholder="Digite seu CPF"
                  >
              </div>

              <div class="form-group">
                  <label>Telefone</label>
                  <input type="text"
                        name="tel"
                        class="form-control"
                        value="<?php echo $tel ?>"
                        placeholder="Digite seu Telefone"
                  >
              </div>

              <div class="form-group">
                <?php if($update == true): ?>
                  <button type="submit" name="update" class="btn btn-info">Editar</button>
                  <button type="submit" name="cancel" class="btn btn-warning">Cancelar</button>
                <?php else: ?>
                  <button type="submit" name="save" class="btn btn-primary">Salvar</button>
                <?php endif; ?>
              </div>
          </form>
      </div>

      <?php
        if (isset($_SESSION['message'])):
      ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show mt-5" role="alert">
        <?php 
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
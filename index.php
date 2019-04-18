<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud com PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<style>
    input[type='file'] {
        display: none
    }

    .card-img-top {
        width: 100% !important;
        height: 50% !important;
    }
</style>


<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])) :  ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            ?>
        </div>
    <?php endif ?>


    <div class="container-fluid">
        <h1 class="text-center">Cadastro de Produtos</h1>

        <div class="container">
            <form action="process.php" method="post" class="mt-3" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="text" name="preco" value="<?php echo $preco; ?>" placeholder="Preço" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="text" name="descricao" value="<?php echo $descricao; ?>" placeholder="Descrição" class="form-control">
                    </div>
                    <div class="col-1">
                        <label for='imagem' class="btn btn-primary"><i class="fas fa-image"></i></label>
                        <input id='imagem' type='file' name="myfile">
                    </div>
                    <div class="col-2">
                        <?php
                        if ($update == true) :
                            ?>
                            <button type="submit" name="update" class="btn btn-info"><i class="fas fa-edit"></i></button>
                            <button type="submit" name="exit" class="btn btn-dark"><i class="fas fa-times"></i></button>
                        <?php else :  ?>
                            <button type="submit" name="salvar" class="btn btn-success"><i class="fas fa-plus"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>





        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud_produtos') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM produtos") or die($mysqli->error);
        ?>

        <div class="container">
            <div class="row">
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <div class="card ml-2 mt-2" style="width: 18rem;">
                        <div class="card-body">
                            <img src="uploads/<?php echo $row['imagem']; ?>" class="card-img-top">
                            <div class="text-center mt-2">
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <h6 class="card-title"><?php echo $row['nome']; ?></h6>
                                <h5 class="card-title">R$ <?php echo $row['preco']; ?></h5>
                                <p class="card-text"><?php echo $row['descricao']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>




    </div>


</body>

</html>
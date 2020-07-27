<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
    <link rel="stylesheet" href="<?= INCLUDE_PATH ?>views/style.css">
    <script src="https://kit.fontawesome.com/54d3e29c86.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="descricao-home">
        <div class="container">
            <h2><i class="fas fa-bullhorn"></i> Faça seu pedido conosco</h2>
            <a href="<?= INCLUDE_PATH ?>fechar-pedido">Fechar Pedido</a>
            <div class="clear"></div>
        </div>
    </section>

    <section class="lista-produtos">
        <div class="container">
            <?php 
                $espetinho = deliveryModel::listarItems();
                foreach ($espetinho as $key => $value) {
            ?>
            <div class="box-single-food">
                <p><?= $value['0']; ?></p>
                <img src="<?php echo INCLUDE_PATH?>images/<?= $value['1']; ?>">
                <p>R$<?= $value['2']; ?></p>
                <a href="<?= INCLUDE_PATH ?>?addCart=<?= $key ?>">Adicionar ao carrinho</a>
            </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </section>
</body>
</html>
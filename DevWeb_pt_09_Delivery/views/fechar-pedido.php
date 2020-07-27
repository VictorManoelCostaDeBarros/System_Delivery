<?php 
    if(!isset($_SESSION['carrinho'])){
        die('Você não tem items no carrinho!');
    }
?>

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
            <h2><i class="fas fa-shopping-cart"></i> Seu pedido!</h2>
            <a href="<?= INCLUDE_PATH ?>home">Voltar home</a>
            <div class="clear"></div>
        </div>
    </section>
    <div class="container">
        <table width="100%">
            <tr>
                <td>Nome</td>
                <td>#</td>
                <td>Preço</td>
            </tr>
            <?php
                $carrinhoItems = deliveryModel::getItemsCart();
                foreach ($carrinhoItems as $key => $value) {
                $item = deliveryModel::getItem($value);
            ?>
                <tr>
                    <td><?php echo $item[0]; ?></td>
                    <td><img src="<?php echo INCLUDE_PATH.'images/'.$item[1]; ?>"></td>
                    <td>R$<?php echo number_format($item[2], 2, ',', '.'); ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>

        <p>O total do seu pedido foi: R$<?php echo number_format(deliveryModel::getTotalPedido(), 2, ',', '.'); ?></p>
        <br>
        <br>
        <form method="post">
            <label>Escolha seu metodo de pagamento:</label>
            <select name="opcao_pagamento">
                <option value="cartao credito">Cartão de Credito</option>
                <option value="cartao debito">Cartão de Debito</option>
                <option value="dinheiro">Dinheiro</option>
            </select>
            <div class="troco" style="display:none;">
                <label>Troco para quanto?</label>
                <input type="text" name="troco">
            </div>
            <input type="submit" name="acao" value="Fechar Pedido!">
        </form>

        <br>
        <br>
    </div>

    <?php 
        if(isset($_POST['acao'])){
            if(!isset($_SESSION['carrinho'])){
                die('você não tem items no carrinho! clique <b><a href="'.INCLUDE_PATH.'home">Aqui</a> e escolha seu pedido!</b>');
            }

            $metodoPagamento = $_POST['opcao_pagamento'];
            $_SESSION['tipo_pagamento'] = $metodoPagamento;
            $_SESSION['total'] = deliveryModel::getTotalPedido();

            if($metodoPagamento == 'dinheiro'){
                if($_POST['troco'] != ''){
                    $valorTroco = $_POST['troco'] - deliveryModel::getTotalPedido();
                    if($valorTroco >= 0){
                        $_SESSION['valor_troco'] = $valorTroco;
                    }else{
                        die('Você não especifico um valor correto para troco!');
                    }
                }else{
                    die('você escolheu dinheiro como pagamento, portanto precisa especificar o troco!');
                }
            }
            echo '<script>alert("Seu pedido foi efetuado com sucesso!")</script>';
            echo '<script>location.href="'.INCLUDE_PATH.'historico"</script>'; 
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $('select').change(function(){
            if($(this).val() == 'dinheiro'){
                $('.troco').show()
            }else{
                $('.troco').hide()
            }
        })
    </script>
</body>
</html>
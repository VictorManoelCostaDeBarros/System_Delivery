<?php 
    if(!isset($_SESSION['tipo_pagamento'])){
        die('Você não tem items no carrinho e não fecho o pedido!');
    }
?>

<h2>Pedido em andamento: </h2>

<p>Tipo de pagamento: <?php echo $_SESSION['tipo_pagamento']; ?></p>
<hr>
<p>Total: R$<?php echo number_format($_SESSION['total'], 2, ',', '.'); ?></p>


<?php 
    if($_SESSION['tipo_pagamento'] == 'dinheiro'){
        echo '<hr>';
        echo '<p>Troco: R$'.number_format($_SESSION['valor_troco'], 2, ',', '.').'</p>';
    }
?>

<h2>Items do seu pedido: </h2>
<div class="container">
        <table width="100%">
            <tr>
                <td>Nome</td>
                <td>Preço</td>
            </tr>
            <?php
                $carrinhoItems = deliveryModel::getItemsCart();
                foreach ($carrinhoItems as $key => $value) {
                $item = deliveryModel::getItem($value);
            ?>
                <tr>
                    <td><?php echo $item[0]; ?></td>
                    <td>R$<?php echo number_format($item[2], 2, ',', '.'); ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
</div>

<br>
<br>
<a href="<?php echo INCLUDE_PATH ?>historico?resetar">Pedido Entrege!</a>
<br>
<?php 
    if(isset($_GET['resetar'])){
        session_destroy();
        header('Location: '.INCLUDE_PATH);
    }
?>
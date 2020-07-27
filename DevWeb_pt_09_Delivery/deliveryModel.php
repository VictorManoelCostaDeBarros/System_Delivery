<?php 
    class deliveryModel{   

        public static $items = array(array('Espetinho de carne','espetinho1.jpg','20.00'),array('Espetinho de frango','espetinho2.jpg','40.00'),array('Espetinho de queijo','espetinho3.jpg','60.00') );

        public static function listarItems(){
            return self::$items;
        }

        public static function addToCart($idProduto){
            if(!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array();
            }
            $_SESSION['carrinho'][] = $idProduto;
        }

        public static function getItemsCart(){
            return $_SESSION['carrinho'];
        }

        public static function getItem($id){
            return self::$items[$id];
        }

        public static function getTotalPedido(){
            $valor = 0;
            foreach ($_SESSION['carrinho'] as $key => $value) {
                $itemPreco = self::getItem($value)[2];
                $valor += $itemPreco;
            }
            return $valor;
        }
    }
    
?>
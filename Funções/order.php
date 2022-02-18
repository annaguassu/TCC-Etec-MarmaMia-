<?php 

    /**
     * Criar pedido 
     */
    function createOrder($pdo, $customer, $cartProducts, $total){
        /**
         * SQL para salvar as informações do pedido
         */
        $sql = "INSERT INTO pedidos SET id_cliente = :id_cliente, id_fornecedor = :id_fornecedor, status = :status, total = :total, created = NOW(), modified = NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_cliente', $customer['id_cliente']);
        foreach($cartProducts as $cart) {
            $stmt->bindValue(':id_fornecedor', $cart['id_fornecedor']);
        }
        $stmt->bindValue(':status', 'Recebido'); 
        $stmt->bindValue(':total', $total); 
        if(!$stmt->execute()) {
            return false;
        }
        
        //Recupera o ID inserido
        $id_pedido = $pdo->lastInsertId();

        /**
         * SQL para inserir os produtos do pedido
         */
        $sql = "INSERT INTO pedidos_itens SET id_pedido = :id_pedido, id_cliente = :id_cliente, id_fornecedor = :id_fornecedor, id_produto = :product_id, nome = :nome, quantidade = :quantity, preco = :price, subtotal = :subtotal";
        $stmt = $pdo->prepare($sql);
        foreach($cartProducts as $cart) {

            $stmt->bindValue(':id_pedido', $id_pedido);
            $stmt->bindValue(':id_cliente', $customer['id_cliente']);
            $stmt->bindValue(':id_fornecedor', $cart['id_fornecedor']);
            $stmt->bindValue(':product_id', $cart['id']); 
            $stmt->bindValue(':nome', $cart['name']); 
            $stmt->bindValue(':quantity', $cart['quantity']); 
            $stmt->bindValue(':price', $cart['price']);
            $stmt->bindValue(':subtotal', $cart['subtotal']);

            if(!$stmt->execute()) {
                return false;
            }
            
        }

        return true;
    
    }

    /**
     * Retorna todos os pedidos
    */
    function getOrders($pdo) {
        $sql = "SELECT *, (SELECT SUM(oi.subtotal) FROM pedidos_itens oi WHERE oi.id_pedido - o.id ) AS total 
                FROM pedidos o ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

?>

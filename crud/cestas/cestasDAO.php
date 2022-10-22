<?php

include '../../connection/conexao.php';

class cestasDao{
        private  $quantidade, $recebimento, $usuario, $codigoProduto;
        
        public function getQuantidade(){
            return $this->quantidade;
        }
        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }
        
        public function getRecebimento(){
            return $this->recebimento;
        }
        public function setRecebimento($recebimento){
            $this->recebimento = $recebimento;
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function getCodigoProduto(){
            return $this->codigoProduto;
        }
        public function setCodigoProduto($codigoProduto){
            $this->codigoProduto = $codigoProduto;
        }
        

    public function cadastrarCesta(){
        $sql = 'insert into entradaEstoque (quantidade_entradaEstoque, data_entradaEstoque, usuario_entradaEstoque, estoque_entradaEstoque) values (?,?,?,?)';
        $banco = new conexao();
        $con = $banco->getConexao();
        $resultado = $con->prepare($sql);
        $resultado->bindValue(1, $this->quantidade);
        $resultado->bindValue(2, $this->recebimento);
        $resultado->bindValue(3, $this->usuario);
        $resultado->bindValue(4, $this->codigoProduto);
        
        
        
        $final = $resultado->execute();

        if($final){
            echo "<script LANGUAGE= 'JavaScript'>
                window.alert('Cadastrada com sucesso');
                window.location.href='../../pages/cestas/cestas.php'
                </script>";
        }
    }
}

?>
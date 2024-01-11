<?php
require('database/Database.php');
require('models/Produto.php');
require('models/Venda.php');

use database\Database;
use Models\Produto;
use Models\Venda;


//Instanciamos a classe database para servir como base de dados enquanto a aplicação estiver no ciclo
$database = new Database();


//variavel que armazenará nossa opção
$option = 0;




while ($option != 'sair') {

    $option =  readline("Escolha uma opção: (1-Cadastrar um produto) (2-Ver o estoque)  (3-Vender um produto) ('sair)");
    if ($option == 1) {
        $data = [];
        $data['nome'] = readline('Digite o nome do produto:');
        $data['quantidade'] = readline('Digite a quantidade do produto:');
        $data['preço'] = readline('Digite o preço do produto:');

        //Instanciamos a classe modelo Produto para salvar o produto;
        $produto = new Produto();
        //chamo o metodo setProduto que fará a criação do produto
        //passando como parametro uma array associativa e uma instancia da classe Database
        $produto->setProduto($data, $database);
        //e printamos na tela com o metodo getProdutos() que retorna todos atributos do Modelo Produto
        echo ("Produto cadastrado! " . $produto->getProduto());
    } elseif ($option == 2) {
        //Caso option seja 2 chama o metodo que retorna todos produtos cadastrados !
        $database->todosProdutos();

    }elseif($option == 3){
        //intaciamos nosso objeto venda e produto
        $venda = new Venda();
        $produto = new Produto();
        //criamos uma array vazia e armazenamos de forma associativa 
        
        $venda->setNome(readline('Digite o nome do produto:')); 
        $venda->setQuantidade(readline('Digite a quantidade do produto:'));  
        //Convertemos nossa $data array para object 
        // E passamos como parametro para o metodo setVenda
        //E tambem o objeto database

        $venda->setVenda($database);

    }
    else {
        echo ("Não existe essa opção!" . "\n" . "\n" . "\n");
    }
}

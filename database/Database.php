<?php

namespace database;

use Models\Produto;
use Models\Venda;

class Database
{
    //Atributo representacional de uma tabela do Banco de dados
    private array $produtos = [];
    //Atributo representacional de uma tabela do Banco de dados
    private array $vendas = [];

    //metodo responsavel por adicionar o produto a ao atributo produtos
    public function cadastrarProduto(array $data)
    {
        array_push($this->produtos, $data);
    }

    //metodo responsavel por adicionar a venda no atributo de vendas
    public function cadastrarVenda(array $data)
    {
        array_push($this->vendas, $data);
    }


    //metodo responsavel por retornar o atributo produtos
    public function todosProdutos()
    {

        foreach ($this->produtos as $item) {
            echo ("\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n");

            echo ("Nome: " . $item['nome'] . "\n" . "Quantidade: " . $item['quantidade'] . "\n" . "Preço: " . $item['preço'] . "\n");
        }
    }


    //metodo responsavel por pegar o produto do database
    public function procureProduto(string $nome)
    {
       
        $resultado = ['produto'=> null ,'encontrou'=> null];
        
         //intanciamos um produto para receber o resultado da busca no nosso banco de dados representacional
        $produto = new Produto();
        foreach ($this->produtos as $item) {
            if ($item['nome'] == $nome) {
                $resultado['produto'] = $item;
                $resultado['encontrou'] = true;
                break;
            }else{
                $resultado['encontrou'] = false;
            }
        }
        return $resultado;
    }

    //metodo para retornar todos produtos
    public function getProdutos(){
        return $this->produtos;
    }

    //metodo para setar quantidade de um determinad produto
    public function setQuantidade($index,$value){
        
        $index_new =  array_search("quantidade", array_keys($this->produtos[$index]));     

        $this->produtos[$index]['quantidade'] = $value;
        
        echo($this->produtos[$index]['quantidade']);

    }




}

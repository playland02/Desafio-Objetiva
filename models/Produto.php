<?php

namespace Models;

use Database\Database;

class Produto
{
    //Atributos protected para ser compartilhado com sua herança
    protected $nome;
    protected $quantidade;
    protected $preço;

    //Metodo que fará o alimento da classe e cadastro de um produto
    public function setProduto(array $data, Database $database)
    {
        
        //Buscamos as chaves na array associativa $data 
        //E definimos os atributos da classe
        $this->nome = $data['nome'];
        $this->quantidade = $data['quantidade'];
        $this->preço = $data['preço'];

        //Metodo da classe Database que fara o cadastro do produto em um DATABASE
        $database->cadastrarProduto($data);
    }

    public function getProduto(){
        return "Nome: ".$this->nome."\n"."Quantidade: ".$this->quantidade."\n"."Preço: ".$this->preço."\n";
    }

}

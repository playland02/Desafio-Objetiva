<?php

namespace Models;

use Models\Produto;
use database\Database;


class Venda extends Produto
{
    private $desconto;

    public function setVenda(Database $database)
    {
        //o metodo procureProduto retorna uma array ['produto'-> [] , 'encontrou'-> true ou false]
        //se esta cadastrado retorna todos atributos do produto 
        $hasProduto =  $database->procureProduto($this->nome);

        //se o valor de encotrou == true é porque está cadastrado

        if ($hasProduto['encontrou']) {

            //quantidade do estoque for > ou = a quantidade de venda 
            //significa que tem a quantidade pedida no estoque
            if ($hasProduto['produto']['quantidade'] >= $this->quantidade) {


                $produtos = $database->getProdutos();
                foreach ($produtos as $chave => $value) {
                    if ($value['nome'] == $this->nome) {
                        //calcula o valor de quantidades
                        $new_quantidade = $value['quantidade'] - $this->quantidade;
                        //seta quantidade nova ao produto do estoque
                        $database->setQuantidade($chave, $new_quantidade);
                        //valor total 

                        $this->preço = intval($value['preço']) * intval($value['quantidade']);
                        
                        //lançar venda no banco de dados representacional
                        $data = [ ];
                        $data['nome'] = $this->nome;
                        $data['quantidade'] = $this->quantidade;
                        $data['preço'] = $this->preço;

                        $database->cadastrarVenda($data);
                        $this->getVenda();

                    }
                }
            } else {
                echo ("\n" . "Esse produto não tem essa quantidade no stock" . "\n" . "\n");
            }
        } else {
            echo ("\n" . "Esse produto não está cadastrado" . "\n" . "\n");
        }
    }
    //metodo para pegar a venda atual

    public function getVenda()
    {
        return "Nome: " . $this->nome . "\n" . "Quantidade: " . $this->quantidade . "\n" . "Preço: " . $this->preço . "\n";
    }


    //setters 
    public function setNome($value)
    {
        $this->nome = $value;
    }
    public function setQuantidade($value)
    {
        $this->quantidade = $value;
    }
}

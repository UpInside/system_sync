<?php

/**
 * <b>Delete [ DELETE ]</b>
 * Classe responsável por deletar genéricamente no banco de dados!
 *
 * @copyright (c) 2018, UPINSIDE TREINAMENTOS
 */

namespace CRUD;

USE \PDOException;
USE \PDO;

class Delete
{

    private $table;
    private $terms;
    private $places;
    private $result;

    /** @var PDOStatement */

    private $delete;

    /** @var PDO */

    private $conn;

    /**
     * Obtém conexão do banco de dados Singleton
     */

    public function __construct()
    {
        $this->conn = Conn::getConn();
    }

    /**
     * <b>delete:</b> Executa o comando DELETE no banco de dados utilizando a parseString para segurança
     *
     * @param string $table = Informe o nome da tabela no banco
     * @param string $terms = Informe o termo do delete (WHERE)
     * @param string $parseString = Parse String no formato link={$link}&link2={$link2}
     * @return void
     */

    public function delete($table, $terms, $parseString)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;

        parse_str($parseString, $this->places);
        $this->getSyntax();
        $this->execute();
    }

    /**
     * <b>getResult:</b> Retorna o true/false de acordo com o resultado da ação!
     *
     * @return boolean Retorna true se o delete for feito com sucesso, ou false no caso de erro
     */

    public function getResult()
    {
        return $this->result;
    }

    /**
     * <b>getRowCount:</b> Retorna a quantidade de linhas afetadas
     *
     * @return integer Quantidade de registros que foram deletados
     */

    public function getRowCount()
    {
        return $this->delete->rowCount();
    }

    public function setPlaces($parseString)
    {
        parse_str($parseString, $this->places);
        $this->getSyntax();
        $this->execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */

    /**
     * Obtém o PDO e Prepara a query
     */

    private function connect()
    {
        $this->delete = $this->conn->prepare($this->delete);
    }

    /**
     * Cria a sintaxe da query para Prepared Statements
     */

    private function getSyntax()
    {
        $this->delete = "DELETE FROM {$this->table} {$this->terms}";
    }

    /**
     * Obtém a Conexão e a Syntax, executa a query!
     */

    private function execute()
    {
        $this->connect();

        try {
            $this->delete->execute($this->places);
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = null;
            echo "<b>Erro ao Deletar:</b> {$e->getMessage()} {$e->getCode()}";
        }
    }

}

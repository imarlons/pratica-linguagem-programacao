<?php
/*
  classe de conexão (singleton)
  garante que haverá apenas uma instância da conexão pdo para toda a aplicação.
*/

namespace App\Core;

// classe final, não pode ser estendida
final class Conexao
{
    private static $pdo;

    // construtor privado previne a instânciação
    private function __construct() {}

    // método estático para obter a conexão
    public static function getConexao(): \PDO
    {
        // se a instância PDO ainda não foi criada
        if (!isset(self::$pdo)) {
            // credenciais do banco
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "cadastro_produtos";
            $porta = 3307;

            try {
                // dns (data source name)
                $dsn = "mysql:host=$servidor;port=$porta;dbname=$banco;charset=utf8";

                // cria a instância do pdo
                self::$pdo = new \PDO($dsn, $usuario, $senha);

                // configura o pdo para lançar exceções em caso de erro
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // captura e exibe o erro (em produção, isso deve ser logado)
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        // retorna a instância pdo existente
        return self::$pdo;
    }
}

<?php

//include_once 'DbSGTES.class.php';

abstract class ConexaoPOLO extends DbPOLO {

    public static $pdo;
    private $smtpQueryDql;

    function __construct() {
        
    }

    private function abreConexaoPdo() {
        try {
            if (self::$pdo == null) {
                $dsn = strtolower($this->GetTipoBanco()) . ":dbname=" . $this->GetDb();

                try {
                    self::$pdo = new PDO($dsn, $this->GetUsuario(), $this->GetSenhaBanco());
                    self::$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
                } catch (PDOException $e) {
                    throw new PDOException("Erro ao abrir conexão (PDO): " . $e->getMessage());
                    // return false;
                }
            }
        } catch (PDOException $e) {
            // throw new PDOException( "Erro ao abrir conexão (PDO): " . $e->getMessage() );
            return false;
        }

        return self::$pdo;
    }

    /**
     * Execução de querys de consulta SELECT
     * @param $sql
     * @param $param
     */
    protected function queryDql($sql, $param = "") {
        $this->abreConexaoPdo();

        try {
            // Abre conexão
            self::$pdo->exec("ALTER SESSION SET NLS_DATE_LANGUAGE = 'BRAZILIAN PORTUGUESE'");
            self::$pdo->exec("ALTER SESSION SET NLS_DATE_FORMAT = 'dd/mm/YYYY'");
            self::$pdo->exec("ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '.,'");

            // Prepare statement da instrução sql
            $stmt = self::$pdo->prepare($sql);

            // Setando os parâmetros do sql preparado, de forma dinâmica
            if ($param) {
                foreach ($param as $bind) {
                    if ($bind[1] != "") {
                        $stmt->bindParam($bind[0], $bind[1]);
                    } else {
                        $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                    }
                }
            }

            // Execução da instrução prepare
            if ($stmt->execute()) {
                // ResultSet
                // self::$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
                $rs = $stmt->fetchAll();
            } else {
                $arrErro = $stmt->errorInfo();
                throw new PDOException("Operação não realizada: " . $arrErro[2]);
            }
        } catch (PDOException $e) {
            // Limpeza do statement
            $stmt = null;
            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }

        // Limpeza do statement
        $stmt = null;

        // Retorno
        return $rs;
    }

    /**
     * Execução de querys de consulta SELECT para retorno BLOB (file)
     * @param $sql
     * @param $param
     *
     * Utilização:
     *
     * $file = $conexaoSGTES->queryDqlFile();
     *
     * header("Content-Type: application/pdf");
     * header("Content-Disposition:attachment;filename=downloaded.pdf");
     *
     * fpassthru($file);
     */
    protected function queryDqlFile($sql, $param) {
        $this->abreConexaoPdo();

        try {
            // Abre conexão
            self::$pdo->exec("ALTER SESSION SET NLS_DATE_LANGUAGE = 'BRAZILIAN PORTUGUESE'");
            self::$pdo->exec("ALTER SESSION SET NLS_DATE_FORMAT = 'dd/mm/YYYY'");
            self::$pdo->exec("ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '.,'");
            self::$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);

            // Prepare statement da instrução sql
            $stmt = self::$pdo->prepare($sql);
            // Setando os parâmetros do sql preparado, de forma dinâmica
            if ($param) {
                foreach ($param as $bind) {
                    if ($bind[1] != "") {
                        $stmt->bindParam($bind[0], $bind[1]);
                    } else {
                        $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                    }
                }
            }

            // Execução da instrução prepare
            if ($stmt->execute()) {
                // ResultSet
                #$stmt->bindColumn( 1 , $file , PDO::PARAM_LOB );
                #$stmt->fetch( PDO::FETCH_BOUND );
                #return $file;

                $rs = $stmt->fetchAll();

                return $rs;
            } else {
                $arrErro = $stmt->errorInfo();
                throw new PDOException("Operação não realizada: " . $arrErro[2]);
            }
        } catch (PDOException $e) {
            // Limpeza do statement
            $stmt = null;
            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }

        // Limpeza do statement
        $stmt = null;

        // Retorno
        return $rs;
    }

    /**
     * Execução de querys de controle INSERT, UPDATE e DELETE
     * @param $sql
     * @param $param
     * @param $executeArray
     */
    protected function queryDml($sql, $param = "") {
        try {
            // Abre conexão
            $this->abreConexaoPdo();

            /**
             * Setando a role de acesso
             */
            try {
                self::$pdo->exec($this->GetRole());
                self::$pdo->exec("ALTER SESSION SET NLS_DATE_LANGUAGE = 'BRAZILIAN PORTUGUESE'");
                self::$pdo->exec("ALTER SESSION SET NLS_DATE_FORMAT = 'dd/mm/YYYY'");
                self::$pdo->exec("ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '.,'");
            } catch (PDOException $e) {
                echo "Erro ao configurar a sessão: " . $e->getMessage();
                $this->closeConnection();
            }

            // Prepare statement da instrução sql
            $stmt = self::$pdo->prepare($sql);

            if (is_array($param[0][0])) {
                if ($param) {
                    if (self::$pdo->beginTransaction()) {
                        foreach ($param as $bindArray) {
                            foreach ($bindArray as $bind) {
                                if ($bind[1] != "") {
                                    if (isset($bind[2]) && ( $bind[2] == true )) {
                                        $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_STR, strlen($bind[1]));
                                    } elseif (isset($bind[3]) && ( $bind[3] == true )) {
                                        $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_LOB);
                                    } else {
                                        $stmt->bindParam($bind[0], $bind[1]);
                                    }
                                } else {
                                    $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                                }
                            }

                            if ($stmt->execute()) {
                                
                            } else {
                                $arrErro = $stmt->errorInfo();
                                throw new PDOException("Operação não realizada: " . $arrErro[2]);
                            }
                        }
                    }
                }

                self::$pdo->commit();
                $rs = $stmt->fetchAll();
            } else {
                // Setando os parâmetros do sql preparado, de forma dinâmica
                if ($param) {
                    foreach ($param as $bind) {
                        if ($bind[1] != "") {
                            if (isset($bind[2]) && ( $bind[2] == true )) {
                                $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_STR, strlen($bind[1]));
                            } elseif (isset($bind[3]) && ( $bind[3] == true )) {
                                $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_LOB);
                            } else {
                                $stmt->bindParam($bind[0], $bind[1]);
                            }
                        } else {
                            $stmt->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                        }
                    }
                }

                if (self::$pdo->beginTransaction()) {
                    if ($stmt->execute()) {
                        //ResultSet
                        self::$pdo->commit();
                        $rs = $stmt->fetchAll();
                    } else {
                        $arrErro = $stmt->errorInfo();
                        throw new PDOException("Operação não realizada: " . $arrErro[2]);
                    }
                }
            }

            // Execução da instrução prepare
        } catch (PDOException $e) {
            // Limpeza do statement
            $stmt = null;
            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }

        // Limpeza do statement
        $stmt = null;

        // Retorno
        return $rs;
    }

    public function queryPrepareDql($sql) {
        try {
            // Abre conexão
            $this->abreConexaoPdo();
            // Prepare statement da instrução sql
            $this->smtpQueryDql = self::$pdo->prepare($sql);

            // Setando os parâmetros do sql preparado, de forma dinâmica
        } catch (PDOException $e) {
            // Limpeza do statement
            $this->$smtpQueryDql = null;
            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }
    }

    public function queryPrepareDml($sql) {
        try {

            // Abre conexão
            $this->abreConexaoPdo();

            self::$pdo->exec($this->GetRole());

            // Prepare statement da instrução sql
            $this->smtpQueryDml = self::$pdo->prepare($sql);

            // Setando os parâmetros do sql preparado, de forma dinâmica
        } catch (PDOException $e) {
            // Limpeza do statement
            $this->$smtpQueryDql = null;
            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }
    }

    public function queryExecutaDql($arrParam = "") {
        try {
            if ($arrParam) {
                foreach ($arrParam as $bind) {
                    if ($bind[1] != "") {
                        $this->smtpQueryDql->bindParam($bind[0], $bind[1]);
                    } else {
                        $this->smtpQueryDql->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                    }
                }
            }

            // Execução da instrução prepare
            if ($this->smtpQueryDql->execute()) {
                // ResultSet
                $rs = $this->smtpQueryDql->fetchAll();
            } else {
                $arrErro = $this->smtpQueryDql->errorInfo();
                throw new PDOException("Operação não realizada: " . $arrErro[2]);
            }
        } catch (PDOException $e) {
            // Limpeza do statement
            $this->smtpQueryDql = null;

            // Fecha conexão
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }
        // Retorno
        return $rs;
    }

    public function queryExecutaDml($arrParam = "") {
        try {
            if ($arrParam) {
                foreach ($arrParam as $bind) {
                    if ($bind[1] != "") {
                        $this->smtpQueryDml->bindParam($bind[0], $bind[1]);
                    } else {
                        $this->smtpQueryDml->bindParam($bind[0], $bind[1], PDO::PARAM_NULL);
                    }
                }
            }

            // Execução da instrução prepare
            if (!$this->smtpQueryDml->execute()) {
                $arrErro = $this->smtpQueryDml->errorInfo();
                throw new PDOException("Operação não realizada: " . $arrErro[2]);
            }
        } catch (PDOException $e) {
            // Limpeza do statement
            $this->smtpQueryDql = null;

            // Fecha conex�o
            $this->closeConnection();

            // Erro
            throw new Exception("Erro na execução da instrução SQL: " . $e->getMessage());
        }

        // Retorno
    }

    public function queryFreeDql() {
        //Limpeza do statement
        $this->smtpQueryDql = null;
        $this->smtpQueryDml = null;
    }

    public function closeConnection() {
        if (self::$pdo) {
            self::$pdo = null;
        }
    }

    public function __destruct() {
        if (self::$pdo) {
            self::$pdo = null;
        }
    }

    public function statusConnection() {

        if ($this->abreConexaoPdo() != false) {
            $st = true;
            //$this->closeConnection();
        } else {
            $st = false;
        }

        return $st;
    }

}

?>
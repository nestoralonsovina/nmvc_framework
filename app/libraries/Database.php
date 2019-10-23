<?php
/*
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */

/**
 * In charge of connecting to the database.
 * It should be extended by the models,
 * shouldn't be used without them.
 * Params in /app/config/config.php
 * Class Database
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    /**
     * Sets the connection to the database
     * Database constructor.
     */
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepares the sql statement
     * @param $sql string query to execute
     */
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Binds the :param to it's value set before in the query method
     * @param $param string :key
     * @param $value string value
     * @param null $type type of the value, if not set it'll automatically be set
     */
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared statement
     * @return boolean true if success false if not
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * Returns all the solutions found as an array of objects
     * @return mixed returns all the objects found with the query
     */
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Returns a single row
     * @return mixed
     */
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * returns the row count
     * @return mixed
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}
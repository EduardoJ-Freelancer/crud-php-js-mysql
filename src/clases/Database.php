<?php require_once '../config/database.php';

class Database
{
	protected $hostname = DB_HOST;
	protected $username = DB_USER;
	protected $password = DB_PASSWORD;
	protected $dbname = DB_NAME;
	protected $charset = DB_CHARSET;
	protected $pdo;
	/**
	 * Default constructor
	 *
	 * Triggers the connect function by default
	 */
	public function __construct() 
	{
		$this->connect();
	}
	/**
	 * @return Connection using the pdo extension
	 */
  	public function connect(){
		try {
		    $this->pdo = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->dbname . ";charset=" . $this->charset, $this->username, $this->password);
		    /**
		     * Set the PDO error mode to exception
		     */
		    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
		    die("ERROR: Could not connect. " . $e->getMessage());
		}
		return $this->pdo;
	}

	/**
	 * Default destructor
	 *
	 * Closes the DB connection
	 */
	public function __destruct()
	{
		unset($this->pdo);
	}
}
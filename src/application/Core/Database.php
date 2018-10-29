<?

namespace App\Core;
use PDO;

class Database
{
	private static $_instance;

	public function __construct ()
	{
		try {
		self::$_instance = new PDO(
			'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
	    	DB_USER,
	    	DB_PASS,
	    	[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
		);

	    //var_dump(self::$_instance);
		//echo 'Connection was successful  ';

	    } catch (PDOException $e) {
		      echo 'Connection failed: ' . $e->getMessage();
	    }
	}

	public static function getInstance()
	{
		if (self::$_instance != null) {
			return self::$_instance;
		}
		return new self;
	}

	public static function insert($table, $data)
	{
		$columns = [];
		$values = [];

		foreach($data as $key => $value) {
			$columns[] = "`$key`";
			$values[] = self::$_instance->quote($value);
		}

		$columns = implode(',', $columns);
		$values = implode(',', $values);

		$sql = "INSERT INTO `$table` ($columns) VALUES ($values);";

		$statement = self::$_instance->prepare($sql);

		$res = $statement->execute($data);

		return ($res) ? true : false;
	}

	public static function select($table, $data, $where = null, $order = null)
	{

		if (!$data) {
			$sql = "SELECT COUNT(*) FROM `$table`"; // if email exists TODO check email $sql = "SELECT COUNT(*) FROM participant WHERE email = '$email'";

		} elseif ($data == "*") {  //  if user exists $sql = "SELECT * FROM participant WHERE email = '$email'";
			$sql = "SELECT * FROM `$table`";
		} else {
			$values = implode(',', $data);
			$sql = "SELECT $values FROM `$table`";
	   }

		if ($where) $sql .= ' WHERE '.$where; //TODO where
		if ($order) $sql .= ' ORDER BY '.$order;

		//var_dump($sql);

		$res = [];
		$statement = self::$_instance->prepare($sql);
		$statement->execute($data);
		$res = $statement->fetchAll(PDO::FETCH_ASSOC);

		return ($res) ? $res : false;
	}


	public static function update($table, $data, $where) //TODO IF EXISTS
	{
		$columns = [];
		$values = [];

		foreach($data as $key => $value) {
			$columns[] = $key . '='. self::$_instance->quote($value);
		}

		$columns = implode(', ', $columns);

		var_dump($columns);

		$sql = "UPDATE `$table` SET $columns WHERE $where";
		var_dump($sql);
		$statement = self::$_instance->prepare($sql);
		$res = $statement->execute($data);

		return ($res) ? true : false;
	}

	public static function delete($table, $where = null) //TODO IF EXISTS && `participant`.`id` = 1
	{
		if ($where == null) {
            $sql = "DELETE `$table`";
		} else {
			$sql = "DELETE FROM `$table` WHERE `$where`";
		}

		var_dump($sql);
		$statement = self::$_instance->prepare($sql);
		$res = $statement->execute($data);

	    return ($res) ? true : false;
	}


	public static function closeConnection()
	{
		if (self::$_instance) {
			self::$_instance = null;
			return true;
		} else {
			return false;
		}
	}
}


<?
class Db {
  private $connection;
  private static $db;

  public static function getInstance($option =null){
    if(self:: $db == null){
      self::$db= new Db($option);
    }
    return self::$db;
  }

  private function __construct($option = null) {
    if ($option != null) {
      $host = $option['host'];
      $user = $option['user'];
      $pass = $option['pass'];
      $name = $option['name'];
    } else {
      global $config;
      $host = $config['db']['host'];
      $user = $config['db']['user'];
      $pass = $config['db']['pass'];
      $name = $config['db']['name'];
    }
    $this->connection= new mysqli($host,$user,$pass,$name);
    if ($this->connection->connect_error){
      echo "connectione faild:".$this->connection->connect_error;
      exit;
    }
    $this->connection->query("SET NAMES 'UTF8'");
  }
  public function first($sql){
    $records=$this->query($sql);
    if ( $records == 0){
      return null;
    }
    return $records[0];
  }
  public function modify($sql){
    $result = $this->connection->query($sql);
    if (!$result) {
      echo "QUERY : " . $sql . "Failed due to " . mysql_error($this->connection);
    }
    return $result;
  }
  public function insert($sql){
    $result = $this->connection->query($sql);
    if (!$result) {
      echo "QUERY : " . $sql . "Failed due to " . mysql_error($this->connection);
    }
    return $result;
  }
  public function query($sql){
    $result = $this->connection->query($sql);
    if (!$result) {
      echo "QUERY : " . $sql . "Failed due to " . mysql_error($this->connection);
    }
    $records = array();

    if ($result->num_rows == 0){
      return null;
    }
    while($row = $result->fetch_assoc()){
      $records[] = $row;
    }
    return $records;
  }
  public function connection(){
    return $this->connection;
  }
  public function close(){
    $this->connection->close();
  }

}
<?php
/**
* Categoria class.
* Class to manage categorias.
**/
class Categoria
{
  const TABLE = 'categoria';
  private $con;
  public $datos; //array with object data
  private $id,$cate_nomb;
  function __construct($id = null)
  {
    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();
  }
  /* set methods */
  public function setId($id){
    $id = $this->con->real_escape_string($id);
    $table = $this->con->real_escape_string(self::TABLE);
    $sql = "SELECT * FROM $table WHERE cate_id = '$id'";
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['cate_id'];
      $this->cate_nomb = $this->datos['cate_nomb'];
      return true;
    }
    return false;
  }
  public function setNombre($value){
    $this->cate_nomb = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT cate_id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['cate_id']);
      }
      return $toreturn;
    }
    else{
      return false;
    }
  }
  public function getId(){
    return $this->id;
  }
  public function getNombre(){
    return $this->cate_nomb;
  }

  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $cate_nomb = $this->con->real_escape_string($this->cate_nomb);
    $sql =  "INSERT INTO $table
            (  cate_nomb)
    VALUES  ('$cate_nomb')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $cate_nomb = $this->con->real_escape_string($this->cate_nomb);
    $sql = "UPDATE $table SET
    cate_nomb = '$cate_nomb'
    WHERE cate_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE cate_id = '$id'";
    return $this->con->query($sql);
  }
}
?>

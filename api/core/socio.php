<?php
/**
* Socio class.
* Class to manage users.
**/
class Socio
{
  const TABLE = 'socio';
  private $con;
  public $datos; //array with object data
  private $id,$pers_id,$socio_stad,$socio_user,$socio_clave,$grup_id,$cate_id,$is_admin;
  function __construct($id = null)
  {
    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();//al destruir el usuario cierra la conexión con la db.
  }
  /* set methods */
  public function setId($id){
    $table = $this->con->real_escape_string(self::TABLE);
    if(is_int($id) || is_numeric($id)){//search by id
      $id = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE socio_id = '$id'";
    }
    else{//search by user
      $username = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE socio_user = '$username'";
    }
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['socio_id'];
      $this->pers_id = $this->datos['pers_id'];
      $this->socio_stad = $this->datos['socio_stad'];
      $this->socio_user = $this->datos['socio_user'];
      $this->socio_clave = $this->datos['socio_clave'];
      $this->grup_id = $this->datos['grup_id'];
      $this->cate_id = $this->datos['cate_id'];
      $this->is_admin = $this->datos['is_admin'];
      return true;
    }
    return false;
  }
  public function setPersId($value){
    $this->pers_id = $value;
  }
  public function setStad($value){
    $this->socio_stad = $value;
  }
  public function setUser($value){
    $this->socio_user = $value;
  }
  public function setClave($value){
    $this->socio_clave = md5($value);
  }
  public function setGrupId($value){
    $this->grup_id = $value;
  }
  public function setCateId($value){
    $this->cate_id = $value;
  }
  public function setAdmin($value){
    $this->is_admin = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['socio_id']);
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
  public function getPersId(){
    return $this->pers_id;
  }
  public function getStad(){
    return $this->socio_stad;
  }
  public function getUser(){
    return $this->socio_user;
  }
  public function getClave(){
    return $this->socio_clave;
  }
  public function getGrupId(){
    return $this->grup_id;
  }
  public function getCateId(){
    return $this->cate_id;
  }
  public function getAdmin(){
    return $this->is_admin;
  }
  /* db actions methods */
  public function getlastId(){
    return $this->con->insert_id;
  }
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $pers_id = $this->con->real_escape_string($this->pers_id);
    $socio_stad = $this->con->real_escape_string($this->socio_stad);
    $socio_user = $this->con->real_escape_string($this->socio_user);
    $socio_clave = $this->con->real_escape_string($this->socio_clave);
    $grup_id = $this->con->real_escape_string($this->grup_id);
    $cate_id = $this->con->real_escape_string($this->cate_id);
    $is_admin = $this->con->real_escape_string($this->is_admin);
    $sql =  "INSERT INTO $table
    (  pers_id,   socio_stad,   socio_user,   socio_clave,   grup_id,   cate_id,   is_admin)
    VALUES  ('$pers_id','$socio_stad','$socio_user','$socio_clave','$grup_id','$cate_id','$is_admin')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $pers_id = $this->con->real_escape_string($this->pers_id);
    $socio_stad = $this->con->real_escape_string($this->socio_stad);
    $socio_user = $this->con->real_escape_string($this->socio_user);
    $socio_clave = $this->con->real_escape_string($this->socio_clave);
    $grup_id = $this->con->real_escape_string($this->grup_id);
    $cate_id = $this->con->real_escape_string($this->cate_id);
    $is_admin = $this->con->real_escape_string($this->is_admin);
    $sql = "UPDATE $table SET
    pers_id = '$pers_id',
    socio_stad = '$socio_stad',
    socio_user    = '$socio_user',
    socio_clave     = '$socio_clave',
    grup_id = '$grup_id',
    cate_id    = '$cate_id',
    is_admin    = '$is_admin'
    WHERE socio_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE socio_id = '$id'";
    return $this->con->query($sql);
  }
}
?>

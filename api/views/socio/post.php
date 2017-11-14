<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$admin = new Socio((string)$username);

if(isset($params['pers_id']) && isset($params['socio_stad']) &&
isset($params['socio_user']) && isset($params['socio_clave']) && isset($params['grup_id']) &&
isset($params['cate_id']) && isset($params['is_admin'])){

  if(isset($password) && isset($username) && $admin->getAdmin() == "1" && $password == $admin->getPassword()){
    //Puede crear el usuario
    $user = new Socio();
    $user->setPersId($params['pers_id']);
    $user->setStad($params['socio_stad']);
    $user->setUser($params['socio_user']);
    $user->setClave($params['socio_clave']);
    $user->setGrupId($params['grup_id']);
    $user->setCateId($params['cate_id']);
    $user->setAdmin($params['is_admin']);
    if($user->dbInsert()){
      $result = array('status' => true, 'result' => LANG_USER_INSERTED_OK);
    }
    else{
      $result = array('status' => false, 'result' => LANG_USER_INSERTED_NO);
    }
    $response->write(json_encode($result));//devuelve true o false
    return $response;
  }
  else{
    $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
    $response->write(json_encode($result));
    return $response;
  }
}
else{
  //faltan campos
  $result = array('status' => false, 'result' => LANG_NO_FIELDS);
  $response->write(json_encode($result));
  return $response;
}
?>

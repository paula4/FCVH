<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$user_id= (int)$request->getAttribute('id');
$user = new Socio($user_id);
$admin = new Socio($username);


if(isset($username) && isset($password) && ($admin->getAdmin() == "1" || $admin->getUser() == $user->getUser()) && $admin->getClave() == $password){
  if(isset($params['pers_id'])) $user->setPersId($params['pers_id']);
  if(isset($params['socio_stad'])) $user->setStad($params['socio_stad']);
  if(isset($params['socio_user'])) $user->setUser($params['socio_user']);
  if(isset($params['socio_clave'])) $user->setClave($params['socio_clave']);
  if(isset($params['grup_id'])) $user->setGrupId($params['grup_id']);
  if(isset($params['cate_id'])) $user->setCateId($params['cate_id']);

  if(isset($params['is_admin']) && $admin->getAdmin() == "1") $user->setAdmin($params['is_admin']);
  if($user->getId() != null){
    if($user->dbUpdate()){
      $result = array('status' => true, 'result' => LANG_UPDATE_OK);
    }
    else{
      $result = array('status' => false, 'result' => LANG_UPDATE_NO);
    }
  }
  else{
    $result = array('status' => false, 'result' => LANG_USER_NO_EXIST);
  }
  $response->write(json_encode($result));
  return $response;
}
else{
  $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
  $response->write(json_encode($result));
  return $response;
}
?>

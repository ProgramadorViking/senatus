<?php

  use \Firebase\JWT\JWT;

  class UserController extends Controlador {

    public function __construct() {
      parent::__construct();
    }

    public static function index() {
      $db = new User();
      $user = $db->getAll();
      echo json_encode($user);
    }

    //Guardar usuario
    public static function save($request) {
      $db = new User();
      $db->setName($request->name);
      $db->setPassword($request->password);
      $db->setWorkerId($request->worker_id);
      $db->setDate($request->date);
      $db->setActive($request->active);
      $db->setRoleId($request->role_id);
      $result = $db->save();
      if ($result) {
        echo json_encode("yes");
      } else {
        echo json_encode($db->errorInfo());
      }
    }

    //login usuario
    public static function login($request) {
      $db = new User();
      $user = self::result($db->findBy('worker_id',$request->worker_id));
      $nwt = bin2hex(openssl_random_pseudo_bytes(256));
      $user['token'] = $nwt;
      if(password_verify($request->password, $user['password'])) {
        $db->setToken($nwt);
        $db->login($user['id']);
        $user['password']='';
        $token = self::createToken($user);
        $result = "{'token': '".$token."'}";
        echo json_encode($result);
      } else {
        echo json_encode("Not correct password");
      }
    }

    //Funciones agregadas
    private static function result($arr) {
      return $arr[0];
    }

    private static function createToken($user) {
      $time = time();
      $key = 'appaloosa';

      $token = array(
        'iat' => $time,
        'exp' => $time + (60*60), // 1 hora de vida
        //'aud' => NULL
        'data' => $user
      );

      $code = JWT::encode($token, $key, 'HS256');
      return $code;
    }

  }
?>

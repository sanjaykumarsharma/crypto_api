<?php

namespace App\Controllers;
use \Firebase\JWT\JWT;

class LoginService extends Controller
{

    public function login($request, $response){

      try{
		    $d = json_decode($request->getBody());
        
        $query = "select user_id, username from users
                  where username = :username and password = md5(:password)";
         $statement = $this->db->prepare($query);
         $statement->bindParam(':username', $d->username);
         $statement->bindParam(':password', $d->password);
         $statement->setFetchMode($this->db::FETCH_ASSOC);
         $statement->execute();
         if($des = $statement->fetch()){
            $key = "example_key";
            $token = array(
                "iss" => "http://createcareers.org",
                "aud" => "http://createcareers.org",
                "iat" => 1356999524,
                "nbf" => 1357000000
            );
            $jwt = JWT::encode($token, $key);
            //$decoded = JWT::decode($jwt, $key, array('HS256'));

            $data = array();
            $data['status'] = "s";
            $data['username'] = $des['username'];
            $data['token'] = $jwt;
         }else {
           $data = array();
           $data['status'] = "s";
           $data['error'] = 'FAIL';
           $data['data'] = $d;
         }
         return json_encode($data);
      }catch(PDOException $e){
         $objPDO = null;
         $error['error'] = $e->getMessage();
         return json_encode($error);
      }
   
    }
}

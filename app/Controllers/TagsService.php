<?php

namespace App\Controllers;
use \Firebase\JWT\JWT;

class TagsService extends Controller
{

    public function getTags($request, $response){

      try{
        
        $query = "select id, tag from tags";
         $statement = $this->db->prepare($query);
         $statement->setFetchMode($this->db::FETCH_ASSOC);
         $statement->execute();
         
         return json_encode($statement->fetchAll());
      }catch(PDOException $e){
         $objPDO = null;
         $error['error'] = $e->getMessage();
         return json_encode($error);
      }
   
    }


    public function createTag($request, $response){

      try{
        
        $d = json_decode($request->getBody());

        $query = "insert into tags(id, tag) values(:id,:tag)";
        $statement = $this->db->prepare($query);
        $statement->setFetchMode($this->db::FETCH_ASSOC);
        $statement->bindParam(':id', $d->id);
        $statement->bindParam(':tag', $d->tag);
        $statement->execute();
         
        return json_encode($d);
      }catch(PDOException $e){
         $objPDO = null;
         $error['error'] = $e->getMessage();
         return json_encode($error);
      }
   
    }

    public function updateTag($request, $response){

      try{
        
        $d = json_decode($request->getBody());

        $query = "update tags
                  set tag=:tag
                  where id=:id";
        $statement = $this->db->prepare($query);
        $statement->setFetchMode($this->db::FETCH_ASSOC);
        $statement->bindParam(':id', $d->id);
        $statement->bindParam(':tag', $d->tag);
        $statement->execute();
         
        return json_encode($d);
      }catch(PDOException $e){
         $objPDO = null;
         $error['error'] = $e->getMessage();
         return json_encode($error);
      }
   
    }


    public function deleteTag($request, $response, $args){

      try{
        
        $query = "delete from tags
                  where id=:id";
        $statement = $this->db->prepare($query);
        $statement->setFetchMode($this->db::FETCH_ASSOC);
        $statement->bindParam(':id', $args['id']);
        $statement->execute();
         
        return $args['id'];
      }catch(PDOException $e){
         $objPDO = null;
         $error['error'] = $e->getMessage();
         return json_encode($error);
      }
   
    }


}

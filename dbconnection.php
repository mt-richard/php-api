<?php

require_once('dbconfig.php');
class dbconnection {
    protected $db;
    public function __construct(){
        $this->db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER,DB_PWD,[PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    function save($table, $data){
        try {
            $query = "INSERT INTO ".$table."(";
            $i =0;
            $ph ="";
            $values =[];
            foreach($data as $field => $value){
                $query .= $i==0? $field:",".$field;
                $ph .= $i==0? "?": ",?";
                array_push($values, $value);
                $i++;
            }
            $query .= ")values(".$ph.")";
            $stm = $this->db->prepare($query);
            $stm->execute($values);
            return intval($this->db->lastInsertId());

        } catch (Exception $th) {
            return $th->getMessage();
        }
       
    }
    
    function getAll($table){
        try {
            $stm = $this->db->prepare("SELECT * FROM ".$table);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            return $stm->fetchAll();
        } catch (Exception $th) {
            return $th.getMessage();
        }
    }

    // function destroy($table, $id){
    //     try {
    //         $stm = $this->db->prepare("DELETE FROM ".$table."WHERE id=".$id);
    //         $stm->execute($id);

    //         // return $stm->fetchAll();
    //     } catch (Exception $th) {
    //         return $th.getMessage();
    //     }
    // }
        
}


?>
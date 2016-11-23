<?php
include_once './PDOConnect.php';
class NavigationManager {
    private $pdoConnect;
    
    public function __construct() {
        $this->pdoConnect = new PDOConnect();
    }
    
    private function getTopicIdByName($topicName) {
        
        $result = 0;
        
        try {
            $dbh = $this->pdoConnect->Connect();
            
            $sql = "SELECT * FROM `topics` WHERE `Topic_name` LIKE :topicName";                 
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $stmt->execute(array(':topicName' => $topicName));
                    $row = $stmt->fetch();
                    $result = $row['id'];   
                    
        } catch (Exception $ex) {
            echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors
        }
        return $result;
    }
    
    private function getTopicNameById($topicId) {
        
        $result = "";
        
        try {
            $dbh = $this->pdoConnect->Connect();
            
            $sql = "SELECT * FROM `topics` WHERE `id` = :id";                 
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $stmt->execute(array(':id' => $topicId));
                    $row = $stmt->fetch();
                    $result = $row['Topic_name'];   
                     
        } catch (Exception $ex) {
            echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors
        }
        return $result;
    }
    
    public function addTopic($topicName,$ancestorsTopicName) {
        
        
         try {   
                $dbh = $this->pdoConnect->Connect(); // get connection to DataBase
                                    
                    $sql = "INSERT INTO `topics` (`id`, `Topic_name`) VALUES (NULL, :topicName);";
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
                    $stmt->execute(array(':topicName' => $topicName));   // adding parametrs to query and execute
                     
                    $newId = $this->getTopicIdByName($topicName);
                    $ancestorId = $this->getTopicIdByName($ancestorsTopicName);
                    
                    $sql = "INSERT INTO `topics_to_topics` (`id`, `id_ancestor_topic`, `id_descendant_topic`)"
                            . " VALUES (NULL, :id_ancestor_topic, :id_descendant_topic);";
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
                    $stmt->execute(array(':id_ancestor_topic' => $ancestorId,':id_descendant_topic'=> $newId));   // adding parametrs to query and execute

                     
            } catch (PDOException $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors

            }
        
    }
    
    public function deleteTopicByName($topicName) {
         try {   
                $dbh = $this->pdoConnect->Connect(); // get connection to DataBase
                       
                    $id = $this->getTopicIdByName($topicName);
                
                    $sql = "DELETE FROM `topics` WHERE `id` = :id;";
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
                    $stmt->execute(array(':id' => $id));
                     
                    $sql = "DELETE FROM `topics_to_topics` WHERE `id_descendant_topic` = :id_descendant_topic;";
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
                    $stmt->execute(array(':id_descendant_topic' => $id));
                                         
            } catch (PDOException $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors

            }
    }
    
    public function deleteTopicById($param) {
        
        try {   
            $dbh = $this->pdoConnect->Connect(); // get connection to DataBase

            $sql = "DELETE FROM `topics` WHERE `id` = :id;";
            $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
            $stmt->execute(array(':id' => $id));

            $sql = "DELETE FROM `topics_to_topics` WHERE `id_descendant_topic` = :id_descendant_topic;";
            $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
            $stmt->execute(array(':id_descendant_topic' => $id));
                                         
            } catch (PDOException $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors

        }
        
    }
    
    public function moveTopic($topicId,$newAncestorsTopicId) {
        
         try {   
                $dbh = $this->pdoConnect->Connect(); // get connection to DataBase
                                                                             
                    $sql = "UPDATE `topics_to_topics` SET `id_ancestor_topic` = :newAncestorsTopicId"
                            . " WHERE `id_descendant_topic` = :id_descendant_topic";
                    $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));  
                    $stmt->execute(array(':newAncestorsTopicId' => $newAncestorsTopicId,''
                        . ':id_descendant_topic'=> $topicId));   // adding parametrs to query and execute

                     
            } catch (PDOException $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors

            }
        
    }
    
    private function getDescendants($id) {
        
        $resultArr = array();
        
        try {
            $dbh =$this->pdoConnect->Connect();
            $sql = "SELECT * FROM `topics_to_topics` WHERE"        // Creating parametrized query
                         . " `id_ancestor_topic` = :id_ancestor";
                 
                $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $stmt->execute(array(':id_ancestor' => $id));  // adding parametrs to query and execute

            while ($row = $stmt->fetch()) {  
                    array_push($resultArr, $row['id_descendant_topic']);
                }
        } catch (Exception $ex) {
             echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors
        }        
        return $resultArr;         
    }
    
    private function recursiveNavViewBuilder($Arr) {
        
        echo '<ul>';
        for ($index = 0; $index < count($Arr); $index++) {
            
            try {
                 $dbh =$this->pdoConnect->Connect(); // get connection to DataBase
            
                 $sql = "SELECT * FROM `topics` WHERE `id` = :id_topic";                 
                 $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                 $stmt->execute(array(':id_topic' =>   $Arr[$index]));
            
            $row = $stmt->fetch();
                echo '<li>';
                echo $row['Topic_name'];
                
                $this->recursiveNavViewBuilder($this->getDescendants($Arr[$index]));
                
                echo '</li>';
              
            } catch (Exception $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors
            }
  
        }
        echo '</ul>';
    }
    
    public function makeList() {
        
        $resultArr = array();
        
        $resultArr = $this->getDescendants(0);
        
        $this->recursiveNavViewBuilder($resultArr);          
    }
    
}

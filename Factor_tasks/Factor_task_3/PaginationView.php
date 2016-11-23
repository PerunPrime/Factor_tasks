<?php
include_once './PDOConnect.php';
class PaginationView {
    
    private $pdoConnect;
    
    public function __construct() {
        $this->pdoConnect = new PDOConnect();
    }
    private function viewList($pageNumber) {
        
        echo '<ul style="list-style-type:none">';
            try {
                 $dbh =$this->pdoConnect->Connect(); // get connection to DataBase
            
                 $sql = "SELECT * FROM `news` where "
                         . "`id` > 5*( :pageNumber -1 )"
                         . "order by id limit 5";     
                 $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                 $stmt->execute(array(':pageNumber' => $pageNumber));
            
            while ($row = $stmt->fetch()) {
                echo '<li>';
                echo '<H3>'.$row['name'].'</H3>';
                echo '<p>'.$row['desc'].'</p>';
                echo '</li>';
                }
                
            } catch (Exception $ex) {
                 echo  "Error!: " . $ex->getMessage() . "<br/>";  // catching some errors
            }
            
        echo '</ul>';  
        
    }
    
    private function drawArrowLeft($pageNumber,$amountOfPages) {
        
        if ($pageNumber >= $amountOfPages) {
             echo '<a href="http://localhost/Factor_task_3/index.php?page='.($pageNumber-6).'"';
            echo 'style="color: #0f81dc;"';
            echo '> < </a>';
        }  else {
            echo '<span> < <span>';
        } 
    }
    private function drawArrowRight($pageNumber,$amountOfPages,$totalNewsCount) {
        
        if ($pageNumber < ceil ($totalNewsCount / $amountOfPages) -6) {
            echo '<a href="http://localhost/Factor_task_3/index.php?page='.($pageNumber+6).'"';
            echo 'style="color: #0f81dc;"';
            echo '> > </a>';
        }  else {
            echo '<span> > <span>';
        }  
    }
    private function drawPagesOfPaginations($pageNumber,$numberOfFirstPage,$numberOfLastPage) {
        
        for ($index = $numberOfFirstPage; $index <= $numberOfLastPage; $index++) {
            
            if ($index == $pageNumber) {
                echo '<span>'.$index.'<span>';
            }  else {
                echo '<a href="http://localhost/Factor_task_3/index.php?page='.$index.'"';
                echo 'style="color: #0f81dc;"';
                echo '> '.$index.' </a>';
            }
            if ($index != $numberOfLastPage) {echo ' | ';}         
        }
    }
    private function viewPagination($pageNumber,$totalNewsCount) {
        
        $amountOfPages = 5;
        $numberOfFirstPage = 0;
        $numberOfLastPage = 0;
        
        if ($pageNumber <= $amountOfPages) {
            
            $numberOfFirstPage = 1;
            $numberOfLastPage = 11;
             
        }  elseif ($pageNumber > ceil ($totalNewsCount / $amountOfPages) -6) {
                
            $numberOfFirstPage =  ceil ($totalNewsCount / $amountOfPages) - 10;
            $numberOfLastPage =  ceil ($totalNewsCount / $amountOfPages);
        }else {
            
            $numberOfFirstPage = $pageNumber - $amountOfPages;
            $numberOfLastPage = $pageNumber + $amountOfPages;

        }
        $this->drawArrowLeft($pageNumber,$amountOfPages);
        $this->drawPagesOfPaginations($pageNumber,$numberOfFirstPage, $numberOfLastPage);
        $this->drawArrowRight($pageNumber, $amountOfPages,$totalNewsCount);
        
    }
    
    public function viewPaginationList($pageNumber = 1) {
        $dbh =$this->pdoConnect->Connect(); 

        $sql = "SELECT id FROM `news` GROUP BY id desc LIMIT 1";                       
        $stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute();         
        $row = $stmt->fetch();
        $totalNewsCount = $row['id'];
            
         
        $this->viewList($pageNumber);
        $this->viewPagination($pageNumber,$totalNewsCount);
        
    }
    
}

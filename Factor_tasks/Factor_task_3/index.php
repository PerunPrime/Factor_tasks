<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once './PaginationView.php';
        
        $pageNumber = 0;
        if($_GET['page'])
        {
            $pageNumber = $_GET['page'];
        }
        
        $paginationView = new PaginationView();
        $paginationView->viewPaginationList($pageNumber);
        
        ?>
       
    </body>
</html>

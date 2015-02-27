<?php include_once('mvc/view/shared/header.php'); ?>
<?php 
//the main content will be hadded depending from the get value of content. If there is no get value of content it will show the default home page
    


    //this will set the content request to index or the requested page
    if (!empty($_GET['content'])) {
      $contentRequest = $_GET['content'];
    }else{
      $contentRequest = 'index';
    }

    //make sure the request does not include any special character like backslahes or dots that could be used by hacker
    if(preg_match('^[a-zA-Z0-9]+$', $contentRequest)){
        include_once('mvc/view/content/404.php'); 
    }else{
        
        //VIEW
        //this set the php path
        $viewPath = 'mvc/view/content/' . $contentRequest . '.php';

        //here we check if the view exist.. if it doesnt, we forward to the 404 page.
        $viewPathExist = is_file($viewPath);
        if($viewPathExist){
            include_once($viewPath); 
        }else{
            include_once('mvc/view/content/404.php'); 
        }

        //we jsut load the following if the view path exists
        if($viewPathExist){
            //JS CONTROLLER
            $controllerJsPath = 'mvc/controller/js/' . $contentRequest . '.js';

            if(is_file($controllerJsPath)){
                include_once($controllerJsPath); 
            }

            //PHP CONTROLLER
            $controllerPhpPath = 'mvc/controller/php/' . $contentRequest . '.php';
            if(is_file($controllerPhpPath)){
                include_once($controllerJsPath); 
            }
        }
    }
?>
<?php include_once('mvc/view/shared/footer.php'); ?>
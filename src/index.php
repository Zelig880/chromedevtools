<?php 
//the main content will be hadded depending from the get value of content. If there is no get value of content it will show the default home page
//if the value passed doesnt exist of include special character it will be redirected to a 404 page.
    


    //this will set the content variable to index or the requested page
    if (!empty($_GET['content'])) {
      $contentRequest = $_GET['content'];
    }else{
      $contentRequest = 'index';
    }

    //make sure the request does not include any special character like backslahes or dots that could be used by hacker
    if(preg_match('^[a-zA-Z0-9]+$', $contentRequest)){
        include_once('mvc/view/content/404.php'); 
    }else{
        
        //create the view path( the view path will be used to load our main content);
        $viewPath = 'mvc/view/content/' . $contentRequest . '.php';

        //here we check if the view exist.. 
        $viewPathExist = is_file($viewPath);
    }
?>

<?php
//load the php model file
        if($viewPathExist){
            //PHP model
            $modelPhpPath = 'mvc/model/pages/php/' . $contentRequest . '.php';
            if(is_file($modelPhpPath)){
                //here we need to include the include function because we have already loaded a file with the some name
                include($modelPhpPath); 
            }
        }
?>

<?php 
    //load our partial header
    include_once('mvc/view/shared/header.php'); 
?>

<?php         
        
        if($viewPathExist){
            include($viewPath); 
        }else{
            include('mvc/view/content/404.php'); 
        }
?>

<?php 
    //load our partial footer
    include_once('mvc/view/shared/footer.php'); 
?>

<?php
//load the js file
        if($viewPathExist){
            //JS model
            $modelJsPath = 'mvc/model/pages/js/' . $contentRequest . '.js';

            echo "<script src='" . $modelJsPath ."'></script>";
        }
?>
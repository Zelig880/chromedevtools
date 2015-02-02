<?php include_once('mvc/view/shared/header.php'); ?>
<?php 
//the main content will be hadded depending from the get value of content. If there is no get value of content it will show the default home page
    
    //this will set the content request to index or the requested page
    if (!empty($_GET['content'])) {
      $contentRequest = $_GET['content'];
    }else{
      $contentRequest = 'index';
    }

    $wholePath = 'mvc/view/content/' . $contentRequest . '.php';
    //here we check if the page exist.. if it doesnt, we forward to the 404 page.
    if(is_file($wholePath)){
        include_once($wholePath); 
    }else{
        include_once('mvc/view/content/404.php'); 
    }
?>
<?php include_once('mvc/view/shared/footer.php'); ?>
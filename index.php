<?php

/* LINKS DE EJEMPLO PARA PROBAR: 
https://futbolme.com/resultados-directo/partido/cd-maspalomas-cd-arguineguin/1052332 
https://futbolme.com/resultados-directo/partido/cd-badajoz-real-union-club/1005605
https://futbolme.com/resultados-directo/partido/ae-santa-gertrudis-cd-atletico-jesus/1046565
*/
include_once 'simple_html_dom.php';

    if(isset($_GET['link'])){
        $link = $_GET['link'];
        $html = file_get_html($link);

        $title = $html->find('title', 0)->plaintext;
        $date = $html->find('div[class="col-12 text-right"]', 0)->plaintext;
        $result1 = $html->find('p[class="marcador"]', 0)->plaintext;
        $result2=$html->find('p[class="marcador"]', 1)->plaintext;
        $score=$html->find('table[class="col-12"]', 0);
        $minutes=array();
        $scorers = array();

        foreach($score->find('span[class="label label-info"]') as $minute){
            array_push($minutes, $minute);
        }

        foreach($score->find('a') as $scorer){
             array_push($scorers, $scorer);
        }
              
        $content = "<h1>".$title."</h1> <p>Fecha y hora: ".$date."</p> <p>Resultado: ".$result1.' - '.$result2."</p>";
         
       
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="GET">
        <label for="code"> Ingrese el link de soccerway del partido:</label>
        <input type="text" name="link"> <br><br>
    </form>
    <div>
        <p><?= $content?></p>
        
        <p><?php if(!empty($scorers)):?>
            <p>Goleadores: </p>
                 <?php for($i = 0; $i < count($scorers); $i++):?>
                     <?=$scorers[$i]?> <?=$minutes[$i]?>'</br>
                 <?php endfor;?>
            <?php endif;?>     
         </p>  
    </div>
</body>
</html>
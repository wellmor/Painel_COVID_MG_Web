<?php

include './conexao.php';

if(isset($_REQUEST["term"])){

    // Prepare a select statement
    $stmt = $pdo->prepare("SELECT * FROM municipio WHERE nomeMunicipio LIKE :s LIMIT 2");
    $term = utf8_decode($_REQUEST["term"]) . '%';
    $stmt->bindParam(':s', $term, PDO::PARAM_STR);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($stmt->rowCount() > 0){
            $cod = $row["codMunicipio"];
            $nome = utf8_encode($row["nomeMunicipio"]);
            
            echo '<p><a href="./dados.php?cod='.$cod.'&nome='.$nome.'">'.utf8_encode($row["nomeMunicipio"]).'</a></p>';
        }
        else{
            echo "<p>Sem resultados</p>";
        }
    }
    
}
?>
<?php
/*
Las lineas:
$query = $pdo->prepare(---);
$query->execute();
return $query->fetch();
se repiten en las functiones totalSingers y getSinger
por lo que es mejor crear una sola funcion para no repetir
 */
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}
// process DateTime objects 
function processDates($fields){
    foreach($fields as $key => $value){
        if($value instanceof DateTime){
            $fields[$key] = $value->format('Y-m-d');
        }
    }
    return $fields;
}

// Muestra el total de registros
/*
function totalSingers($pdo){
    $query = $pdo->prepare('SELECT COUNT(*) FROM `singers`');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}
 */
function totalSingers($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM `singers`');
    $row = $query->fetch();
    return $row[0];
}

/*
function getSinger($pdo, $id){
    $query = $pdo->prepare('SELECT * FROM `singers` 
    WHERE `idsingers` = :idsingers');
    $query->bindValue(':idsingers', $id);
    $query->execute();
    return $query->fetch();
}  
 */
// en lugar de una consulta SELECT
function getSinger($pdo, $idsingers){
    $parameters = [':idsingers' => $idsingers];
    $query = query($pdo, 'SELECT * FROM `singers` 
    WHERE `idsingers` = :idsingers', $parameters);
    return $query->fetch();
}  

// Insertar un nuevo registro en la base de datos
function insertSinger($pdo, $singer_name, $singer_date, $idauthors, $idcategories){
    $query = 'INSERT INTO `singers` (`singer_name`, `singer_date`,
    `date_added`, `idauthors`, `idcategories`) VALUES (:singer_name, :singer_date, CURDATE(), :idauthors, :idcategories)';
    $parameters = [':singer_name' => $singer_name, ':singer_date' =>$singer_date, ':idauthors' => $idauthors, ':idcategories' => $idcategories];
    query($pdo, $query, $parameters);
}

//  InsertSinger Improved
function insertSingerI($pdo, $fields){
    $query = 'INSERT INTO `singers` (';
    foreach($fields as $key => $value){
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach($fields as $key => $value){
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = processDates($fields);
    query($pdo, $query, $fields);
}

// Actualigar un nuevo registro en la base de datos
function updateSinger($pdo, $idsingers, $singer_name, $singer_date, $idauthors){
    $parameters = [':singer_name' => $singer_name, ':singer_date' => $singer_date, ':idsingers' => $idsingers, ':idauthors' => $idauthors];
    query($pdo, 'UPDATE `singers` SET `singer_name` = :singer_name, `singer_date` = :singer_date, `idauthors` = :idauthors WHERE `idsingers` = :idsingers', $parameters);
}

// updateSinger Improved
function updateSingerI($pdo, $fields){
    $query = ' UPDATE `singers` SET';
    foreach($fields as $key => $value){
        $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE `idsingers` = :primaryKey';
    // set the :primaryKey variable
    $fields['primaryKey'] = $fields['idsingers'];
    $fields = processDates($fields);
    query($pdo, $query, $fields);
}

function deleteSinger($pdo, $idsingers){
    $parameters = [':idsingers' => $idsingers];
    query($pdo, 'DELETE FROM `singers` WHERE `idsingers` = :idsingers', $parameters);
}

// Mostrar todos los registros en la base de datos
function allSingers($pdo){
    $singers = query($pdo,  'SELECT `singers`.`idsingers`, `singer_name`,
    `date_added`, `name_author`, `email_author` FROM
    `singers` INNER JOIN `authors` ON `idauthors` = `authors`.`id_author`');
    return $singers->fetchAll();
}

function findAll($pdo, $table){
    $result = query($pdo, 'SELECT * FROM `' . $table . '`');
    return $result->fetchAll();
}

function delete($pdo, $table, $primaryKey, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `' . $table . '`
    WHERE `' . $primaryKey . '` = :id', $parameters);
}

function insert($pdo, $table, $fields){
    $query = 'INSERT INTO `' . $table . '` (';
    foreach($fields as $key => $value){
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach($fields as $key => $value){
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = processDates($fields);
    query($pdo, $query, $fields);
}

function update($pdo, $table, $primaryKey, $fields){
    $query = ' UPDATE `' . $table . '` SET';
    foreach($fields as $key => $value){
        $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
    // set the :primaryKey variable
    $fields['primaryKey'] = $fields[$primaryKey];
    $fields = processDates($fields);
    query($pdo, $query, $fields);
}

function findById($pdo, $table, $primaryKey, $value){
    $query = 'SELECT * FROM `' . $table . '` 
    WHERE `' . $primaryKey . '` = :value';
    $parameters = [
        'value' => $value
    ];
    $query = query($pdo, $query, $parameters);
    return $query->fetch();
}

function total($pdo, $table){
    $query = query($pdo, 'SELECT COUNT(*)
    FROM `' . $table . '`');
    $row = $query->fetch();
    return $row[0];
}

// This is no longer necessary, bro ;()
function allAuthors($pdo){
    $authors = query($pdo, 'SELECT * FROM `authors`');
    return $authors->fetchAll();
}

function deleteAuthors($pdo, $id_author){
    $parameters = [':id_author' => $id_author];
    query($pdo, 'DELETE FROM `authors` WHERE `id_author` = :id_author', $parameters);
}

function insertAuthors($pdo, $fields){
    $query = 'INSERT INTO `authors` (';
    foreach($fields as $key => $value){
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach($fields as $key => $value){
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = processDates($fields);
    query($pdo, $query, $fields);
}

function save($pdo, $table, $primaryKey, $record){
    try{
        if($record[$primaryKey] == ''){
            $record[$primaryKey] = null;
        }
        insert($pdo, $table, $record);
    }catch(PDOException $e){
        update($pdo, $table, $primaryKey, $record);
    }
}
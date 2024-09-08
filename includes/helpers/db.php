<?php

/**
 * insert data into database
 * @param
 * @return mixed
 */
if(!function_exists('db_insert')){

    function db_insert($table, $columns, $values){
        global $connect;
        //  Convert arrays to comma-separated strings to $columns and $values
        $col = implode(",", $columns);
        $data = "'".implode("','", $values)."'";
        // var_dump($GLOBALS['connect']);
        $sql = "INSERT into $table ($col) VALUES ($data)";
        echo $table;
        echo "<br>";
        var_dump($col);
        echo "<br>";
        var_dump($data);
        echo "<br>";
        
        mysqli_query($connect, $sql);
        
        //  get the last inserted id
        $id = mysqli_insert_id($connect);
        $queryId = mysqli_query($connect, "SELECT * FROM $table WHERE id = $id");
        $result = mysqli_fetch_assoc($queryId);
        mysqli_close($connect);
         return $result;
    }
}


//  function for update the database

if(!function_exists('db_update')){
    function db_update($table, $columns, $values, $id){
        global $connect;
        //  for each column = 'value'
        $set = [];
        foreach($columns as $key => $column){
            $value = $values[$key];
            $set[] = "$column = '$value'";
        }        
        $setClause = implode(",", $set);
        $sql = "UPDATE $table SET $setClause WHERE id = $id";
        mysqli_query($connect, $sql);
        mysqli_close($connect);
        echo $table . "<br>";
        var_dump($setClause);
        echo "<br>";
        return print "updated";
    }
}

// delete data from database

if(!function_exists('db_delete')){
    function db_delete($table, $id){
        global $connect;
        $sql = "DELETE FROM $table WHERE id = $id";
        mysqli_query($connect, $sql);
        mysqli_close($connect);
        return print "deleted";
    }
}

// fetch single data from database

if(!function_exists('db_find')){
    function db_find($table, $id){
        global $connect;
        $sql = "SELECT * FROM $table WHERE id = $id";
        $query = mysqli_query($connect, $sql);
        $result = mysqli_fetch_assoc($query);
        mysqli_close($connect);
        return $result;
    }
}

// search one upon query from database

if(!function_exists('db_search')){
    function db_search($table, $queryStr){
        global $connect;
        $sql = "SELECT * FROM $table WHERE $queryStr";
        $query = mysqli_query($connect, $sql);
        $result = mysqli_fetch_assoc($query);
        mysqli_close($connect);
        return $result;
    }
}

// search many upon query from database

if(!function_exists('db_searchMany')){
    function db_searchMany($table, $queryStr){
        global $connect;
        $sql = "SELECT * FROM $table WHERE $queryStr";
        $query = mysqli_query($connect, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        mysqli_close($connect);
        return $result;
    }    
}

// search many with pagination upon query from database
if (!function_exists('renderPagination')) {
    function renderPagination($totalPages):string {
        $html = '<ul>';
for ($i=1; $i <= $totalPages; $i++) {
    $html .= "<li><a href='?page=$i'>$i</a></li>";
}
    $html .= '</ul>';
    return $html;
    }
}
if(!function_exists('db_paginate')){
    function db_paginate(string $table,string $queryStr,int $limit=15):array{
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $currentPage = $_GET['page']-1;
        }else{
            $currentPage = 0;
        }
        global $connect;
        $countQuery = mysqli_query($connect,"SELECT count(id) FROM $table  $queryStr");
        $count = mysqli_fetch_row($countQuery);
        $totalRecords = $count[0];
        $start= $currentPage * $limit;
        $totalPages = ceil($totalRecords / $limit);
        if ($currentPage > $totalPages) {
            $start = $totalPages + 1;
        }
        $sql = "SELECT * FROM $table  $queryStr LIMIT {$start},{$limit}";
        $query = mysqli_query($connect, $sql);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query'=>$query,
            'num'=>$num,
            'render'=>renderPagination($totalPages),
            'currentPage'=>$currentPage,
            'limit'=>$limit
        ];
    }
}
function firePaginate($table,$column,$limit) {
    $users = db_paginate($table,'',$limit);
while ($row = mysqli_fetch_assoc($users['query'])) {
    echo $row[$column]."<br>";
}
echo $users['render'];
}


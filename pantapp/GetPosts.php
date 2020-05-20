<?php


$db = new SQLite3("DB/posts.db");


$results = $db->query('SELECT * FROM posts'); //check if user already exists
 
$data = array();

while ($row = $results->fetchArray()) {
    array_push($data, $row);
}
echo json_encode($data);

exit();

?>
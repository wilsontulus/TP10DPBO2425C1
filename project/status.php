<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start([
        'cookie_lifetime' => 86400
    ]); 
} 

header("Content-Type: application/json; charset=utf-8");

$knownVars = array("lastAccessed", "event_lastUpdated", "game_lastUpdated", "player_lastUpdated", "genre_lastUpdated");

$session_vars = [];

foreach ($knownVars as $knownVar) {
    $session_vars[$knownVar] = isset($_SESSION[$knownVar]) ? $_SESSION[$knownVar] : 0;
}
echo json_encode($session_vars);

?>
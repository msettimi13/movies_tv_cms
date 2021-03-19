<?php

include_once 'config/database_old.php';
include_once 'config/database.php';

# Run old code
# Microtime is a PHP function to grab time at point of execution
$start = microtime(true);

#Repeat x1000 db connections
$i = 0;
while($i < 1000){

    $database = new Database_Old();
    $db = $database->getConnection();
    $i ++;

    }

$old_time_cal = microtime(true) - $start;



#Run new code
# Microtime is a PHP function to grab time at point of execution
$start = microtime(true);

#Repeat x1000 db connections
$i = 0;
while($i < 1000){
    $database = Database::getInstance();
    $db = $database->getConnection();
    $i ++;
}

$new_time_cal = microtime(true) - $start;

$diff = $old_time_cal-$new_time_cal;
$percentage = ($new_time_cal / $old_time_cal) *100;

printf('Old DB Connection Cal ==> %s ms'.PHP_EOL, $old_time_cal*1000);
printf('New DB Connection Cal ==> %s ms'.PHP_EOL, $new_time_cal*1000);

printf('You saved %s ms per connection'.PHP_EOL, $diff*1000);
printf('New connection only takes %s%% of Old connection'.PHP_EOL, $percentage);
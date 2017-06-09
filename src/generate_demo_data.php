<?php
// Run "php generate_demo_data.php" in command line.
// Press Control + C when file reach your desire size.
$str = '';
while(true) {
   $str .= md5(rand()).PHP_EOL;
   file_put_contents('logs.txt', $str, FILE_APPEND | LOCK_EX);
 }

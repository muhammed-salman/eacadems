<?php
$path="export CLASSPATH=/var/www/html/eacadems/weka/weka.jar:\$CLASSPATH;"
      . " export CLASSPATH=\$CLASSPATH:/usr/share/java/mysql-connector-java-5.1.28.jar;";
  $path=$path." javac Predictor.java; "."java Predictor";
  echo $path;
echo nl2br(shell_exec($path));

?>

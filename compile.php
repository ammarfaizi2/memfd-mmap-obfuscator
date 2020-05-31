<?php

for ($i=0; $i < 15; $i++) {
  echo "cycle {$i}\n";
  echo shell_exec("php -d memory_limit=-1 integral_gen.php /tmp/test /tmp/test");
}


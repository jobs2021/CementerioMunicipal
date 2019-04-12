<?php

setcookie('user_session','{ "user" : "jony" }',time()-3600);
header("location:{$server}/login/");
exit();

?>
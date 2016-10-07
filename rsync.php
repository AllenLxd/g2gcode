<?php
	$git_repo = 'https://github.com/qq260101081/liusheji.git';
    $www_folder = '/usr/share/nginx/html';
    echo shell_exec(" cd $www_folder && git pull $git_repo 2>&1 ");
 ?>
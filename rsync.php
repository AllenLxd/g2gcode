<?php
    $git_repo = 'https://github.com/AllenLxd/g2gcode.git';
    $www_folder = '/var/www/html';
    echo shell_exec(" cd $www_folder && git pull $git_repo 2>&1 ");
 ?>

<?php

// we already used:
// dirname()
// is_dir()

// getcwd() : Current Working Directory
echo getcwd() . "<br/>";

// mkdir()
mkdir('new', 0777); // 0777 is the PHP default

// use umask() to change default permission settings
// default may be 0222

// recursive dir creation
mkdir('new/test/test2', 0777, true);

// changing dirs
chdir('..');
echo getcwd()."<br/>";

// removing a directory
rmdir('new');

// must be closed and EMPTY before removal (and be CAREFUL)
// scripts to help you wipe out directories with files:
// http://www.php.net/manual/en/functions.rmdir.php




?>
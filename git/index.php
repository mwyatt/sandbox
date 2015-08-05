<?php

echo shell_exec("/usr/lib/git-core pull 2>&1");

// git ls-remote --heads git@github.com:mwyatt/mvc.git explode space, keep first -> compare with -> git rev-parse HEAD
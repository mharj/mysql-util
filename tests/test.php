<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
use mharj\MySqlUtil;
echo MySqlUtil::parseFromUri("mysql://username:password@server/db");
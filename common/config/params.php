<?php

return [
    'dbhost' => 'host.docker.internal',
    'dbport' => '3306',
    'dbname' => 'book_catalog',
    'dbuser' => 'root',
    'dbpass' => 'verysecret',

    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
    'emulatePrepare' => true,
];

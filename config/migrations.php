<?php

return [
    'name' => 'Doctrine Migrations',
    'migrations_namespace' => 'Database\Migrations',
    'table_name' => 'migrations',
    'column_name' => 'version',
    'column_length' => 14,
    'executed_at_column_name' => 'executed_at',
    'migrations_directory' => database_path('migrations'),
    'all_or_nothing' => true,
    'check_database_platform' => true,
];

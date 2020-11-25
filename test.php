<?php

require_once 'task.php';

$result = createSelectQuery(
    'table',
    ['one', 'two', 'three'],
    [
        'c1' => 'v1',
        '>=c2' => 2,
        'c3' => [1, 2, 3],
        '!=c4' => 4,
    ]
);

file_put_contents('out.txt', var_export($result, true));

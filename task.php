<?php

function createSelectQuery(string $table, array $fields = [], array $filter = []): string
{
    $columns = (empty($fields) ? '*' : implode(', ', $fields));
    $result = sprintf('select %s from %s', $columns, $table);

    if (!empty($filter)) {
        $conditions = [];
        $operators = [
            '>=',
            '<=',
            '!=',
            '>',
            '<',
            '%',
        ];
        foreach ($filter as $column => $value) {
            $op = 'like';

            if (is_array($value)) {
                $op = 'in';
                $value = '(' . implode(', ', $value) . ')';
            } else {
                foreach ($operators as $operator) {
                    if (strpos($column, $operator) === 0) {
                        $column = substr($column, strlen($operator));
                        $op = $operator;
                        break;
                    }
                }
            }
            $conditions[] = sprintf('%s %s %s', $column, $op, $value);
        }

        $result .= ' where ' . implode(' AND ', $conditions);
    }

    return $result;
}

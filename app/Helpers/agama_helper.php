<?php

function getAgamaList(): array
{
    return [
        'Islam',
        'Kristen',
        'Katolik',
        'Hindu',
        'Buddha',
        'Konghucu'
    ];
}

function getValidateList(): string
{
    $pattern = "";
    $i = 0;
    foreach (getAgamaList() as $dt) {
        $pattern .= $dt;
        if ($i < count(getAgamaList()) - 1) {
            $pattern .= ",";
        }
        $i++;
    }
    return "in_list[" . $pattern . "]";
}

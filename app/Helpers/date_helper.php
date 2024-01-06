<?php

function validateDate($date, $format = 'Y-m-dH:i:s'): bool
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function normalizeDate(string $date, string $format = "Y-m-d H:i:s"): string
{
    $newDate = DateTime::createFromFormat("d F Y", $date);
    return $newDate->format($format);
}

function normalizeDateFromDB(?string $date, string $formatFrom = "Y-m-d H:i:s", string $formatTo = "d F Y"): string
{
    if (is_null($date) || is_null($formatFrom) || is_null($formatTo) || strtotime($date) == 0 || $date == "0000-00-00" || $date == "0000-00-00 00:00:00") {
        return "";
    }
    try {
        $newDate = DateTime::createFromFormat($formatFrom, $date);
        return $newDate->format($formatTo);
    } catch (\Throwable $th) {
        return "";
    }
}

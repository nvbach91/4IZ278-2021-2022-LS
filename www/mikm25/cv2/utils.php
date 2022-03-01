<?php

if (! function_exists('getAgeByBirthdate')) {
    /**
     * @param string|DateTimeInterface $birthdate birthdate as a
     * date string in format YYYY-MM-DD or as date time interface instance
     */
    function getAgeByBirthdate($birthdate): int
    {
        $timezone = new DateTimeZone("Europe/Prague");

        if (! ($birthdate instanceof DateTimeInterface)) {
            $birthdate = DateTimeImmutable::createFromFormat('Y-m-d', $birthdate, $timezone);
        }

        if ($birthdate === false) {
            throw new InvalidArgumentException("Invalid date passed, the date must be in YYYY-MM-DD format!");
        }

        try {
            $currentDate = new DateTimeImmutable('now', $timezone);
        } catch (Throwable $exception) {
            throw new RuntimeException("Failed getting current date!");
        }

        return $currentDate->diff($birthdate)->y;
    }
}

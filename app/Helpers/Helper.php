<?php

/**
 * This function helps to get the number of days excluding holidays or weekends.
 *
 * @param DateTime $start The start date.
 * @param DateTime $end The end date.
 * @param array $holidays An array of holiday dates (as strings in 'Y-m-d' format).
 * @throws Exception
 */

function detect_holiday(
    DateTime $start,
    DateTime $end,
    array $holidays = []
): int {
    //    $startDate = new DateTimeImmutable('Y-m-d', $start);
    //    $endDate = new DateTimeImmutable('Y-m-d', $end);
    // Create DateTimeImmutable instances from DateTime object

    $startDate = DateTimeImmutable::createFromMutable($start);
    $endDate = DateTimeImmutable::createFromMutable($end);

    $interval = $startDate->diff($endDate);

    $days = $interval->days;

    // // create an iterable period of date (P1D equates to 1 day)
    $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
    foreach ($period as $dt) {
        $curr = $dt->format('D');

        if ($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        } elseif (in_array($dt->format('Y-m-d'), $holidays)) {
            $days--;
        }
    }

    return $days;
}

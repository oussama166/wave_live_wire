<?php

use Carbon\Carbon;

/**
 * This function helps to get the number of days excluding holidays or weekends.
 *
 * @param DateTime $start The start date.
 * @param DateTime $end The end date.
 * @param array $holidays An array of holiday dates (as strings in 'Y-m-d' format).
 * @return int The number of working days.
 * @throws Exception
 */
function detect_holiday(
    DateTime $start,
    DateTime $end,
    array $holidays = []
): int {
    // Create DateTimeImmutable instances from DateTime objects
    $startDate = DateTimeImmutable::createFromMutable($start);
    $endDate = DateTimeImmutable::createFromMutable($end);

    // Calculate the total number of days between the two dates
    $interval = $startDate->diff($endDate->modify('+1 day'));
    $days = $interval->days;

    // Retrieve holidays for the next year
    $holidayDates = \App\Models\Holiday::query()
        ->get('date')
        ->pluck('date')
        ->toArray();

    // Merge passed holidays with the fetched holidays

    // Create an iterable period of dates (P1D equates to 1 day)
    $period = new DatePeriod(
        $startDate,
        new DateInterval('P1D'),
        $endDate->modify('+1 day')
    );

    foreach ($period as $dt) {
        $curr = $dt->format('D');

        // Exclude weekends
        if ($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        } elseif (in_array($dt->format('Y-m-d'), $holidayDates)) {
            // Check if the holiday is not on a weekend
            $holidayDay = $dt->format('D');
            if ($holidayDay !== 'Sat' && $holidayDay !== 'Sun') {
                $days--;
            }
        }
    }

    return $days;
}

function timeAgo($timestamp)
{
    // Convert the timestamp to a Carbon instance
    $dateTime = Carbon::parse($timestamp);

    // Calculate the difference from now
    $timeAgo = $dateTime->diffForHumans();

    return $timeAgo;
}

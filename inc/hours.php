<?php

$hours = array(
  1 => [
    [strtotime('9:00'), strtotime('13:45')],
    [strtotime('14:45'), strtotime('17:00')]
    ],
  2 => [
    [strtotime('9:00'), strtotime('13:45')],
    [strtotime('14:45'), strtotime('17:00')]
    ],
  3 => [
    [strtotime('12:45'), strtotime('13:45')],
    [strtotime('14:45'), strtotime('21:00')]
    ],
  4 => [
    [strtotime('9:00'), strtotime('13:45')],
    [strtotime('14:45'), strtotime('17:00')]
    ],
  5 => [
    [strtotime('9:00'), strtotime('13:45')],
    [strtotime('14:45'), strtotime('17:00')]
    ],
  6 => 'closed',
  7 => 'closed',
);

$current_time = time();
$current_day = date('N', $current_time);

$opening_messages = array(
  'closed_for_weekend' => esc_attr_x( 'We’re closed right now, we open on Monday at ', 'opening hours in footer', 'svid-theme-domain'),
  'closed_morning'     => esc_attr_x( 'We’re closed right now, but we open at ', 'opening hours in footer', 'svid-theme-domain'),
  'opened'             => esc_attr_x( 'We’re opened until ', 'opening hours in footer', 'svid-theme-domain'),
  'closed_afternoon'   => esc_attr_x( 'We’re closed right now, but we open again at ', 'opening hours in footer', 'svid-theme-domain'),
  'closed_for_today'   => esc_attr_x( 'We’re closed right now, but we open again tomorrow, at ', 'opening hours in footer', 'svid-theme-domain')
);

$todays_hours = $hours[$current_day];
if($todays_hours === 'closed') {
  echo $opening_messages['closed_for_weekend'];
  echo "<strong>" . date("H:i", $hours[1][0][0]) . "</strong>";
} else {
  $current_time = time();
  if($current_time < $todays_hours[0][0]) {
    echo $opening_messages['closed_morning'];
    echo "<strong>" . date("H:i", $todays_hours[0][0]) . "</strong>.";
  } elseif($current_time > $todays_hours[0][0] &&
           $current_time < $todays_hours[0][1]) {
    echo $opening_messages['opened'];
    echo "<strong>" . date("H:i", $todays_hours[0][1]) . "</strong>.";
  } elseif($current_time < $todays_hours[1][0]) {
    echo $opening_messages['closed_afternoon'];
    echo "<strong>" . date("H:i", $todays_hours[1][0]) . "</strong>.";
  } elseif($current_time > $todays_hours[1][0] &&
           $current_time < $todays_hours[1][1]) {
    echo $opening_messages['opened'];
    echo "<strong>" . date("H:i", $todays_hours[1][1]) . "</strong>.";
  } else {
    $tomorrow = $hours[$current_day + 1];
    if($tomorrow === 'closed') {
      echo $opening_messages['closed_for_weekend'];
      echo "<strong>" . date("H:i", $hours[1][0][0]) . "</strong>";
    } else {
      echo $opening_messages['closed_for_today'];
      echo "<strong>" . date("H:i", $tomorrow[0][0]) . "</strong>.";
    }
  }
}

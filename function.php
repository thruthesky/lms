<?php

function prepare_books_by_date( $data ) {
    $dates = array();
    $texts = array();
    foreach( $data as $book ) {
        $book['icon'] = str_replace('./data/', 'http://onlineenglish.kr/data/', $book['icon']);
        $dates[ $book['date'] ][] = $book;
    }

    if ( $dates ) {
        foreach ( $dates as $date => $books ) {
            $count = count( $books );
            $text = "<div class='books' count='$count'>";

            foreach( $books as $book ) {
                $name = $book['teacher']['mb_nick'];
                $no = $book['idx'];
                $comment = $book['rate_comment'];
                $minutes = $book['mins'];
                $date = $book['date'];
                $grammar = $book['rate_grammar'];
                $vocabulary = $book['rate_vocabulary'];
                $expression = $book['rate_expression'];
                $pronounciation = $book['rate_pronounciation'];
                $speed = $book['rate_speed'];
                $text .= "
                    <div class='book' date='$date' title='<div class=\"text\">Teachers Name: $name</div>
                    <div class=\"text\">Class No.: $no</div>
                    <div class=\"text\">Data: $date</div>'
                     data-content='
                    <div class=\"text\">Evaluation</div>
                    <div class=\"text rate\">Grammar: $grammar</div>
                    <div class=\"text rate\">Proficiency: $speed</div>
                    <div class=\"text rate\">Vocabulary: $vocabulary</div>
                    <div class=\"text rate\">Pronunciation: $pronounciation</div>
                    <div class=\"text rate\">Expression: $expression</div>
                    <div class=\"text comment\">Teachers Comments:</div>
                    <div class=\"text\">$comment</div>'>
                        <span class='icon'>$book[icon]</span>
                        <span class='name'>$name</span>
                        <span class='time'>$book[ktime]</span>
                    </div>
                ";
            }
            $text .= "</div>";
            $texts[ $date ] = $text;
        }
    }
    return $texts;
}


/* draws a calendar */
function draw_calendar( $month, $year, $data ){

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row" valign="top">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
        /* add in the day number */
        $calendar.= '<div class="day-number">'.$list_day.'</div>';

        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        //$calendar.= str_repeat('<p> </p>',2);

        $day = $list_day < 10 ? "0$list_day" : $list_day;
        $calendar .= isset( $data["$year$month$day"] ) ? $data["$year$month$day"] : null;

        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row" valign="top">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}

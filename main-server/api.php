<?php


function ajax_ex_body( $html ) {
    if ( is_wp_error( $html ) ) {
        return ['code'=>-1, 'message'=> get_error_message($html) ];
    }
    $body = json_decode( $html['body'], true );
    return $body;
}
function ajax_url($func) {
    $url = API_ENDPOINT . '?';
    $url .= 'id=' . user()->user_login;
    $url .= '&nickname=' . urlencode(user()->nickname);
    $url .= '&name=' . urlencode(user()->name);
    $url .= '&email=' . urlencode(user()->user_email);
    $url .= '&mobile=' . urlencode(user()->mobile);
    $url .= '&landline=' . urlencode(user()->landline);
    $classid = user()->skype ;
    if ( empty($classid) ) $classid = 've';
    $url .= '&classid=' . urlencode( $classid );
    $url .= '&domain=' . urlencode( get_opt('lms[domain]'));
    $url .= '&domain_key=' . urlencode( get_opt('lms[domain_key]'));
    $url .= '&function=' . $func;
    return $url;
}

function user_insert($id) {
    dog("lms user_insert($id)");
    wp_set_current_user($id);
    $url = ajax_url('user_insert');
    dog( $url );
    $body = ajax_ex_body( wp_remote_get( $url ) );
    dog( $body );
}



/**
 * @return array|mixed|object
 *
[idx] => 18070
[id] => Pia
[name] => Pia Joy Soriano
[nickname] => Manager Pia
[classid] => ontue.teacher.135
[url_youtube] => http://youtu.be/bXM3FP6iL1Q
[photo] => ./data/teacher/primary_photo_18070
[teaching_year] => 5
[birthday] => 19881121
[greeting] =>
Hello there!! ..This is Manager Pia.  If you have any problems in the class, I'm willing to help you.


[major] => Bachelor of Science in Nursing
[gender] => F
 */
function teacher_list() {
    $url = API_ENDPOINT . '?';
    $url .= 'domain=' . urlencode( get_opt('lms[domain]'));
    $url .= '&domain_key=' . urlencode( get_opt('lms[domain_key]'));
    $url .= '&function=teacher_list';
    dog($url);
    $cid = 'teacher-list-2';
    $response = get_transient( $cid );
    if( false === $response ) {
        $response = wp_remote_get( $url );
        set_transient( $cid, $response, 60 * 60 ); // 1시간 동안 캐시
    }
    return ajax_ex_body($response);
}

function class_list_by_month($Y, $m) {
    $url = ajax_url('class_list_by_month');
    $url .= "&Y=$Y&m=$m";
//di($url);
    return ajax_ex_body( wp_remote_get( $url ) );
}

function reservation_list() {
    $url = ajax_url('reservation_list');
    dog($url);

    $cid = 'reservation-list-3';
    $response = get_transient( $cid );
    if( false === $response ) {
        $response = wp_remote_get( $url );
        set_transient( $cid, $response, 60 * 4 ); // 4 minutes cache
    }
    return ajax_ex_body($response);

}
function past_list() {
    $url = ajax_url('past_list');
    dog($url);
    return ajax_ex_body( wp_remote_get( $url ) );
}


function kday( $day ) {
    $days = array('Sun'=>'일', 'Mon'=>'월', 'Tue'=>'화', 'Wed'=>'수', 'Thu'=>'목', 'Fri'=>'금', 'Sat'=>'토');
    return $days[$day];
}




function prepare_books_by_date( $data, &$no_of_absence ) {
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
                $absence = '';
                if ( $book['absent_student'] == 'Y' )  {
                    $no_of_absence ++;
                    $absence = ' absence';
                }
                $name = $book['teacher']['mb_nick'];
                $no = $book['idx'];
                $comment = $book['rate_comment'];
                $minutes = $book['mins'];
                $date = $book['date'];
                $grammar = $book['rate_grammar'];
                $vocabulary = $book['rate_vocabulary'];
                $expression = $book['rate_expression'];
                $pronounciation = $book['rate_pronounciation'];
                $textbook = esc_html($book['book']);
                $speed = $book['rate_speed'];
                // Updated by Mr. Song on June 8, 2106.
                $text .= "
                    <div class='book$absence' date='$date' title='<div class=\"text\">Teacher&#39;s Name: $name</div>
                    <div class=\"text\">Class No.: $no</div>
                    <div class=\"text\">Data: $date</div>'
                    ";
                $comment = str_replace("'",'&#39;' , $comment );
                $comment = str_replace('"','&#34;' , $comment );
                if ( empty($absence) ) {
                    $text .= "
                     data-content='
                    <div class=\"text\">Evaluation</div>
                    <div class=\"text rate\">Grammar: $grammar</div>
                    <div class=\"text rate\">Proficiency: $speed</div>
                    <div class=\"text rate\">Vocabulary: $vocabulary</div>
                    <div class=\"text rate\">Pronunciation: $pronounciation</div>
                    <div class=\"text rate\">Expression: $expression</div>

                    <div class=\"text book\">Book: $textbook</div>

                    <div class=\"text comment\">Teachers Comment&#39;s:</div>
                    <div class=\"text\">$comment</div>'
                    ";
                }
                $text .= ">";
                $text .= "
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

/* draws a calendar list view    */
function draw_calendar_listview( $month, $year, $data ){
    $listview = '<div class="listview calendar">';

    /* days and weeks vars now ... */
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $month_digit = date('m', mktime( 0, 0, 0, $month, 1, $year));

    /* list days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $day = $list_day < 10 ? "0$list_day" : $list_day;

        $listview.= '<div class="calendar-day">';
        /* add in the day number */
        $day_word = date('D', mktime( 0, 0, 0, $month, $list_day, $year));
        $listview.= '<div class="day-number">'.$month_digit.'/'.$list_day.'<span>'.$day_word.'</span></div>';
        $listview.= isset( $data["$year$month$day"] ) ? $data["$year$month$day"] : null;
        $listview.= '</div>';
    endfor;

    $listview .= '</div>';
    return $listview;
}

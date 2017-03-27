<?php

session_start();

// aikavyöhyke
date_default_timezone_set ( 'Europe/Helsinki' );

class Calendar{
    
    public $classDate;
    
    function __construct(string $givenDate = NULL) {
        if ($givenDate != NULL) {
            $this->classDate = new DateTime($givenDate);
        } else {   
            $this->classDate = new DateTime(date('Y-m-d'));
        }
    }
    
    // EI KÄYTÖSSÄ
    private function checkMonth() {
        if (date('Y-m', $this->classDate->getTimestamp()) == date('Y-m')) {
            $this->classDate = new DateTime(date('Y-m-d'));
        }
    }
    
    // ei käytössä missään
    private function isFutureDate(DateTime $givenDate): boolean {
        if ($givenDate > new DateTime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }
    
    // ei käytössä
    public function printDate() {
        echo $this->classDate;
    }
    
    // ei käytössä
    public function addOneMonth() {
        $this->classDate->modify('first day of next month');
        $this->checkMonth();
    }
    
    // ei käytössä
    public function subOneMonth() {
        $this->classDate->modify('last day of previous month');
        $this->checkMonth();
    }

    public function outputCalendar() {
    
        // muuttujat
        $monthNames = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kesäkuu',
                            'Heinäkuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');
       
        $date = $this->classDate->getTimestamp();
        $day = date('d', $date);
        $month = date('m', $date);
        $month_index = date('n', $date);
        $month_index--;
        $year = date('Y', $date);
        $firstDay = mktime(0,0,0,$month, 1, $year);
        $title = $monthNames[$month_index];
        $dayOfWeek = date('D', $firstDay);
        $daysInMonth = cal_days_in_month(0, $month, $year);
        $weekDays = array('Ma', 'Ti', 'Ke', 'To', 'Pe', 'La', 'Su');
        $extradays = date('w', strtotime("{$year}-{$month}-00"));
        $canBeCurrent = true;
        
        $next_month = new DateTime($this->classDate->format('Y-m-d'));
        $next_month->setDate(intval($next_month->format('Y')), intval($next_month->format('m')), 15);
        $next_month->add(new DateInterval('P1M'));
        
        $last_month = new DateTime($this->classDate->format('Y-m-d'));
        $last_month->setDate(intval($last_month->format('Y')), intval($last_month->format('m')), 15);
        $last_month->sub(new DateInterval('P1M'));
        
        if ($next_month->format('Y-m') == date('Y-m')) {
            $next_month = new DateTime(date('Y-m-d'));
        }
        
        if ($last_month->format('Y-m') == date('Y-m')) {
            $last_month = new DateTime(date('Y-m-d'));
        }
        
        if ($this->classDate != new DateTime(date('Y-m-d'))) {
            $canBeCurrent = false;
        }
    
        echo '<table class="table table-bordered" id="calendarTable" style="table-layout: fixed;">';
        echo '<tr>
    			 <th colspan="7" class="text-center"><span class="glyphicon glyphicon-chevron-left nuoli" id="subMonth" onclick="calendarLeft(this)" data-date="' . $last_month->format('Y-m-d') . '" style="float: left;"></span>' . $title . ' ' . $year . '<span class="glyphicon glyphicon-chevron-right nuoli" id="addMonth" data-date="' . $next_month->format('Y-m-d') . '" onclick="calendarRight(this)" style="float: right;"></span></th>
    		  </tr>';
        echo '<tr>';
    	foreach($weekDays as $key => $weekDay) {
    	    echo '<td class="text-center">' . $weekDay . '</td>';
    	}
        echo '</tr>
              <tr>';
    	for($i = 0; $i < $extradays; $i++) {
    		echo '<td></td>';
    	}
    	for($i = 1; $i <= $daysInMonth; $i++) {
    		if($day == $i && $canBeCurrent) {
    			echo '<td class="text-center"><strong>' . $i . '</strong></td>';
    		} else {
    			echo '<td class="text-center">' . $i . '</td>';
    		}
    		if(($i + $extradays) % 7 == 0) {
    			echo '</tr><tr>';
    		}
    	}
    	for($i = 0; ($i + $extradays + $daysInMonth) % 7 != 0; $i++) {
    		echo '<td></td>';
    	}
        echo '</tr>
              </table>';
        	
    } 
    
} ?>
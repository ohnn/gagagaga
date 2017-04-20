<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'db/connect.php';

// aikavyöhyke
date_default_timezone_set ( 'Europe/Helsinki' );

class Calendar {
    
    public $classDate;
    
    public function __construct(string $givenDate = NULL) {
        if ($givenDate != NULL) {
            $this->classDate = new DateTime($givenDate);
        } else {   
            $this->classDate = new DateTime(date('Y-m-d'));
        }
    }
    
    private function isFutureDate(DateTime $givenDate): bool {
        if ($givenDate > new DateTime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }
    
    // string muodossa Y-m-d
    private function amountOfTimes(string $givenDate): int {
        global $hene;
        if ($query = $hene->prepare('SELECT varausID FROM kalenteri WHERE (pvm=? AND asiakasID=?)')) {
            $asiakasID = 0;
            $query->bind_param('si', $givenDate, $asiakasID);
            if ($query->execute()) {
                $query->store_result();
                return $query->num_rows; 
            } else {
                print_r($query);
                return 99999;
            }
        } else {
            print_r($query);
            return 99999;
        }
    }


    // echo calendar
    public function outputCalendar() { 
    
        // muuttujat
        $monthNames = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kesäkuu',
                            'Heinäkuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');
        $weekDays = array('Ma', 'Ti', 'Ke', 'To', 'Pe', 'La', 'Su');
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
        $extradays = date('w', strtotime("{$year}-{$month}-00"));
        $canBeCurrent = true;
        
        // muuttujat kuukausien lisäämiseen ja poistamiseen ajaxin avulla
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
    
        echo '<table class="table reserveTimeElement" id="calendarTable" style="table-layout: fixed;">';
        echo '<tr> <th colspan="7" class="text-center">';
        if ($this->isFutureDate(new DateTime($year . '-' . $month))) {
    	    echo '<span class="glyphicon glyphicon-chevron-left nuoli" id="subMonth" onclick="calendarLeft(this)" data-date="' . $last_month->format('Y-m-d') . '" style="float: left;"></span>';
        }    
    	echo $title . ' ' . $year . '<span class="glyphicon glyphicon-chevron-right nuoli" id="addMonth" data-date="' . $next_month->format('Y-m-d') . '" onclick="calendarRight(this)" style="float: right;"></span></th>
    		  </tr>';
        echo '<tr>';
        
        // tulosta viikonpäivien nimet
    	foreach($weekDays as $key => $weekDay) {
    	    echo '<td class="text-center">' . $weekDay . '</td>';
    	}
        echo '</tr>
              <tr>';
              
        // tulosta ylimääräiset päivät kk alusta
    	for($i = 0; $i < $extradays; $i++) {
    	    if (!($this->isFutureDate(new DateTime($year . '-' . $month)))) {
    		    echo '<td class="passedDay"></td>';
    	    } else {
    	        echo '<td></td>';
    	    }    
    	}
    	
    	//tulosta päivät
    	for($i = 1; $i <= $daysInMonth; $i++) {
    		if($day == $i && $canBeCurrent) {
    		    if ($this->amountOfTimes($year . '-' . $month . '-' . $i) >= 1) {
    			    echo '<td onclick="getTimes(this)" value="' . $year . '-' . $month . '-' . $i . '" class="text-center canHover" data-toggle="tooltip" title="Tälle päivälle on ' . $this->amountOfTimes($year . '-' . $month . '-' . $i) . ' vapaata aikaa."><strong>' . $i . '</strong></td>';
    		    } else {
    		        echo '<td value="' . $year . '-' . $month . '-' . $i . '" class="text-center"><strong>' . $i . '</strong></td>';
    		    }
    		} else if (!($this->isFutureDate(new DateTime($year . '-' . $month . '-' . $i)))) {
    		    echo '<td class="text-center passedDay">' . $i . '</td>';
    		} else if ($this->amountOfTimes($year . '-' . $month . '-' . $i) >= 1) {
    		    echo '<td onclick="getTimes(this)" value="' . $year . '-' . $month . '-' . $i . '" class="text-center canHover" data-toggle="tooltip" title="Tälle päivälle on ' . $this->amountOfTimes($year . '-' . $month . '-' . $i) . ' vapaata aikaa.">' . $i . '</td>';
    		} else if ($this->amountOfTimes($year . '-' . $month . '-' . $i) < 1) {
    		    echo '<td class="text-center noTimes">' . $i . '</td>';
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
              
        echo '<script>
                    $("[data-toggle=\'tooltip\']").tooltip({
                        container: \'body\'
                    });
             </script>';
    } 
    
    // EI KÄYTÖSSÄ
    private function checkMonth() {
        if (date('Y-m', $this->classDate->getTimestamp()) == date('Y-m')) {
            $this->classDate = new DateTime(date('Y-m-d'));
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
    
} ?>
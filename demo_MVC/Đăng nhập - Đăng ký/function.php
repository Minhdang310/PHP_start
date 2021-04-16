<?php
function validateDateTime($date) {
    //Kiểm tra định dạng tháng xem có đúng dd/mm/YYYY chưa
    preg_match('/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/', $date, $matches);
    if (count($matches) == 0){
        //Nếu không đúng định dạng thì $match= array(); rỗng;
        return false;
    }
    $separateDate = explode('-',$date);
    $day = (int) $separateDate[0];
    $month = (int) $separateDate[1];
    $year = (int) $separateDate[2];
    // nếu là tháng 2
    if ($month == 2){
        if ($year % 4 == 0){
            if($day > 29){
                return false;
            }
        }else{
            if ($day > 28){
                return false;
            }
        }
    }
    //check các tháng khác
    switch($month){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            if($day>31){
                return false;
            }
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            if($day>30){
                return false;
            }           
            break;     
    }
    return true;
}
?>
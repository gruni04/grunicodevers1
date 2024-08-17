<?php

return [
    'site_name'=>'AEPL',
    // "GOOGLE_MAPS_API_KEY1"=>"AIzaSyBDmxTIHn07_lGOcXb0Ljv0GHvRPUnyMhg",
    "GOOGLE_MAPS_API_KEY"=>"AIzaSyCU61RhrRW5gigoMJypwx_LqoIavDBOEz4",
    'PER_PAGE'=>12,
    "PaymentMethod"=>[1=>"COD", 2=>"Online Stripe"],
    "Status"=>[1=>"Active", 2=>"Inactive"],
    "Attendance_Status"=>[1=>"Present", 2=>"Absent", 3=>"Half Day"],
    "EmpPosition"=>[1=>"None", 2=>"Manager", 3=>"Team Leader"],
    "LeaveStatus"=>[1=>"Pending", 2=>"Approved", 3=>"Declined"],
    "ProductRequestStatus"=>[1=>"Pending", 2=>"Approved", 3=>"Declined"],
    "FundRequestStatus"=>[1=>"Pending", 2=>"Approved", 3=>"Declined"],
    
    "FullHours"=>["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
    "QuatreMinuts"=>["00", "15","30","45","59"],
    "FullMinuts"=>["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"],
    "ClientResponseTaskStatus"=>[1=>"Approved", 2=>"Disapproved", 3=>"Pending"],
    "ClientResponseTaskGrade"=>[1=>"A++", 2=>"A", 3=>"B", 4=>"C"],
    
];

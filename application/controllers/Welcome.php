<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
        function __construct(){
            parent::__construct(); 
            $this->load->model('timetable');
        }
        
	public function index()
	{
            $schedule = array(); 
            
            //shows the booking in terms of the days available 
            $daysResult = $this->timetable->getDay();
            $viewFragmentsDays = ''; 
            
            foreach ($daysResult as $dayItem){
                $viewFragmentsDays = $this->parser->parse('scheduleTemplate',$dayItem);
            }
            $schedule['days'] = $viewFragmentsDays; 
            //*****end of days booking*****
            
            //shows the bookings  timeslots available
            $tsResult = $this->timetable->getTimeslot(); 
            $viewFragmentTS = '';
            
            foreach ($tsResult as $timeslotItem){
                $viewFragmentTS = $this->parser->parse('scheduletemplate',$timeslotItem); 
            }
            $schedule['timeslots'] = $viewFragmentTS;
            //*****end of timeslots booking*****
            
            //shows the courses available
            $courseResult = $this->timetable->getCourse(); 
            $viewFragmentCourse = '';
            
            foreach ($courseResult as $courseItem){
                $viewFragmentCourse = $this->parser->parse('scheduletemplate',$courseItem); 
            }
            $schedule['courses'] = $viewFragmentCourse;
            //*****end of courses booking*****
            
            
            
	}
}

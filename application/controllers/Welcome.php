<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
        function __construct(){
            parent::__construct(); 
            $this->load->model('timetable');
            $this->load->view('');
        }
        
        //function index displays all the facets on the page
        //1. course 2. days 3. timeslot
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
                $viewFragmentTS = $this->parser->parse('scheduleTemplate',$timeslotItem); 
            }
            $schedule['timeslots'] = $viewFragmentTS;
            //*****end of timeslots booking*****
            
            //shows the courses available
            $courseResult = $this->timetable->getCourse(); 
            $viewFragmentCourse = '';
            
            foreach ($courseResult as $courseItem){
                $viewFragmentCourse = $this->parser->parse('scheduleTemplate',$courseItem); 
            }
            $schedule['courses'] = $viewFragmentCourse;
            //*****end of courses booking*****
            
            //displays the days into an array (dropdown list)
            $dayDropdownItem = array(); 
            foreach($this->timetable->getDayDropdown() as $dayOption => $day){
                //this fills the array with a common key identifier and the value that is assigned to it
                //this is like connecting to a db with JSON and assigning it to an object
                $dayDropdownItem[] = array('key' => $day, 'value' => $day); 
            }
            $schedule['dayOption'] = $dayDropdownItem; 
            //*****end of days dropdown*****
            
            //displays the timeslots into an array (timeslots list)
            $timeslotDropdownItem = array(); 
            foreach($this->timetable->getTimeslotDropdown() as $timeOption => $timeslot){
                //this fills the array with a common key identifier and the value that is assigned to it
                //this is like connecting to a db with JSON and assigning it to an object
                $timeslotDropdownItem[] = array('key' => $timeslot, 'value' => $timeslot); 
            }
            $schedule['timeslotOption'] = $timeslotDropdownItem; 
            //*****end of timeslot dropdown*****
            
            
            //parses the items in the schedule array and displays them in the view
            $this->parser->parse('scheduleTemplate', $schedule);
            
	}
}

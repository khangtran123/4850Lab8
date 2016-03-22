<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Timetable extends CI_Model {

    protected $xml = null;
    protected $timeslots = array();
    protected $courses = array();
    protected $days = array();

// Constructor
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'master.xml');

        //list full of timeslot
        foreach ($this->xml->timeslots->timeslot as $timeslot) {
            $time = (string) $timeslot['startTime'];
            foreach ($timeslot->booking as $booking) {
                //Calls on Booking class
                $record = new Booking();
                $record->courseID = (string) $booking['courseID'];
                $record->weekDay = (string) $booking['weekDay'];
                $record->startTime = $time;
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classActivity'];
                $record->classLocation = (string) $booking['classLocation'];
                $this->timeslots[] = $record;
            }
        }

        //list full of courses
        foreach ($this->xml->courses->course as $course) {
            $courseNum = (string) $course['courseID'];
            foreach ($course->booking as $booking) {
                //Calls on Booking class
                $record = new Booking();
                $record->courseID = $courseNum;
                $record->weekDay = (string) $booking['weekDay'];
                $record->startTime = (string) $booking['startTime'];
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classActivity'];
                $record->classLocation = (string) $booking['classLocation'];
                $this->courses[] = $record;
            }
        }

        //list fill of days
        foreach ($this->xml->days->day as $day) {
            $scheduledDay = (string) $day['weekDay'];
            foreach ($day->booking as $booking) {
                //Calls on Booking class
                $record = new Booking();
                $record->courseID = (string) $booking['courseID'];
                $record->weekDay = $scheduledDay;
                $record->startTime = (string) $booking['startTime'];
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classActivity'];
                $record->classLocation = (string) $booking['classLocation'];
                $this->days[] = $record;
            }
        }
    }

    public function getTimeslot() {
        return $this->timeslots;
    }

    public function getCourse() {
        return $this->courses;
    }

    public function getDay() {
        return $this->days;
    }

}

class Booking {

    public $courseID;
    public $weekDay;
    public $startTime;
    public $endTime;
    public $instructor;
    public $classActivity;
    public $classLocation;

    public function __construct() {
        
    }

}

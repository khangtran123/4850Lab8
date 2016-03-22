<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Timetable extends CI_Model {

    protected $xml = null;
    protected $timeslot_slot = array();
    protected $timeslots = array();
    protected $courses = array();
    protected $days = array();

// Constructor
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'master.xml');

        //list full of timeslot
        foreach ($this->xml->timeslots->timeslot as $timeslot) {
            $timeslotTime = (string) $timeslot = ['time'];
            foreach ($timeslot->booking as $booking) {
                $record = new Booking();
                $record->timeslot = $timeslotTime;
                $record->courseName = (string) $booking['courseName'];
                $record->day = (string) $booking['day'];
                $record->startTime = (string) $booking['startTime'];
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classAction'];
                $record->classLocation = (string) $booking['classLocation'];
                $this->timeslots[] = $record;
            }
        }

        //list full of courses
        foreach ($this->xml->courses->course as $course) {
            $courseNum = (string) $course = ['courseID'];
            foreach ($course->booking as $booking) {
                $record = new Booking();
                $record->course = $courseNum;
                $record->courseName = (string) $booking['courseName'];
                $record->day = (string) $booking['day'];
                $record->startTime = (string) $booking['startTime'];
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classAction'];
                $record->classLocation = (string) $booking['classLocation'];
                $this->courses[] = $record;
            }
        }

        //list fill of days
        foreach ($this->xml->days->day as $day) {
            $scheduleDay = (string) $course = ['daySchedule'];
            foreach ($day->booking as $booking) {
                $record = new Booking();
                $record->day = $scheduleDay;
                $record->courseName = (string) $booking['courseName'];
                $record->weekDay = (string) $booking['day'];
                $record->startTime = (string) $booking['startTime'];
                $record->endTime = (string) $booking['endTime'];
                $record->instructor = (string) $booking['instructor'];
                $record->classActivity = (string) $booking['classAction'];
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

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Winter 2016 Class Schedule</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/></meta>
    </head>
    <body>
        <div>
            <div>
                <h1>Look up Your Schedule</h1>
                <form name="searchSchedule">
                    <select name="daysDropdown">
                    {dayOption}
                    <option value="{key}">{value}</option>
                    {/dayOption}
                    </select>
                    <select name="timeslotDropdown">
                            {timeslotOption}
                            <option value="{key}">{value}</option>
                            {/timeslotOption}
                    </select>
                    <input type='submit' value='Submit'>
                </form>
            </div>
            <div>
                <h1>Days Facet</h1>
                {days}
                <h1>Timeslot Facet</h1>
                {timeslots}
                <h1>Course Facet</h1>
                {courses}
            </div>
        </div>
    </body>
</html>

<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class GoogleCalendarController extends Controller
{
    //
    protected $calendarService;

    public function __construct(GoogleCalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function redirectToGoogle(){
        return redirect($this->calendarService->getAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $accessToken = $this->calendarService->handleCallback($request->input('code'));
        return redirect('/')->with('success', 'Google Calendar connected successfully!');
    }

    public function listEvents(){
        $calendarService = $this->calendarService->getCalendarService();
        $events = $calendarService->events->listEvents(config('services.google.calendar_id'));
        return view('calendar.events', compact('events'));
    }

    public function getEvents(){
        if (!session()->has('google_access_token')) {
            \Log::info('No google_access_token in session');
            return [];
        }

        try {
            $calendarService = $this->calendarService->getCalendarService();
            
            // First, let's list all available calendars
            \Log::info('Fetching calendar list');
            $calendarList = $calendarService->calendarList->listCalendarList();
            foreach ($calendarList->getItems() as $calendar) {
                \Log::info('Found calendar: ' . $calendar->getSummary() . ' (ID: ' . $calendar->getId() . ')');
            }
            
            // Try to get events from primary calendar
            \Log::info('Fetching events from primary calendar');
            $events = $calendarService->events->listEvents('primary', [
                'maxResults' => 10,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'),
                'timeZone' => 'America/Costa_Rica'
            ]);
            
            $items = $events->getItems();
            \Log::info('Retrieved ' . count($items) . ' events from primary calendar');
            
            if (!empty($items)) {
                foreach ($items as $event) {
                    $start = $event->getStart()->getDateTime() ?: $event->getStart()->getDate();
                    $end = $event->getEnd()->getDateTime() ?: $event->getEnd()->getDate();
                    \Log::info('Event found: ' . $event->getSummary() . ' from ' . $start . ' to ' . $end);
                }
            } else {
                \Log::info('No events found in primary calendar');
            }
            
            return $items;
        } catch (\Exception $e) {
            \Log::error('Error getting events: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->forget('google_access_token');
            return [];
        }
    }

    public function createEvent(Request $request){
        $calendarService = $this->calendarService->getCalendarService();
        $event = new \Google_Service_Calendar_Event([
            'summary' => $request->input('title'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'start' => [
                'dateTime' => $request->input('start_date'),
                'timeZone' => 'America/Costa_Rica',
            ],
            'end' => [
                'dateTime' => $request->input('end_date'),
                'timeZone' => 'America/Costa_Rica',
            ],
        ]);

        $createdEvent = $calendarService->events->insert(
            config('services.google.calendar_id'), $event
        );

        return redirect()->back()->with('success', 'Event created successfully!');
    }
}

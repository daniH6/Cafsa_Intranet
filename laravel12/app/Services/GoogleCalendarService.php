<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    protected $client;
    
    public function __construct()
    {
        $this->client = new Google_Client();
        
        // Load credentials from file
        $credentialsPath = base_path('client_secret_337553336832-oqst5tvgk5h1fpv4n5t1j70agas4jaba.apps.googleusercontent.com.json');
        if (file_exists($credentialsPath)) {
            $this->client->setAuthConfig($credentialsPath);
            \Log::info('Loaded credentials from file');
        } else {
            \Log::error('Credentials file not found');
            // Fallback to .env configuration
            $this->client->setClientId(config('services.google.client_id'));
            $this->client->setClientSecret(config('services.google.client_secret'));
        }
        
        $this->client->setRedirectUri(config('services.google.redirect_uri'));
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        $this->client->setIncludeGrantedScopes(true);
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
        $this->client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function handleCallback($code)
    {
        try {
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);
            \Log::info('Received access token:', ['token' => $accessToken]);
            
            if (isset($accessToken['error'])) {
                \Log::error('Error in access token:', ['error' => $accessToken['error']]);
                throw new \Exception($accessToken['error']);
            }
            
            session()->put('google_access_token', $accessToken);
            return $accessToken;
        } catch (\Exception $e) {
            \Log::error('Error in handleCallback: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getCalendarService()
    {
        try {
            $accessToken = session()->get('google_access_token');
            \Log::info('Current access token:', ['token' => $accessToken]);
            
            if ($this->client->isAccessTokenExpired()) {
                \Log::info('Token is expired');
                if (isset($accessToken['refresh_token'])) {
                    \Log::info('Attempting to refresh token');
                    $this->client->fetchAccessTokenWithRefreshToken($accessToken['refresh_token']);
                    $newAccessToken = $this->client->getAccessToken();
                    session()->put('google_access_token', $newAccessToken);
                    $accessToken = $newAccessToken;
                    \Log::info('Token refreshed successfully');
                } else {
                    \Log::error('No refresh token available');
                    session()->forget('google_access_token');
                    throw new \Exception('Token expired and no refresh token available');
                }
            }
            
            $this->client->setAccessToken($accessToken);
            return new Google_Service_Calendar($this->client);
        } catch (\Exception $e) {
            \Log::error('Error in getCalendarService: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

}
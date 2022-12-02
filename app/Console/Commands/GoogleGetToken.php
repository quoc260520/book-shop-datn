<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GoogleGetToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:get-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = $this->getClient(); 
        $credentialsPath = config('google-api.token_path'); 
        if (file_exists($credentialsPath)
            && !$this->confirm('Token is ready to use! Do you want to retrieve the token?')
        ) {
            return $this->info('Old token still held!');
        }
        $this->runGetToken($client, $credentialsPath);
    }

    private function getClient()
    {
        $client = new \Google_Client(); 
        $client->setApplicationName('book-shop-drive');
        
        $client->setScopes([
            \Google_Service_Drive::DRIVE,
        ]);
        $client->setAuthConfig(config('google-api.client_path')); 
        $client->setAccessType('offline'); 

        return $client;
    }
    private function runGetToken(\Google_Client $client, $credentialsPath)
    {
        $this->info("Open the following link in your browser:");
        $this->comment($client->createAuthUrl());
        $authCode = trim($this->ask('Enter verification code'));

        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        if (array_key_exists('error', $accessToken)) {
            throw new \Exception(join(', ', $accessToken));
        }

        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0777, true);
        }
            file_put_contents($credentialsPath, json_encode($accessToken));
            $this->info("Credentials saved to {$credentialsPath}!", $credentialsPath);
        }
}

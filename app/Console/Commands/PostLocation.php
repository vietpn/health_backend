<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PostLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post-location:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật location';

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
     * @return mixed
     */
    public function handle()
    {
        
        $posts = Post::where('is_deleted', NOT_DELETE)
            ->orderBy('id', SORT_DESC)->get();
        $bar = $this->output->createProgressBar($posts->count());
        foreach ($posts as $item){
            $this->info("\nInsert to Els: " . $item->id);
            $localtionString = $this->getAddress((double)$item->longitude, (double)$item->latitude);
            if(!is_null($localtionString)){
                $item->location_string = $localtionString;
                $item->save();
            }
            $bar->advance();
        }
        $bar->finish();
    }
    public function getAddress($long,$lat){
        $curl = new \Curl\Curl();
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true';
        $response = $curl->get($url);
        $rep = json_decode($response->response)->results;
        return isset($rep[0]) ? ($rep[0]->formatted_address) : "";
    }
}

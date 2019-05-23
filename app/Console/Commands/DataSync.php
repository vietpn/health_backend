<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Elasticsearch;

class DataSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-sync:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data from Mysql to Elasticsearch';

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
        $client = Elasticsearch\ClientBuilder::create()->build();
        $mappingsDelete = ['index' => 'profile_index'];
        //$client->indices()->delete($mappingsDelete);
        if (!$client->indices()->exists($mappingsDelete)) {
            $params = [
                'index' => 'profile_index',
                'body' => [
                    'mappings' => [
                        'profile' => [
//                        '_source' => [
//                            'enabled' => true
//                        ],
                            'properties' => [
                                'name' => [
                                    'type' => 'string',
                                ],
                                'gender' => [
                                    'type' => 'integer'
                                ],
                                'birth_year' => [
                                    'type' => 'integer'
                                ],
                                'img' => [
                                    'type' => 'string',
                                ],
                                'avatar_path' => [
                                    'type' => 'string'
                                ],
                                'location' => [
                                    'doc_values' => true,
                                    'type' => 'geo_point'
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            //add mapping
            $response = $client->indices()->create($params);
        }
        //get all profile in 3p
        $start = date('Y-m-d H:i:s', strtotime('-3 minutes '));
        $end = date('Y-m-d H:i:s');
        $profiles = User::where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('id', SORT_DESC)->get();
        try {
            if ($profiles) {
                $bar = $this->output->createProgressBar($profiles->count());
                foreach ($profiles as $indexed) {
                    $this->info("\nInsert to Els: " . $indexed->id);
                    $item = [];
                    $item['id'] = $indexed->id;
                    $item['name'] = $indexed->name;
                    $item['is_business'] = (int)$indexed->is_business;
                    $item['current_location'] = $indexed->location;
                    $item['online_status'] = $indexed->online_status;
                    $item['avatar_path'] = $indexed->avatar_path;
                    $item['img'] = $indexed->img;
                    $item['created_at'] = $indexed->created_at;
                    $item['updated_at'] = $indexed->updated_at;
                    if ($indexed->is_business == PROFILE_DEFAULT) {

                        $item['gender'] = isset($indexed->getProfileUsers->gender) ? (int)$indexed->getProfileUsers->gender : "";
                        $item['birth_year'] = (int)isset($indexed->getProfileUsers->birth_year) ? (int)$indexed->getProfileUsers->birth_year : "";
                    } elseif ($indexed->is_business == PROFILE_BUSSINESS) {
                        $item['gender'] = "";
                        $item['birth_year'] = "";
                    }

                    $item['location'] = [
                        'lat' => (double)$indexed->latitude,
                        'lon' => (double)$indexed->longitude,
                    ];
                    $params = [];
                    $params['body'] = $item;
                    $params['index'] = 'profile_index';
                    $params['type'] = 'profile';
                    $params['id'] = $indexed->id;
                    $client->index($params);
                    $bar->advance();
                }
                $bar->finish();
            } else {
                $this->info("\nKhong co ban ghi de update!");
            }

            $this->info("\ndone!");
        } catch (\Exception $e) {
            $this->info($e->getMessage());
        }

    }
}

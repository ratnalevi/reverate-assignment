<?php

namespace App\Console\Commands;

use App\Models\Addresses;
use App\Models\Company;
use App\Models\Coordinates;
use App\Models\MyUsers;
use App\Models\Posts;
use Illuminate\Console\Command;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To sync data';

    public function getCurlData($url) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            die('Unable to fetch data');
        }

        return $response;
    }

    public function syncUsers() {
        $url = "https://jsonplaceholder.typicode.com/users";

        $users = $this->getCurlData($url);
        $users = json_decode($users, true);

        foreach( $users as $user ) {
            // we are not saving id because it is auto generated
            $userModel = new MyUsers();
            $userModel->name = $user['name'];
            $userModel->username = $user['username'];
            $userModel->email = $user['email'];
            $userModel->phone = $user['phone'];
            $userModel->website = $user['website'];
            $userModel->save();

            $address = new Addresses();
            $address->street = $user['address']['street'];
            $address->city = $user['address']['city'];
            $address->suite = $user['address']['suite'];
            $address->zip = $user['address']['zipcode'];
            $address->my_users_id = $userModel->id;
            $address->save();

            $geo = new Coordinates();
            $geo->lat = $user['address']['geo']['lat'];
            $geo->long = $user['address']['geo']['lng'];
            $geo->addresses_id = $address->id;
            $geo->save();

            $company = new Company();
            $company->name = $user['company']['name'];
            $company->catchPhrase = $user['company']['catchPhrase'];
            $company->bs = $user['company']['bs'];
            $company->my_users_id = $userModel->id;
            $company->save();            
        }
    }

    public function syncPosts() {
        $url = "https://jsonplaceholder.typicode.com/posts";

        $posts = $this->getCurlData($url);
        $posts = json_decode($posts, true);

        foreach( $posts as $post ) {
            // we are not saving id because it is auto generated
            $postModel = new Posts();
            $postModel->userId = $post['userId'];
            $postModel->title = $post['title'];
            $postModel->body = $post['body'];

            $postModel->save();
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->syncUsers();
        $this->syncPosts();
    }
}

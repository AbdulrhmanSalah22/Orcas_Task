<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class getUsersLists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getUsers:List';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Users Lists From End Points And Save To Database';

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
      $res1 =  Http::get('https://60e1b5fc5a5596001730f1d6.mockapi.io/api/v1/users/users_1');

      $res2 = Http::get('https://60e1b5fc5a5596001730f1d6.mockapi.io/api/v1/users/user_2');

      if ($res1->successful()){
        $users1 =  $res1->object();
        foreach ($users1 as $user1){
            DB::insert('insert into users (firstName ,lastName ,email ,avatar) values (?,?,?,?)',[
                $user1->firstName , $user1->lastName , $user1->email , $user1->avatar
            ]);
        }
      }
      if ($res2->successful()){
          $users2 =  $res2->object();
          foreach ($users2 as $user2){
              DB::insert('insert into users (firstName ,lastName ,email ,avatar) values (?,?,?,?)',[
                  $user2->fName , $user2->lName , $user2->email , $user2->picture
              ]);
        }
      }
      return true ;
    }
}

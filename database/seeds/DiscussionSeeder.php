<?php
use App\Discussion;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $t1 = 'discussion dummy data 1 laravel laravel';
        $t2 = 'discussion dummy data 2 laravel laravel';
        $t3 = 'discussion dummy data 3 laravel laravel';
        $t4 = 'discussion dummy data 4 laravel laravel';
        $d1 =[
            'title'=>$t1,
            'content'=>'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
            'channel_id'=>1,
            'user_id'=>1,
            'slug'=>str_slug($t1)
        ];
        $d2 =[
            'title'=>$t2,
            'content'=>'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
            'channel_id'=>2,
            'user_id'=>2,
            'slug'=>str_slug($t2)
        ];
        $d3 =[
            'title'=>$t3,
            'content'=>'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
            'channel_id'=>3,
            'user_id'=>1,
            'slug'=>str_slug($t3)
        ];
        $d4 =[
            'title'=>$t4,
            'content'=>'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
            'channel_id'=>4,
            'user_id'=>1,
            'slug'=>str_slug($t4)
        ];
        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);
    }
}

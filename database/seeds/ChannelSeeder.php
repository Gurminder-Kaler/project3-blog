<?php
use App\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $channel1=['title'=>'laravel5.2'];
        $channel2=['title'=>'laravel5.3'];
        $channel3=['title'=>'laravel5.4'];
        $channel4=['title'=>'laravel5.5'];
        $channel5=['title'=>'laravel5.6'];
        $channel6=['title'=>'laravel5.7'];
        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
    }
}

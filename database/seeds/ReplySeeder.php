<?php
use App\Reply;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $r1 =[
            'user_id'=>1,
            'discussion_id'=>1,
            'content'=>'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum',
        ];
        $r2 =[
            'user_id'=>1,
            'discussion_id'=>2,
            'content'=>'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum',
        ];
        $r3 =[
            'user_id'=>2,
            'discussion_id'=>3,
            'content'=>'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum',
        ];
        $r4 =[
            'user_id'=>4,
            'discussion_id'=>4,
            'content'=>'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum',
        ];
        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
    }
}

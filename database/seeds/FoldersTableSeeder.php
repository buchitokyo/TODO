<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //first メソッドでユーザーを一行だけ取得して、その ID を user_id の値に指定
        $user = DB::table('users')->first();
        $titles = ['仕事','旅行','プライベート'];

        foreach($titles as $title){
          DB::table('folders')-> insert([
            'title' => $title,
            'user_id' => $user->id, //追加 外部キーのところ
            //carbon::now()は、現在時刻の表示
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}

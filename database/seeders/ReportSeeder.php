<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*
    public function run()
    {
        $faker = \Faker\Factory::create();

        $dummyReports = [];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士山の麓での素敵な日々',
            'content' => '富士山の麓での日々を楽しんでいます。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '自然豊かな富士市でのリラックスタイム',
            'content' => '自然豊かな環境でのリラックスが最高です。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士市の美しい景色を楽しむ旅',
            'content' => '美しい景色に囲まれた富士市で過ごす贅沢な旅行。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '静岡県富士市の観光スポット巡り',
            'content' => '富士の歴史と自然に触れる旅の素晴らしい思い出。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士の自然に囲まれた日常',
            'content' => '観光スポットめぐりが楽しい静岡県富士市の旅。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士市での美味しいグルメ探し',
            'content' => '富士の自然に包まれた暮らしは心地よい。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '静岡の富士市でのアウトドア体験',
            'content' => '美味しいグルメを求めて富士市の食べ歩き中。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士の大自然と共に過ごす幸せなひととき',
            'content' => 'アウトドア好きにはたまらない富士市の自然体験。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '静岡県富士市の素敵な散歩コース',
            'content' => '大自然の中で幸せなひとときを過ごしています。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        $dummyReports[] = [
            'user_id' => 1,
            'title' => '富士の自然と歴史に触れる旅の記録',
            'content' => '素敵な散歩コースで富士市の魅力を発見。',
            'address' => '静岡県富士市',
            'lat' => $faker->randomFloat(2, 35.95, 35.99),
            'lng' => $faker->randomFloat(2, 137.81, 137.89),
            'tags' => [$faker->numberBetween(1, 2), $faker->numberBetween(3, 4)],
            'urls' => [
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh6ErsCMbdaxWNDI5KnQe3hwVRLXrRWmqzmMtPQLTAVclBn5PCkCGuBXGmFNovC7I1pFCVYb6PhLs0LK85zUA0JeUJB_jad416aRl7E0snf9pACrT3GNVRwQrb0uDbWt9sCV_nsxIpl33eCi8dlSpgsIUJXgS_Ho7y3vgAam2apeqV1C0KV2F1XzdVv2v52/s400/kodai_sacabambaspis.png',
                'https://1.bp.blogspot.com/-gMIBEQoekuM/X3hGBsP-HJI/AAAAAAABbm8/4Cu_Zwwi6YwN7RbjDMC1wb22JYGEOnztgCNcBGAsYHQ/s400/kodai_umisasori.png',
                'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLuW2xcJlrbLdQDiw-wTCsElgoQIvbaXRZ40pCZX9vxYuLh1W3njnzZ_SZddy3nVpXeTDZqdKX6rI-MQBECmDwL80RPHDA4d5_lBe89Z8YTbBw9LSlnkTYFbKFmLvObN6tMyyCx7kPVQiMVILHoqH-ze4DDH1n6tf6PIo06l_6w95xdmZ40m7X7Bzx9g/s400/rennai_kaeruka.png'
            ]
        ];
        // ダミーデータをデータベースに登録
        foreach ($dummyReports as $data) {
            $reportId = DB::table('reports')->insertGetId([
                'user_id' => 1, // ユーザーIDを適切な値に置き換える
                'title' => $data['title'],
                'content' => $data['content'],
                'address' => $data['address'],
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);

            // tagsテーブルに関連するレコードを登録
            foreach ($data['tags'] as $tagId) {
                DB::table('report_tag')->insert([
                    'report_id' => $reportId,
                    'tag_id' => $tagId,
                    'isExist' => true, // trueに設定
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
            }

            // imageurlsテーブルに関連するレコードを登録
            foreach ($data['urls'] as $url) {
                DB::table('imageurls')->insert([
                    'report_id' => $reportId,
                    'ImageUrl' => $url,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
            }
        }
    }*/
}
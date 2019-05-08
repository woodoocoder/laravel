<?php

use Illuminate\Database\Seeder;

use App\Model\User\SearchReason;

class UserSearchReasonSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            'Make new friends',
            'Chat',
            'Date',
            'Traveling',
        ];

        foreach ($items as $item) {
            $type = SearchReason::create([
                'name' => $item
            ]);
        }
    }
}

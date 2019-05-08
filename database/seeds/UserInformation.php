<?php

use Illuminate\Database\Seeder;


use App\Model\User\UserInfoType;
use App\Model\User\UserInfoOption;

class UserInformation extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            [
                'name' => 'Relationship',
                'key' => 'relationship',
                'items' => [
                    'I’d prefer not to say',
                    'I’m in a complicated relationship',
                    'Single',
                    'Taken',
                ]
            ],
            [
                'name' => 'Living',
                'key' => 'living',
                'items' => [
                    'I’d prefer not to say',
                    'By myself',
                    'Student dormitory',
                    'With parents',
                    'With partner',
                    'With roommate(s)',
                ]
            ],
            [
                'name' => 'Kids',
                'key' => 'children',
                'items' => [
                    'I’d prefer not to say',
                    'Grown up',
                    'Already have',
                    'No, never',
                    'Someday',
                ]
            ],
            [
                'name' => 'Smoking',
                'key' => 'smoking',
                'items' => [
                    'I’d prefer not to say',
                    'I’m a heavy smoker',
                    'I hate smoking',
                    'I don’t like it',
                    'I’m a social smoker',
                    'I smoke occasionally',
                ]
            ],
            [
                'name' => 'Drinking',
                'key' => 'drinking',
                'items' => [
                    'I’d prefer not to say',
                    'I drink socially',
                    'I don’t drink',
                    'I’m against drinking',
                    'I drink a lot',
                ]
            ],
        ];

        foreach ($items as $t) {
            $type = UserInfoType::create([
                'key' => $t['key'],
                'name' => $t['name']
            ]);

            foreach ($t['items'] as $item) {
                UserInfoOption::create([
                    'type_id' => $type->id,
                    'name' => $item
                ]);
            }
        }
    }
}

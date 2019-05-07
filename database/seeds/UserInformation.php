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
            'Relationship' => [
                'I’d prefer not to say',
                'I’m in a complicated relationship',
                'Single',
                'Taken',
            ],
            'Living' => [
                'I’d prefer not to say',
                'By myself',
                'Student dormitory',
                'With parents',
                'With partner',
                'With roommate(s)',
            ],
            'Kids' => [
                'I’d prefer not to say',
                'Grown up',
                'Already have',
                'No, never',
                'Someday',
            ],
            'Smoking' => [
                'I’d prefer not to say',
                'I’m a heavy smoker',
                'I hate smoking',
                'I don’t like it',
                'I’m a social smoker',
                'I smoke occasionally',
            ],
            'Drinking' => [
                'I’d prefer not to say',
                'I drink socially',
                'I don’t drink',
                'I’m against drinking',
                'I drink a lot',
            ],
        ];

        foreach ($items as $k=>$v) {
            $type = UserInfoType::create([
                'name' => $k
            ]);

            foreach ($v as $item) {
                UserInfoOption::create([
                    'type_id' => $type->id,
                    'name' => $item
                ]);
            }
        }
    }
}

<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use App\Model\User\Options;
use App\Model\User\Information;

use App\Http\Resources\UserResource;

class UserController extends Controller {

    public function update(UpdateRequest $request) {
        $user = $request->user();
        $data = $request->all();

        $item = User::with('options')->findOrFail($user->id);
        $item->update($data);
        
        if(isset($data['options'])) {
            if($item->options === null) {
                $item->options()->save(new Options($data['options']));
            }
            else {
                $item->options->update($data['options']);
            }
        }

        if(isset($data['information'])) {
            if($item->information === null) {
                $item->information()->save(new Information($data['information']));
            }
            else {
                $item->information->update($data['information']);
            }
        }

        return response([
            'status' => 'success',
            'data' => new UserResource(User::findOrFail($user->id))
        ]);
    }


    public function information(Request $request) {
        $user = $request->user();
        $data = $request->all();

        $item = User::with('information')->findOrFail($user->id);

        if(isset($data)) {
            if($item->information === null) {
                $item->information()->save(new Information($data));
            }
            else {
                $item->information->update($data);
            }
        }

        return response([
            'status' => 'success',
            'data' => new UserResource(User::findOrFail($user->id))
        ]);
    }
}
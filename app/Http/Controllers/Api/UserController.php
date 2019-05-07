<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use App\Model\User\Options;

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

        return response([
            'status' => 'success',
            'data' => new UserResource(User::findOrFail($user->id))
        ]);
    }
}
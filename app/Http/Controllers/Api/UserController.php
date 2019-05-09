<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use App\Model\User\Options;
use App\Model\User\Information;
use App\Model\User\Filter;

use App\Http\Resources\UserResource;

class UserController extends Controller {

    /**
     * @OA\Put(
     *     path="/api/user",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="User data updated",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     )
     * )
     */
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


    /**
     * @OA\Put(
     *     path="/api/user/information",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="User information updated",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     )
     * )
     */
    public function updateInformation(Request $request) {
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

    
    /**
     * @OA\Put(
     *     path="/api/user/filters",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="User search filters updated",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     )
     * )
     */
    public function updateFilters(Request $request) {
        $user = $request->user();
        $data = $request->all();

        $item = User::with('filters')->findOrFail($user->id);

        if(isset($data)) {
            if($item->filters === null) {
                $item->filters()->save(new Filter($data));
            }
            else {
                $item->filters->update($data);
            }
        }

        return response([
            'status' => 'success',
            'data' => new UserResource(User::findOrFail($user->id))
        ]);
    }
}
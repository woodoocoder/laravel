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
     * @OA\Get(
     *     path="/api/user",
     *     tags={"User"},
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="object",
     *                  allOf={
     *                      @OA\JsonContent(ref="#/components/schemas/User")
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(response=403,description="Unauthorized"),
     *     @OA\Response(response=500,description="Server error"),
     * )
     */
    public function user(Request $request) {
        return response([
            'status' => 'success',
            'data' => new UserResource($request->user())
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/user/show",
     *     tags={"User"},
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="object",
     *                  allOf={
     *                      @OA\JsonContent(ref="#/components/schemas/User")
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(response=403,description="Unauthorized"),
     *     @OA\Response(response=500,description="Server error"),
     * )
     */
    public function show(int $userId, Request $request) {
        return response([
            'status' => 'success',
            'data' => new UserResource(User::findOrFail($userId))
        ]);
    }


    /**
     * @OA\Put(
     *     path="/api/user",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="firstname",type="string"),
     *              @OA\Property(property="middlename",type="string"),
     *              @OA\Property(property="lastname",type="string"),
     *              @OA\Property(property="email",type="string",format="email")
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="object",
     *                  allOf={
     *                      @OA\JsonContent(ref="#/components/schemas/User")
     *                  }
     *              )
     *          )
     *     ),
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="relationship_id",type="integer"),
     *              @OA\Property(property="living_id",type="integer"),
     *              @OA\Property(property="children_id",type="integer"),
     *              @OA\Property(property="smoking_id",type="integer"),
     *              @OA\Property(property="drinking_id",type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="object",
     *                  allOf={
     *                      @OA\JsonContent(ref="#/components/schemas/User")
     *                  }
     *              )
     *          )
     *     ),
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="gender",type="string"),
     *              @OA\Property(property="age_from",type="integer"),
     *              @OA\Property(property="age_to",type="integer"),
     *              @OA\Property(property="city_id",type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="object",
     *                  allOf={
     *                      @OA\JsonContent(ref="#/components/schemas/User")
     *                  }
     *              )
     *          )
     *     ),
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
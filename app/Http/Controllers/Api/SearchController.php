<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

use App\Http\Resources\UserResource;

class SearchController extends Controller {

    /**
     * @OA\Get(
     *     path="/api/dating",
     *     tags={"Users"},
     *     @OA\Response(
     *          response=200,
     *          description="Users list",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", format="string", type="string"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(ref="#/components/schemas/User")
     *              )
     *          )
     *     ),
     *     @OA\Response(response=403,description="Unauthorized"),
     *     @OA\Response(response=500,description="Server error"),
     * )
     */
    public function dating(Request $request) {
        $user = $request->user();

        
        $query = User::whereHas('options', function ($query) use ($user) {
            if($user->filters && $user->filters->gender) {
                $query->where('gender', '=', $user->filters->gender);
            }
        });
        
        $list = $query->orderBy('id', 'desc')->paginate(10);

        return response([
            'status' => 'success',
            'data' => UserResource::collection($list)
        ]);
    }


}
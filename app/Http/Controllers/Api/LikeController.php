<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\User\Like;
use App\Http\Resources\UserResource;
use App\Http\Resources\User\LikeResource;
use App\Events\Like\NewLike;
use App\Events\Like\NewMatchedLike;

class LikeController extends Controller {


    /**
     * @OA\Get(
     *     path="/api/user/likes",
     *     tags={"Users"},
     *     @OA\Response(
     *          response=200,
     *          description="Users who sent likes",
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
    public function likes(Request $request) {
        $user = $request->user();
        
        $likes = Like::where('user_id_to', $user->id)
                ->orderBy('updated_at', 'desc')->paginate(10);

        $likes->transform(function (Like $like) use ($user) {
            $like->user = ($like->user_from->id != $user->id)? $like->user_from: $like->user_to;
            return $like;
        });
        
        return response([
            'status' => 'success',
            'data' => LikeResource::collection($likes),
        ]);
    }
    
    /**
     * @OA\Get(
     *     path="/api/user/likes/matched",
     *     tags={"Users"},
     *     @OA\Response(
     *          response=200,
     *          description="Matched likes",
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
    public function matched(Request $request) {
        $user = $request->user();

        $likes = Like::where(function($q) use ($user) {
            $q->where('user_id_from', $user->id);
            $q->whereIn('user_id_to', function($q) use ($user) {
                $q->select('likes.user_id_from');
                $q->from('likes');
                $q->where('user_id_to', $user->id);
            });
        })
        ->orderBy('updated_at', 'desc')->paginate(10);

        $likes->transform(function (Like $like) use ($user) {
            $like->user = $like->user_to;
            return $like;
        });

        return response([
            'status' => 'success',
            'data' => LikeResource::collection($likes),
        ]);
    }
    

    /**
     * @OA\Post(
     *     path="/api/user/likes",
     *     tags={"Users"},
     *     @OA\Response(
     *          response=200,
     *          description="Send like",
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
    public function store(Request $request, int $userId) {
        $user = $request->user();

        $like = Like::where([
                'user_id_from' => $user->id,
                'user_id_to' => $userId
            ])->first();

        if(!$like) {
            Like::create([
                'user_id_from' => $user->id,
                'user_id_to' => $userId
            ]);
            broadcast(new NewLike($userId, new UserResource($user)));
        }
        
        $likedYou = Like::where([
                'user_id_from' => $userId,
                'user_id_to' => $user->id
            ])->first();

        if($likedYou) {
            $userTo = User::find($userId);
            broadcast(new NewMatchedLike($userId, new UserResource($user)));
            broadcast(new NewMatchedLike($user->id, new UserResource($userTo)));
        }

        return response([
            'status' => 'success',
            'data' => new UserResource(User::find($userId))
        ]);
    }
    
}

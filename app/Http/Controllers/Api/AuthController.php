<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Avatar;
use Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignupRequest;
use App\Http\Requests\User\LoginRequest;
use App\User;
use App\Model\User\Options;

use App\Http\Resources\UserResource;

class AuthController extends Controller {

    /**
     * Create user
     *
     * @param  [string] firstname
     * @param  [string] middlename
     * @param  [string] lastname
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * 
     * @return [string] message
     */

    /**
     * @OA\Post(
     *     path="/api/auth/signup",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         description="Create user object",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="firstname",type="string"),
     *              @OA\Property(property="middlename",type="string"),
     *              @OA\Property(property="lastname",type="string"),
     *              @OA\Property(property="email",type="string",format="email"),
     *              @OA\Property(property="password",type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     )
     * )
     */
    public function signup(SignupRequest $request) {
        
        $user = new User([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();
        $user->options()->save(new Options([
            'gender' => $request->options['gender'],
            'birthday' => $request->options['birthday'],
            'city_id' => $request->options['city_id'],
        ]));

        $avatar = Avatar::create($request->firstname.' '.$request->lastname)
            ->getImageObject()->encode('png');
        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
        
        $user = User::find($user->id);

        return response()->json([
            'message' => 'Successfully created user!',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * 
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         description="Returns API token with given user email and password",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="email",type="string",format="email"),
     *              @OA\Property(property="password",type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User sign in",
     *         @OA\JsonContent(
     *              @OA\Property(property="access_token",type="string")
     *         ),
     *     )
     * )
     */
    public function login(LoginRequest $request) {

        $credentials = request(['email', 'password']);
        
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */

    /**
     * @OA\Get(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="User logout",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     )
     * )
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
}
<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\User\UserInfoType;
use App\Http\Resources\User\InfoTypeResource;

class InformationController extends Controller {

    public function index(Request $request) {

        return response([
            'status' => 'success',
            'data' => InfoTypeResource::collection(UserInfoType::get())
        ]);
    }
}

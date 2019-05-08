<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\User\UserInfoType;
use App\Http\Resources\User\InfoTypeResource;

use App\Model\User\SearchReason;
use App\Http\Resources\User\SearchReasonResource;

class DictionaryController extends Controller {

    public function information(Request $request) {

        return response([
            'status' => 'success',
            'data' => InfoTypeResource::collection(UserInfoType::get())
        ]);
    }

    public function reasons(Request $request) {

        return response([
            'status' => 'success',
            'data' => SearchReasonResource::collection(SearchReason::get())
        ]);
    }
}

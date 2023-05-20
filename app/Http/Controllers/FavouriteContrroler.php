<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteContrroler extends Controller
{
    public function favourite_(Request $request){
        $userId = Auth::id();
        $favourite_id = Favourite::where('post_id', $request->post_id)->where('user_id', $userId)->value('id');
        $favourite_value = Favourite::where('id', $favourite_id)->value('is_favourite');

        if ($favourite_id) {
            if ( $favourite_value == 1) {
                Favourite::find($favourite_id)->update([
                    'is_favourite'=> false,
                ]);
                return redirect()->back();
            }
            Favourite::find($favourite_id)->update([
                'is_favourite'=> true,
            ]);
            return redirect()->back();
        }
        Favourite::create([
            'is_favourite'=> true,
            'user_id'=>$userId,
            'post_id'=>$request->post_id,
        ]);
        return redirect()->back();
    }
}

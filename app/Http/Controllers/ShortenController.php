<?php

namespace App\Http\Controllers;

use App\Models\UrlMap;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShortenController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'long-url' => 'required|active_url',
        ]);
        $longUrl = $request->input('long-url');

        $urlMap = UrlMap::where('long_url', $longUrl)->first();
        if($urlMap){
            $shortUrl = route('index') . '/' . $urlMap->short_url;
            $longUrl = $urlMap->long_url;
        }else{
            do{
                $shortUrl = Str::random(6);
            }while(UrlMap::where('long_url', $longUrl)->exists());

            $urlMap = new UrlMap();
            $urlMap->fill(['long_url' => $longUrl, 'short_url' => $shortUrl]);
            $urlMap->save();

            $shortUrl = route('index') . '/' . $shortUrl;
        }
        if(55 < strlen($longUrl)){
            $longUrl = substr($longUrl, 0, 50) . ' ...(略)';
        }
        return view('shortened-url')->with(compact('shortUrl', 'longUrl'));
    }

    public function redirect(String $shortUrl){
        $urlMap = UrlMap::where('short_url', $shortUrl)->first();
        if($urlMap){
            return redirect($urlMap->long_url);
        }else{
            throw new NotFoundHttpException();
        }
    }
}

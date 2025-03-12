<?php

namespace App\Http\Controllers;

use App\Models\UrlMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function React\Promise\all;

class ShortenController extends Controller
{
    public function create(Request $request){
        $data = $request->all();

        if(isset($data['long-url'])){
            $data['long-url'] = preg_replace('/\/$/', '', $data['long-url']);
            if(!preg_match('/^https?:\/\//', $data['long-url'])){
                $data['long-url'] = 'https://' . $data['long-url'];
            }
        }
        $validator = Validator::make($data, [
            'long-url' => 'required|url|max:20000',
        ]);
        $validator->validate();

        $longUrl = $data['long-url'];

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

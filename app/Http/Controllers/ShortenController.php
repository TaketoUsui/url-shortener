<?php

namespace App\Http\Controllers;

use App\Models\UrlMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
            $shortUrl = $urlMap->short_url;
            $longUrl = $urlMap->long_url;
        }else{
            while(true){
                $shortUrl = Str::random(6);
                if(UrlMap::where('short_url', $shortUrl)->exists()){
                    continue;
                }else{
                    try{
                        $urlMap = new UrlMap();
                        $urlMap->fill(['long_url' => $longUrl, 'short_url' => $shortUrl]);
                        $urlMap->save();
                    }catch(\Exception $e){
                        continue;
                    }
                    break;
                }
            }
            $qr_image = QrCode::format('png')
                ->size(200)
                ->generate(route('redirect', $shortUrl));
            $qr_location = 'img/qr-code/img-' . $shortUrl . '.png';
            Storage::disk('local')->put($qr_location, $qr_image);
        }

        return redirect(route('show', $shortUrl));
    }

    public function show(Request $request, $shortUrl_id){
        $urlMap = UrlMap::where('short_url', $shortUrl_id)->first();
        $longUrl = $urlMap->long_url;

        $shortUrl = route('index') . '/' . $shortUrl_id;
        if(55 < strlen($longUrl)){
            $longUrl = substr($longUrl, 0, 50) . ' ...(略)';
        }

        return view('shortened-url')->with(compact('shortUrl', 'longUrl', 'shortUrl_id'));
    }

    public function getQRCode(Request $request, $shortUrl){
        $pathToFile = storage_path('app/private/img/qr-code/img-' . $shortUrl . '.png');
        $name = 'shortURL_' . $shortUrl . '.png';
        return response()->download($pathToFile, $name, []);
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

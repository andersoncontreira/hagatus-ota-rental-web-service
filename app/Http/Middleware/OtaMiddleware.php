<?php

namespace App\Http\Middleware;

use Closure;
use Hagatus\Ota\Http\Request\RequestParserService;


class OtaMiddleware
{

    public function handle($request)
    {
        /**
         * If uses the http basic authorization the
         */
        if($this->useHttpAuth()) {
            //dd($request->headers);
            // do something
        }

        /** @var RequestParserService $httpRequestParse */
        $httpRequestParse = app(RequestParserService::class);
        $otaMessageObject = $httpRequestParse->parse($request);

        $otaMessageObject->toXml();

        dd($otaMessageObject);
    }

//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \Closure  $next
//     * @return mixed
//     */
//    public function handle($request, Closure $next)
//    {
//
//        /**
//         * If uses the http basic authorization the
//         */
//        if($this->useHttpAuth()) {
//            //dd($request->headers);
//            // do something
//        }
//
////        $httpParse = new ParseService($request);
////        //HttpRequestParse($request);
////        dd($request->headers);
//        //if ($request)
////        /** @var RequestParserService $httpRequestParser */
////        $httpRequestParser = app(RequestParserService::class);
////        $item = $httpRequestParser->parse($request);
//
//        $httpParse = new RequestParserService($request);
//
//
//
//        return $next($request);
//    }

    private function useHttpAuth()
    {
        return false;
    }
}

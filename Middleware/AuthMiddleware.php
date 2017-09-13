<?php

class AuthMiddleware {



    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next) {
        global $handler, $apiConfig;
        $handler = new DrillHandler();

        $handler -> logger -> addInfo("path--->:".print_r($request->getUri()->getPath(),true));
        $response = $next($request, $response);

        return $response;
    }

    /**
     * This function will compare the provided url against the whitelist and
     * return wether the $url is public or not
     * 
     * @param string $url
     * @return bool
     */
    public function isPublicUrl($url) {
        $patterns_flattened = implode('|', $this->whiteList);
        $matches = null;
        preg_match('/' . $patterns_flattened . '/', $url, $matches);
        return (count($matches) > 0);
    }

    public function isOptionsMethod() {
        return ($_SERVER['REQUEST_METHOD'] == 'OPTIONS');
    }


}

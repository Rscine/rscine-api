<?php

namespace Rscine\OAuthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    /**
     * Returns all methods callable for /oauth/v2/token
     *
     * @param  Request $request
     * @return Response
     */
    public function tokenAction(Request $request)
    {
        return new Response(null, Response::HTTP_OK);
    }
}

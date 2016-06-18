<?php

namespace Rscine\UserBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * Acts as the client requesting a token to AuthorizationServer
     * @param  string $grantType
     * @param  string $username
     * @param  string $password
     * @return json
     */
    public function loginAction(Request $request)
    {
        $grantType = $request->request->get('grant_type');

        $client = $this->get('fos_oauth_server.client_manager.default')->findClientBy(array());

        return $this->redirect($this->generateUrl('fos_oauth_server_token', array(
            'client_id'     => $client->getPublicId(),
            'client_secret'  => $client->getSecret(),
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'grant_type' => $request->request->get('grant_type'),
        )));
    }

    /**
     * Récupère l'utilisateur courant
     *
     * @return [type] [description]
     */
    public function getCurrentUserAction()
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        return new JsonResponse($this->get('serializer')->toArray($currentUser), Response::HTTP_OK);
    }
}

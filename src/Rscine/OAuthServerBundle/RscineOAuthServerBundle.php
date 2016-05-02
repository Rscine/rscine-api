<?php

namespace Rscine\OAuthServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RscineOAuthServerBundle extends Bundle
{
    /**
     * @{inheritdoc}
     */
    public function getParent()
    {
        return 'FOSOAuthServerBundle';
    }
}

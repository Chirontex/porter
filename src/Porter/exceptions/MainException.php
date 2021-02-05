<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter\Exceptions;

use Exception;

class MainException extends Exception
{

    const INVALID_BASEDIR_CODE = -1;
    const INVALID_BASEDIR_MESSAGE = 'Invalid root directory.';

    const INVALID_DIST_CODE = -2;
    const INVALID_DIST_MESSAGE = 'Invalid distributive directory.';

    const INVALID_DEPLOY_CODE = -3;
    const INVALID_DEPLOY_MESSAGE = 'Invalid deploy directory.';

    const DIST_DEPLOY_EQUAL_CODE = -4;
    const DIST_DEPLOY_EQUAL_MESSAGE = 'Distributive and deploy directories cannot be equal.';

}

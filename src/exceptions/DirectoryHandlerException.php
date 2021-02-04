<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter\Exceptions;

use Exception;

class DirectoryHandlerException extends Exception
{

    const INVALID_SOURCE_CODE = -10;
    const INVALID_SOURCE_MESSAGE = 'Invalid source directory.';

    const INVALID_DESTINATION_CODE = -11;
    const INVALID_DESTINATION_MESSAGE = 'Invalid destination directory.';

}

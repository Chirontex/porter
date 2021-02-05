<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter\Exceptions;

use Exception;

class EntranceException extends Exception
{

    const SETTINGS_SAVING_FAILURE_CODE = -30;
    const SETTINGS_SAVING_FAILURE_MESSAGE = 'Settings saving failure.';

}

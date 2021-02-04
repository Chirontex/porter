<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter\Handlers;

use Infernusophiuchus\Porter\Exceptions\DirectoryHandlerException;

class DirectoryHandler
{

    protected $source;
    protected $destination;

    public function __construct(string $source, string $destination)
    {
        
        $source = (
            substr($source, -1) === '/' ||
            substr($source, -1) === '\\'
        ) ? substr($source, 0, -1) : $source;

        $destination = (
            substr($destination, -1) === '/' ||
            substr($destination, -1) === '\\'
        ) ? substr($destination, 0, -1) : $destination;

        if (is_dir($source)) $this->source = $source;
        else throw new DirectoryHandlerException(
            DirectoryHandlerException::INVALID_SOURCE_MESSAGE,
            DirectoryHandlerException::INVALID_SOURCE_CODE
        );

        if (is_dir($destination)) $this->destination = $destination;
        else throw new DirectoryHandlerException(
            DirectoryHandlerException::INVALID_DESTINATION_MESSAGE,
            DirectoryHandlerException::INVALID_DESTINATION_CODE
        );

    }

}

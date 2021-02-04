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

    /**
     * Copy all files and directories from source to destination directory.
     * 
     * @return array
     * 
     * @throws DirectoryHandlerException
     */
    public function copyAll() : array
    {

        $result = ['files' => [], 'dirs' => []];

        $dir = opendir($this->source);

        if (!$dir) throw new DirectoryHandlerException(
            DirectoryHandlerException::FALSE_OPENDIR_MESSAGE,
            DirectoryHandlerException::FALSE_OPENDIR_CODE
        );

        while (($entity = readdir($dir)) !== false) {

            if ($entity === '.' ||
                $entity === '..') continue;

            if (is_dir($this->source.'/'.$entity)) {

                if (!file_exists(
                    $this->destination.'/'.$entity
                )) mkdir($this->destination.'/'.$entity);

                $result['dirs'][] = $this->destination.'/'.$entity;

                $dh = new DirectoryHandler(
                    $this->source.'/'.$entity,
                    $this->destination.'/'.$entity
                );

                $copied = $dh->copyAll();

                $result['files'] = array_merge(
                    $result['files'],
                    $copied['files']
                );

                $result['dirs'] = array_merge(
                    $result['dirs'],
                    $copied['dirs']
                );

            } else {
                
                if (copy(
                    $this->source.'/'.$entity,
                    $this->destination.'/'.$entity
                )) $result['files'][] = $this->destination.'/'.$entity;
        
            }

        }

        closedir($dir);

        return $result;

    }

}

<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter\Handlers;

use Infernusophiuchus\Porter\Exceptions\CleanerException;

class Cleaner
{

    protected $deploy;

    public function __construct(string $deploy)
    {

        $deploy = (substr($deploy, 0, -1) === '/' ||
            substr($deploy, 0, -1) === '\\') ?
            substr($deploy, -1) : $deploy;
        
        if (!is_dir($deploy)) throw new CleanerException(
            CleanerException::INVALID_DEPLOY_MESSAGE,
            CleanerException::INVALID_DEPLOY_CODE
        );

        $this->deploy = $deploy;

    }

    /**
     * Removes deployed application files and directories.
     * 
     * @return void
     */
    public function removeDeploy() : void
    {

        if (file_exists($this->deploy.'/deployed.json')) {

            $deployed = json_decode(
                file_get_contents($this->deploy.'/deployed.json'),
                true
            );

            foreach ($deployed['files'] as $key => $value) {

                if (unlink($value)) unset($deployed['files'][$key]);

            }

            foreach ($deployed['dirs'] as $key => $value) {

                $scan = scandir($value);

                if (is_array($scan)) {

                    if (count($scan) > 2) unset($deployed['dirs'][$key]);
                    elseif (rmdir($value)) unset($deployed['dirs'][$key]);

                }

            }

            if (empty($deployed['files']) &&
                empty($deployed['dirs'])) unlink($this->deploy.'/deployed.json');

            echo "\nCleaning complete.\n";

        } else echo "\nNothing to cleaning: deployed.json not found.\n";

    }

}

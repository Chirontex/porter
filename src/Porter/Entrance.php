<?php
/**
 * Porter
 */
namespace Infernusophiuchus\Porter;

use Infernusophiuchus\Porter\Exceptions\MainException;
use Infernusophiuchus\Porter\Exceptions\EntranceException;

class Entrance extends Main
{

    protected $args;

    public function __construct(array $args)
    {

        $this->args = $args;

        if ($this->args[1] === 'set' ||
            $this->args[1] === 'help') $this->command($this->args[1]);
        else {
        
            if (file_exists(__DIR__.'/settings.json')) {

                $settings = json_decode(
                    file_get_contents(__DIR__.'/settings.json'),
                    true
                );

                try {

                    parent::__construct(
                        $settings['basedir'],
                        $settings['dist'],
                        $settings['deploy']
                    );

                    $this->command($this->args[1]);

                } catch (MainException $e) {

                    throw new EntranceException(
                        $e->getMessage(),
                        $e->getCode()
                    );

                }

            } else echo "\nSettings are not set. Use 'set' command first.\n";

        }

    }

    public function command(string $command): void
    {
        
        switch ($command) {

            case 'set':

                if (file_exists(
                    __DIR__.'/settings.json'
                )) $settings = json_decode(
                    file_get_contents(__DIR__.'/settings.json'),
                    true
                );
                else $settings = [
                    'basedir' => '',
                    'dist' => '',
                    'deploy' => '',
                    'tfi' => 1
                ];

                if ($this->args[2] === 'tfi') {
                    
                    $settings['tfi'] = (int)$this->args[3];

                    if ($settings['tfi'] > 0) $settings['tfi'] = 1;
                    else $settings['tfi'] = 0;
                
                } else {

                    $this->args[3] = (substr($this->args[3], -1) === '/' ||
                        substr($this->args[3], -1) === '\\') ?
                        substr($this->args[3], 0, -1) : $this->args[3];

                    $settings[$this->args[2]] = $this->args[3];

                }

                if (file_put_contents(
                    __DIR__.'/settings.json',
                    json_encode($settings)
                ) === false) throw new EntranceException(
                    EntranceException::SETTINGS_SAVING_FAILURE_MESSAGE,
                    EntranceException::SETTINGS_SAVING_FAILURE_CODE
                );

                echo "\nSettings saved.\n";

                break;

            case 'deploy':

                $settings = json_decode(
                    file_get_contents(__DIR__.'/settings.json'),
                    true
                );

                $this->deploy($settings['tfi'] === 1 ? true : false);

                break;

            case 'help':
                echo "\n";
                echo "deploy — Deploy the application.\n";
                echo "depclean — Delete previous deploy.\n";
                echo "set [setting] [value] — Sets the settings.\n";
                echo "    [setting] — name of the setting. Available settings:\n";
                echo "        basedir — Basic directory which contains dist and deploy directories.\n";
                echo "        If these directories locate in different directories,\n";
                echo "         set this to '/'.\n";
                echo "        dist — Distributive directory. If basedir was set, dist must be relative.\n";
                echo "        deploy — Deploy directory. If basedir was set, deploy must be relative.\n";
                echo "        tfi — Transform index.html in index.php or not.\n";
                echo "    [value] — Value of the setting.\n";
                echo "        'tfi' setting accepts only 0 or 1, others accepts the directories paths.\n";
                echo "help — View commands list.\n";
                break;

            default:
                parent::command($command);
                break;

        }

    }

}

<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/27/17
 * Time: 2:31 PM
 */

namespace app;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

class GameCommand extends Command
{
    protected function configure()
    {
        $this->setName('start')
            ->setDescription('Game of life' . PHP_EOL . '@Vestin https://github.com/Vestin' . PHP_EOL . 'see detail in https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life')
            ->setDefinition(new InputDefinition([
                new InputOption('pattern', 'p', InputOption::VALUE_REQUIRED,
                    'the pattern you defined, input file name of your pattern, patterns are json files under patterns folder; such as -p bliner','line'),
                new InputOption('deadcellcolor', null, InputOption::VALUE_OPTIONAL,
                    'set dead cell color, avaliable option: black, red, green, yellow, blue, magenta, cyan and white',
                    ''),
                new InputOption('alivecellcolor', null, InputOption::VALUE_OPTIONAL,
                    'set alive cell color, avaliable option: black, red, green, yellow, blue, magenta, cyan and white',
                    ''),
                new InputOption('speed', null, InputOption::VALUE_OPTIONAL,
                    'set generating speed, type int, 1000 equal 1 sec', 1000)
            ]));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // loading text
        $output->write('loading...');
        //set up screen
        $pattern = Pattern::getByName($input->getOption('pattern'));
        $director = \app\spirits\Director::setUpScreen($pattern, $output);
        $director->setCanvasColor($input->getOption('deadcellcolor'), $input->getOption('alivecellcolor'));
        $output->write("\033[2J");
        $director->draw();
        while (1) {
            usleep($input->getOption('speed') * 1000);
            $director->generating();
            $director->draw();
        }
    }

}
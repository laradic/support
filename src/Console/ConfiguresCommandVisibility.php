<?php


namespace Laradic\Support\Console;


use Symfony\Component\Console\Application;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/** @mixin \Illuminate\Console\Application */
trait ConfiguresCommandVisibility
{
    abstract protected function configureVisibility(CommandsVisibility $visibility);

    private $addedCommandVisibility = false;
    private $hiddenCommands;
    protected function addCommandVisibility(Application $application)
    {
        if($this->addedCommandVisibility){
            return $application;
        }
        $this->addedCommandVisibility=true;
        $visibility = new CommandsVisibility();
        $this->configureVisibility($visibility);
        $this->hiddenCommands = collect($application->all())->filter(function (Command $value, $key) use ($visibility) {
            if ($visibility->shouldHideCommand($key)) {
                $value->setHidden(true);
                return true;
            }
            return false;
        });
        $this->app->instance('commands.hidden', $this->hiddenCommands);
        $this->app->bind('commands.unhider', function(){
            return function(){
                $this->hiddenCommands->values()->evaluate('setHidden(false)');
            };
        });

        $this->events->listen(CommandFinished::class, function (CommandFinished $event) use ($application) {
            if ($event->command === null || $event->command === 'list') {
                $input = $event->input;
                $input->bind($application->getDefinition());
                if ( ! $input->hasOption('show-all') || ! $input->getOption('show-all')) {
                    $event->output->writeln('');
                    $event->output->writeln('<comment>Tip: </comment>Use the <info>-A|--show-all</info> option to show all commands');
                }
            }
        });
        $this->events->listen(CommandStarting::class, function (CommandStarting $event) use ($visibility, $application) {
            if ($event->command === null || $event->command === 'list') {
                $application->getDefinition()->addOption(new InputOption('show-all', 'A', InputOption::VALUE_NONE, 'Show full commands on list'));
            }
            if ($event->command === null || $event->command === 'list') {
                $input = $event->input;
                $input->bind($application->getDefinition());
                if ($input->hasOption('show-all') && $input->getOption('show-all')) {
                    $this->hiddenCommands->values()->evaluate('setHidden(false)');
                }
            }
        });
        return $application;
    }

}

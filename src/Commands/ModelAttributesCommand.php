<?php

namespace Worksome\ModelAttributes\Commands;

use Illuminate\Console\Command;

class ModelAttributesCommand extends Command
{
    public $signature = 'model-attributes';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

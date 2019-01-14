<?php

namespace App\Console\Commands;

use App\Contracts\Flag;
use App\Jobs\PriceResultJob;
use App\Services\ProductPrice\Flags\Chemist;
use App\Services\ProductPrice\Flags\Coles;
use App\Services\ProductPrice\Flags\Wools;
use Illuminate\Console\Command;

class PriceChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** @var array $classMap */
    private $classMap = [
        'coles' => Coles::class,
        'wools' => Wools::class,
        'chemist' => Chemist::class
    ];

    /** @var array $result */
    private $result = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $flagList = config('products');
        foreach ($flagList as $group => $list) {
            $class = $this->classMap[$group];
            $groupResult = [];
            foreach ($list as $item) {
                try {
                    /** @var Flag $checker */
                    $checker = new $class($item['path']);
                    $result = $checker->preprocess()
                        ->process();
                    $result['label'] = $item['name'];
                    $groupResult[] = $result;
                    $checker->postprocess();

                } catch (\Exception $e) {
                    app('sentry')->captureException($e,
                        [
                            'fingerprint' => [$group]
                        ]
                    );
                }
                $this->result[$group] = $groupResult;
            }
        }

        $this->dispatch();
    }

    /**
     * @throws \App\Exceptions\JobException
     */
    private function dispatch()
    {
        dispatch(new PriceResultJob($this->result));
    }
}

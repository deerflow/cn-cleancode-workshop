<?php

class Homologation extends Command
{
    protected $signature = 'app:homologation {test?}';

    protected $description = 'Launch all tests on Homologation servers';

    public const SLEEP_BETWEEN_TESTS = 60;

    public function handle(HomologationRepository $repo)
    {
        if (true !== app()->environment('local')) {
            $this->output->error('Homologation only in dev env');
            return;
        }

        $this->output->title('Starting at '.now());

        $test = $this->argument('test');
        $output = [];

        if (empty($test)) {
            $tests = [
                'AB-1',
                'AB-2',
                'AB-3',
            ];
        } else {
            $tests = [$test];
        }

        $bar = $this->output->createProgressBar(count($tests));
        $bar->setFormat("%current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%\n%message%");
        $bar->setMessage('');
        $bar->start();

        $first = true;

        foreach ($tests as $test) {
            if (true === $first) {
                $first = false;
            } else {
                sleep(self::SLEEP_BETWEEN_TESTS);
            }
            $bar->setMessage('Testing '.$test);
            ray($test)->blue();
            $output[$test] = now();
            $this->{'test_'.str_replace('-', '_', $test)}($repo);
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nDone at ".now());

        foreach ($output as $test => $time) {
            $this->info($test.' → '.$time);
        }
    }

    private function test_AB_1(HomologationRepository $repo)
    {
        $result = $repo->getEndpoint('1');

        ray($result);
    }

    private function test_AB_2(HomologationRepository $repo)
    {
        $result = $repo->getEndpoint('2');

        ray($result);
    }

    private function test_AB_3(HomologationRepository $repo)
    {
        $result = $repo->getEndpoint('3');

        ray($result);
    }
}

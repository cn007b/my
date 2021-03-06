<?php

if (extension_loaded('xhprof')) {
    $XHPROF_ROOT = '/usr/share/php';
    include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
    include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";
    // start profiling
    xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}

function makeRange($length) {
    for ($i = 0; $i < $length; $i++) {
        yield $i;
    }
}
foreach (makeRange(1000000) as $i) {
    echo $i, PHP_EOL;
}
printf('usage: %d, peak: %d' . PHP_EOL, memory_get_usage(), memory_get_peak_usage());

if (extension_loaded('xhprof')) {
    //end profiling
    $xhprof_data = xhprof_disable();
    $xhprof_runs = new XHProfRuns_Default();
    $run_id = $xhprof_runs->save_run($xhprof_data, 'one');
    // php -S localhost:8000 -t /usr/share/php/xhprof_html/
}

/*
usage: 346216, peak: 368416
*/

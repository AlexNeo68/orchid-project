<?php

namespace App\Orchid\Layouts\Charts;

use Orchid\Screen\Layouts\Chart;

class DynamicInterviewedClientsChart extends Chart
{

    protected $title = 'Динамика опрошенных клиентов';


    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';

    protected $target = 'interviewedClients';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}

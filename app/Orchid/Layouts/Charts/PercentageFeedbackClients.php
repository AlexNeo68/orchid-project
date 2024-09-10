<?php

namespace App\Orchid\Layouts\Charts;

use Orchid\Screen\Layouts\Chart;

class PercentageFeedbackClients extends Chart
{

    protected $title = 'Отзывы клиентов';
    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;


    protected $target = 'percentageFeedback';


}

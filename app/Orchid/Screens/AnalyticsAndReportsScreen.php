<?php

namespace App\Orchid\Screens;

use App\Models\Client;
use App\Orchid\Layouts\Charts\DynamicInterviewedClientsChart;
use App\Orchid\Layouts\Charts\PercentageFeedbackClients;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class AnalyticsAndReportsScreen extends Screen
{

    public $permission = ['platform.analytics', 'platform.reports'];
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'interviewedClients' => [
                Client::countByDays(startDate:null, stopDate:null, dateColumn:'updated_at')->toChart('Опрошенные клиенты'),
                Client::countByDays()->toChart('Новые клиенты')
            ],
            'percentageFeedback' => Client::whereNotNull('assesment')->countForGroup('assesment')->toChart()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Аналитика и отчёты';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::columns([
                DynamicInterviewedClientsChart::class,
                PercentageFeedbackClients::class
            ])
        ];
    }
}

<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // تخصيص المخطط (نوع المخطط، البيانات...)
        $this->options([
            'responsive' => true, // اجعل المخطط قابلاً للتكيف مع الشاشة
            'maintainAspectRatio' => false,
        ]);
    }
}

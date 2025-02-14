<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
class BukuChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $booksCount = Buku::count();
        $publishersCount = Penerbit::count();
        $authorsCount = Penulis::count();
        $categoriesCount = Kategori::count();

        return $this->chart->lineChart()
            ->setTitle('Grafic')
            ->setSubtitle('Data Assalaam Library')
            ->addData('Amount', [$booksCount,$publishersCount,$authorsCount,$categoriesCount])
            ->setXAxis(['Book','Publisher','Writter','Category'])
            ->setHeight(400)
            ->setWidth(400)
            ->setMarkers(['#000fff'], 7, 10);
            // ->setYAxis(0, 100);

     }

}

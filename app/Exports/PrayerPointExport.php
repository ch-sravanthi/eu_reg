<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use AppHelper;	
use App\Models\PrayerPoint;

class PrayerPointExport implements FromCollection,WithMapping,WithHeadings
{
	
	protected $prayer_point;
	private $sno;
	
	public function __construct($prayer_point) {
		$this->prayer_point = $prayer_point;
		$this->sno = 1;
	}
	
    public function collection()
    {
        return $this->prayer_point;
    }
	
	/**
    * @var Team $team
    */
    public function map($prayer_point): array
    {
        return [
			$this->sno++,		
			$prayer_point->eu_name,
			$prayer_point->region,
			$prayer_point->district,
			$prayer_point->place,
			$prayer_point->thank_god,
			$prayer_point->prayer,
			$prayer_point->full_name,
			$prayer_point->email,
			$prayer_point->mobile,
			$prayer_point->responsibility,
			$prayer_point->created_at,
			
		];
    }
    public function headings(): array
    {
        return [
				'sno' => 'Sno',
				'eu_name' => 'EU Name',
				'region' => 'Region',
				'district' => 'District',
				'place' => 'Place',
				'thank_god' => 'Thank God for',
				'prayer' => 'Pray for',
				'full_name' => 'Name',
				'email' => 'Email ID',
				'mobile' => 'Mobile Number',
				'responsibility' => 'Your Responsibility in EU/EGF Committee',
				'created_at' => 'Posted On',
			
        ];
    }
	public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text and set background color
            1    => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => '87CEEB'], 
                ],
            ],
        ];
    }
}

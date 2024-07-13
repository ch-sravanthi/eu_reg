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
use App\Models\Feedback;

class FeedbackExport implements FromCollection,WithHeadings, WithMapping, WithStyles
{
	
	protected $feedbacks;
	private $sno;
	
	public function __construct($feedbacks) {
		$this->feedbacks = $feedbacks;
		$this->sno = 1;
	}
	
    public function collection()
    {
        return $this->feedbacks;
    }
	
	/**
    * @var Team $team
    */
    public function map($feedback): array
    {
        return [
			$this->sno++,		
			$feedback->rate,
			$feedback->article,
			$feedback->topics_themes,
			$feedback->experience,
			$feedback->comments,
			$feedback->created_at,
			
		];
    }
    public function headings(): array
    {
        return [
				'sno' => 'Sno',
				'rate' => 'Rate',
				'article' => 'Article',
				'topics_themes' => 'Theme',
				'experience' => 'Experience',
				'comments' => 'Comments',
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

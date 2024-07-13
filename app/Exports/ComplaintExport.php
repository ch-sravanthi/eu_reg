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
								

class ComplaintExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $complaintes;
	private $sno;

	public function __construct($complaintes)
	{
		$this->complaintes  = $complaintes;
		$this->sno = 1;

	}

    public function collection()
    {
		return $this->complaintes;
    }

	/**
    * @var Team $team
    */
    public function map($complaint): array
    {		
		return [
			$this->sno++,
			$complaint->full_name,
			$complaint->phone_no,
			$complaint->district,
			$complaint->email,
			$complaint->complaint_message,
			$complaint->created_at,

		];
    }
    public function headings(): array
    {	 return[
			'sno' => 'Sno',
			'full_name' => 'Person Name',
			'phone_no' => 'Phone Number',
			'district' => 'District',
			'email' => 'Email',
			'complaint_message' => 'Complaint Message',
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

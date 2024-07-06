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
								

class RenewalExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $renewals;
	private $sno;

	public function __construct($renewals)
	{
		$this->renewals  = $renewals;
		$this->sno = 1;

	}

    public function collection()
    {
		return $this->renewals;
    }

	/**
    * @var Team $team
    */
    public function map($model): array
    {		
		return [
			$this->sno++,
			$model->full_name,
			$model->email,
			$model->address,
			$model->district,
			$model->pincode,
			$model->state,
			$model->other_state,
			$model->mobile_num,
			$model->type_of_subscription,
			$model->amount,
			$model->date,
			$model->reference_number,
		];
    }
	public function title(): string
    {
        return 'VV Renewal Subscription ';
		
    }
    public function headings(): array
    {	 return[
			'sno' => 'Sno',
			'full_name' => 'Person Name',
			'email' => 'Email',
			'address' => 'Address',
			'district' => 'District',
			'pincode' => 'Pincode',
			'state' => 'State',
			'other_state' => 'Other State',
			'mobile_num' => 'Mobile',
			'type_of_subscription' => 'Type Of Subscription',
			'amount' => 'Amount',
			'date' => 'Date',
			'reference_number' => 'Reference Number',
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

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
use App\Models\AddressChange;
								

class AddressChangeExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $address_changes;
	private $sno;

	public function __construct($address_changes)
	{
		$this->address_changes  = $address_changes;
		$this->sno = 1;
		$this->expiry_dt = '';

	}

    public function collection()
    {
		return $this->address_changes;
    }

	/**
    * @var Team $team
    */
    public function map($address_change): array
    {		
		return [
			$this->sno++,
			$address_change->full_name,
			$address_change->phone_no,
			$address_change->email,
			$address_change->old_address,
			$address_change->new_address,
			$address_change->pincode,
			$address_change->expiry_dt,
			$address_change->created_at,

		];
    }
    public function headings(): array
    {	 return[
			'sno' => 'Sno',
			'full_name' => 'Person Name',
			'phone_no' => 'PHONE NUMBER',
			'email' => 'Email',
			'old_address' => 'OLD ADDRESS',
			'new_address' => 'NEW ADDRESS',
			'pincode' => 'PINCODE',
			'expiry_dt' => 'Expiry Dt',
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

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GeneralReportExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithEvents
{
    protected $reportType;
    protected $startDate;
    protected $endDate;
    protected $reportData;
    protected $summary;

    public function __construct($reportType, $startDate, $endDate, $reportData, $summary)
    {
        $this->reportType = $reportType;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->reportData = $reportData;
        $this->summary = $summary;
    }

    public function collection()
    {
        return $this->reportData;
    }

    public function headings(): array
    {
        if ($this->reportType === 'users') {
            return ['Name', 'Email', 'Registered On'];
        } elseif ($this->reportType === 'transactions') {
            return ['ID', 'User', 'Amount', 'Date']; // Make sure headers match columns
        }

        return [];
    }

    public function map($row): array
    {
        if ($this->reportType === 'users') {
            return [
                $row->name,
                $row->email,
                $row->created_at->format('Y-m-d'),
            ];
        } elseif ($this->reportType === 'transactions') {
            return [
                $row->id,
                $row->user->name ?? 'N/A',
                number_format($row->total_price, 0, ',', '.'),
                $row->created_at->format('Y-m-d'),
            ];
        }
    }

    public function title(): string
    {
        return ucfirst($this->reportType) . ' Report';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Merge and set report period in the first row
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->setCellValue('A1', 'Report Period: ' . $this->startDate->format('Y-m-d') . ' to ' . $this->endDate->format('Y-m-d'));

                // Set column headers (Name, Email, Registered On) or (ID, User, Amount, Date)
                if ($this->reportType === 'users') {
                    $event->sheet->setCellValue('A2', 'Name');
                    $event->sheet->setCellValue('B2', 'Email');
                    $event->sheet->setCellValue('C2', 'Registered On');
                } elseif ($this->reportType === 'transactions') {
                    $event->sheet->setCellValue('A2', 'ID');
                    $event->sheet->setCellValue('B2', 'User');
                    $event->sheet->setCellValue('C2', 'Amount');
                    $event->sheet->setCellValue('D2', 'Date');
                }

                // Set up the summary section after the data rows
            // Here we start adding data from row 4 instead of 3
            $dataStartRow = 3; // Set data to start at row 4
            $currentRow = $dataStartRow;

            // Loop through the data collection and manually set each value
            foreach ($this->reportData as $row) {
                if ($this->reportType === 'users') {
                    $event->sheet->setCellValue('A' . $currentRow, $row->name);
                    $event->sheet->setCellValue('B' . $currentRow, $row->email);
                    $event->sheet->setCellValue('C' . $currentRow, $row->created_at->format('Y-m-d'));
                } elseif ($this->reportType === 'transactions') {
                    $event->sheet->setCellValue('A' . $currentRow, $row->id);
                    $event->sheet->setCellValue('B' . $currentRow, $row->user->name ?? 'N/A');
                    $event->sheet->setCellValue('C' . $currentRow, number_format($row->total_price, 0, ',', '.'));
                    $event->sheet->setCellValue('D' . $currentRow, $row->created_at->format('Y-m-d'));
                }
                $currentRow++;
            }

            // Summary section after data
            $lastRow = $currentRow; // Update lastRow to the new currentRow
            $event->sheet->mergeCells('A' . ($lastRow + 2) . ':D' . ($lastRow + 2));
            $event->sheet->setCellValue('A' . ($lastRow + 2), 'Summary');

            // Add summary details based on the report type
            if ($this->reportType === 'users') {
                $event->sheet->setCellValue('A' . ($lastRow + 3), 'Total New Users:');
                $event->sheet->setCellValue('B' . ($lastRow + 3), $this->summary['totalUsers']);
                $event->sheet->setCellValue('A' . ($lastRow + 4), 'Total All Users:');
                $event->sheet->setCellValue('B' . ($lastRow + 4), $this->summary['totalAllUsers']);
            } elseif ($this->reportType === 'transactions') {
                $event->sheet->setCellValue('A' . ($lastRow + 3), 'Total Transactions:');
                $event->sheet->setCellValue('B' . ($lastRow + 3), $this->summary['totalTransactions']);
                $event->sheet->setCellValue('A' . ($lastRow + 4), 'Total Amount:');
                $event->sheet->setCellValue('B' . ($lastRow + 4), number_format($this->summary['totalAmount'], 0, ',', '.'));
                $event->sheet->setCellValue('A' . ($lastRow + 5), 'Average Amount:');
                $event->sheet->setCellValue('B' . ($lastRow + 5), number_format($this->summary['averageAmount'], 2, ',', '.'));
            }
            },
        ];
    }

}

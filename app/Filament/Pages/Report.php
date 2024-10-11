<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Transaction;
use Filament\Pages\Page;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GeneralReportExport;

class Report extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.report';

    protected static ?string $navigationGroup = 'Shops';
    protected static ?int $navigationSort = 10;

    public $startDate;
    public $endDate;
    public $reportType;
    public $exportFormat;

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('startDate')
                ->label('Start Date')
                ->required(),
            DatePicker::make('endDate')
                ->label('End Date')
                ->required(),
            Select::make('reportType')
                ->label('Report Type')
                ->options([
                    'users' => 'Users Report',
                    'transactions' => 'Transactions Report',
                ])
                ->required(),
            Select::make('exportFormat')
                ->label('Export Format')
                ->options([
                    'pdf' => 'PDF',
                    'excel' => 'Excel',
                ])
                ->required(),
        ];
    }

    public function generateReport()
    {
        $data = $this->form->getState();

        $startDate = Carbon::parse($data['startDate'])->startOfDay();
        $endDate = Carbon::parse($data['endDate'])->endOfDay();

        $reportData = [];
        $summary = [];

        if ($data['reportType'] === 'users') {
            $reportData = User::whereBetween('created_at', [$startDate, $endDate])->get();
            $summary = [
                'totalUsers' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
                'totalAllUsers' => User::count(),
            ];
        } elseif ($data['reportType'] === 'transactions') {
            $reportData = Transaction::with('user')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
            $summary = [
                'totalTransactions' => $reportData->count(),
                'totalAmount' => $reportData->sum('total_price'),
                'averageAmount' => $reportData->avg('total_price'),
            ];
        }

        if ($data['exportFormat'] === 'pdf') {
            return $this->generatePDF($data['reportType'], $startDate, $endDate, $reportData, $summary);
        } else {
            return $this->generateExcel($data['reportType'], $startDate, $endDate, $reportData, $summary);
        }
    }

    protected function generatePDF($reportType, $startDate, $endDate, $reportData, $summary)
    {
        $pdf = Pdf::loadView('reports.general', [
            'reportType' => $reportType,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'data' => $reportData,
            'summary' => $summary,
        ]);

        $fileName = $reportType . '_report_' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(
            fn () => print($pdf->output()),
            $fileName,
            ['Content-Type' => 'application/pdf']
        );
    }

    protected function generateExcel($reportType, $startDate, $endDate, $reportData, $summary)
    {
        $fileName = $reportType . '_report_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(
            new GeneralReportExport($reportType, $startDate, $endDate, $reportData, $summary),
            $fileName
        );
    }

    protected function getActions(): array
    {
        return [
            Action::make('generate')
                ->label('Generate Report')
                ->action('generateReport'),
        ];
    }
}

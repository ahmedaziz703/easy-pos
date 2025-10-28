<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions\CreateAction;
use Maatwebsite\Excel\Excel;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {

        return [
            CreateAction::make(),
            ExportAction::make() 
            ->exports([
                ExcelExport::make()
                    ->fromTable()
                    ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                    ->withWriterType(Excel::CSV)
                    ->withColumns([
                        Column::make('customer.phone')->heading('Mobile'),
                        Column::make('customer.email')->heading('Email'),
                        Column::make('customer.address')->heading('Address'),
                        Column::make('updated_at'),
                    ])
            ]),  
        ];
    }

    protected function getWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }
}

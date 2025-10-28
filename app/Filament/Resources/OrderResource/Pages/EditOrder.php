<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected string $view = 'filament.pages.edit-order';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('print')
                ->label('طباعة')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn($record) => url('print/' . $record->id) . '?print=1', shouldOpenInNewTab: true),
            
            Action::make('preview')
                ->label('عرض الفاتورة')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->url(fn($record) => url('print/' . $record->id), shouldOpenInNewTab: true),
            
            DeleteAction::make(),
        ];
    }
}

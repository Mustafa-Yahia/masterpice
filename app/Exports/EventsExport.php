<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Event::with('category')->get();
    }

    public function headings(): array
    {
        return [
            'العنوان',
            'الوصف',
            'التاريخ',
            'الوقت',
            'المكان',
            'عدد المتطوعين المطلوب',
            'الفئة'
        ];
    }

    public function map($event): array
    {
        return [
            $event->title,
            $event->description,
            $event->date,
            $event->time,
            $event->location,
            $event->volunteers_needed,
            $event->category->name ?? 'غير مصنف'
        ];
    }
}

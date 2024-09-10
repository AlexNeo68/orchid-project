<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Client extends Model
{
    use Chartable;
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = ['phone', 'name', 'last_name', 'status', 'email', 'birthday', 'service_id', 'assessment', 'invoice_id'];

    protected $allowedSorts = [
        'status',
        'created_at',
    ];

    protected $allowedFilters = [
        'phone' => Where::class
    ];

    public const STATUS = [
        'not_interviewed' => 'Не опрошен',
        'interviewed' => 'Опрошен',
    ];
}

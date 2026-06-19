<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Override;

class ProductosExport implements /*FromCollection,*/ FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::select('nombre')->get();
    }

    public function view(): View
    {
        return view('excel.exports.productos', [
            'productos' => Producto::with(['categoria'])->get()
        ]);
    }
}

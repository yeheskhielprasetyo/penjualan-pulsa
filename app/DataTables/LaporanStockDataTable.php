<?php

namespace App\DataTables;

use App\Models\Operator;
use App\Models\Transaksi;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanStockDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('l, d F Y');
            })
            ->addColumn('id_operator', function ($data) {
                return $data->operator->nama_operator;
            })
            ->addColumn('jumlah', function ($data) {
                $transaksi = Transaksi::select('jumlah')->where('id_operator', '=', $data->id_operator)->where('created_at', '=', Carbon::parse($data->created_at))->sum('jumlah');
                return $transaksi;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaksi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaksi $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('laporanstockdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(0, 'desc')
            ->autoWidth(false);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['title' => 'No', 'orderable' => true, 'searchable' => true, 'render' => function () {
                return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
            }],
            Column::make('id_operator')->title('Operator'),
            Column::make('jumlah')->title('Total Stock'),
            Column::make('created_at')->title('Tanggal'),
            // Column::computed('action')
            //     ->exportable(FALSE)
            //     ->printable(FALSE)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LaporanStock_' . date('YmdHis');
    }
}

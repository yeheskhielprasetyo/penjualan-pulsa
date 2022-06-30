<?php

namespace App\DataTables;

use App\Models\DataTransaksi;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelangganKonfirmasiDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                $action = '<button type="button" class="waves-effect btn btn-sm btn-danger" onclick="action(\'' . 'hapus' . '\',\'' . $data->id . '\')">
                <i class="material-icons" style="color:white;">clear</i>
                </button>';
                return $action;
            })
            ->addColumn('id_transaksi', function ($data) {
                if($data->transaksi->nama != null){
                    return $data->transaksi->nama;
                } else {
                    return "Tidak ada";
                }
            })
            ->addColumn('sub_total', function ($data) {
                return "Rp." . " " . " " . $data->sub_total;
            })
            ->addColumn('tanggal_transaksi', function ($data) {
                return Carbon::parse($data->tanggal_transaksi)->translatedFormat('l, d F Y, H:i');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pelanggan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DataTransaksi $model)
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
            ->setTableId('pelanggankonfirmasidatatable-table')
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
            Column::make('id_transaksi')->title('Nama Pembeli'),
            Column::make('tanggal_transaksi')->title('Tanggal Transaksi'),
            Column::make('sub_total')->title('Total'),
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
        return 'PelangganKonfirmasi_' . date('YmdHis');
    }
}

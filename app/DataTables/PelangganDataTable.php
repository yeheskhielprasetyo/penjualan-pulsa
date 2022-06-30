<?php

namespace App\DataTables;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelangganDataTable extends DataTable
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
                $action = ' <button type="button" class="waves-effect btn btn-sm btn-primary" onclick="action(\'' . 'konfirmasi' . '\',\'' . $data->id . '\')">
                <i class="material-icons" style="color:white;">done</i>
                </button>
                <button type="button" class="waves-effect btn btn-sm btn-danger" onclick="action(\'' . 'hapus' . '\',\'' . $data->id . '\')">
                <i class="material-icons" style="color:white;">clear</i>
                </button>';
                return $action;
            })
            ->addColumn('id_operator', function ($data) {
                if($data->id_operator == null){
                    return  "Tidak ada";
                } else {
                    return $data->operator->nama_operator;
                }
            })
            ->addColumn('total_harga', function ($data) {
                return "Rp." . " " . " " . $data->total_harga;
            })
            ->addColumn('id_barang', function ($data) {
                if($data->id_barang == null){
                    return  "Tidak ada";
                } else {
                    return $data->barang->nama_barang;
                }

            })
            ->addColumn('jumlah', function ($data) {
                if($data->jumlah == null){
                    return  "Tidak ada";
                } else {
                    return $data->jumlah;
                }
            })
            ->addColumn('jumlah_aksesoris', function ($data) {
                if($data->jumlah_aksesoris == null){
                    return  "Tidak ada";
                } else {
                    return $data->jumlah_aksesoris;
                }
            })
            ->addColumn('no_hp', function ($data) {
                if($data->no_hp == null){
                    return  "Tidak ada";
                } else {
                    return $data->no_hp;
                }
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('l, d F Y, H:i');
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
        return $model->newQuery()->where('status', '=', 'PENDING');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('pelanggandatatable-table')
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
            Column::make('created_at')->title('Tanggal'),
            Column::make('nama')->title('Nama Pembeli'),
            Column::make('total_harga')->title('Total Harga'),
            Column::make('id_operator')->title('Nama Operator'),
            Column::make('id_barang')->title('Nama Barang'),
            Column::make('jumlah')->title('Jumlah Pulsa'),
            Column::make('jumlah_aksesoris')->title('Jumlah Aksesoris'),
            Column::make('no_hp')->title('No Hp'),
            Column::computed('action')
                ->exportable(FALSE)
                ->printable(FALSE)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pelanggan_' . date('YmdHis');
    }
}

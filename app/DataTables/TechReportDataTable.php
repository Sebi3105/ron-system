<?php

namespace App\DataTables;

use App\Models\TechReport;  // Use the correct model for TechReport
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\TechProfile\DataTable;
use Yajra\DataTables\Facades\DataTables;

class TechReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'techreport.action') // Update this to match your view or route for actions
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TechReport $model): QueryBuilder
    {
        return $model->newQuery(); // Return the TechReport model query
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('techreport-table') // Update the table ID for TechReport
                    ->columns($this->getColumns())
                    ->minifiedAjax() // Enable Ajax for server-side processing
                    ->orderBy(1)
                    ->selectStyleSingle() // Single row selection
                    ->buttons([ 
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('report_id'),          // Assuming `report_id` exists in your TechReport model
            Column::make('technician_id'),      // Adjust columns as per your TechReport model
            Column::make('customer_id'),        // Adjust columns as per your TechReport model
            Column::make('sku_id'),             // Adjust columns as per your TechReport model
            Column::make('service_id'),         // Adjust columns as per your TechReport model
            Column::make('date_of_completion'), // Adjust columns as per your TechReport model
            Column::make('payment_type'),       // Adjust columns as per your TechReport model
            Column::make('payment_method'),     // Adjust columns as per your TechReport model
            Column::make('status'),             // Adjust columns as per your TechReport model
            Column::make('remarks'),            // Adjust columns as per your TechReport model
            Column::make('cost'),               // Adjust columns as per your TechReport model
            Column::make('created_at'),         // Adjust columns as per your TechReport model
            Column::make('updated_at'),         // Adjust columns as per your TechReport model
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TechReport_' . date('YmdHis'); // Add timestamp to filename for uniqueness
    }
}

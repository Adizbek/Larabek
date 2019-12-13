<?php


namespace Adizbek\GiveMeCrud\Builder\TableBuilder;


use Illuminate\Pagination\LengthAwarePaginator;

class TableBuilder
{
    private $data;

    /**
     * @var TableColumn[]
     */
    private $columns = [];

    /**
     * TableBuilder constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param string $name Name of column
     * @return TableColumn
     */
    public function addColumn($name)
    {
        $column = new TableColumn($name);
        $this->columns[] = $column;

        return $column;
    }

    public function render()
    {
        echo '<table class="table table-bordered table-striped">';

        $this->renderHeader();
        $this->renderRows();

        echo '</table>';

        if ($this->data instanceof LengthAwarePaginator) {
            echo $this->data->links();
        }
    }

    public function renderHeader()
    {
        echo '<thead><tr>';

        foreach ($this->columns as $column) {
            echo "<th>{$column->getTitle()}</th>";
        }

        echo '</thead></tr>';
    }

    public function renderRows()
    {
        echo '<thead>';

        foreach ($this->data as $data) {
            echo '<tr>';
            foreach ($this->columns as $column) {
                echo "<td{$column->getAttributes()}>{$column->renderData($data)}</td>";
            }
            echo '</tr>';
        }

        echo '</thead>';
    }
}

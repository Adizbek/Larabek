<?php


namespace App\Extensions\TableBuilder;


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

    public function addColumn($name, $options = [])
    {
        $this->columns[] = new TableColumn($name, $options);
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
                echo "<td>{$column->renderData($data)}</td>";
            }
            echo '</tr>';
        }

        echo '</thead>';
    }
}

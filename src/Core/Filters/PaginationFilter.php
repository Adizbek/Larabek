<?php


namespace Adizbek\Larabek\Core\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaginationFilter extends SelectFilter
{
    public $applyOnlyPresent = false;

    public $name = 'pagination';

    public $title = 'Allows to paginate on sheet';


    /**
     * PaginationFilter constructor.
     */
    public function __construct()
    {
        $this->setOptions([
            10, 25, 50, 100
        ]);

        $this->setDefault(1);
        $this->value = $this->defaultValue;
    }

    public function apply(Request $request, Builder $builder, $index)
    {
        $limit = $this->getValue($index);

        $page = max($request->get('page') ?? 1, 1);
        $offset = ($page - 1) * $limit;

        return $builder->limit($limit)->offset($offset);
    }

    public function getKey()
    {
        return 'pagination';
    }


}

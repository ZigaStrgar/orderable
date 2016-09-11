<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderingScope implements Scope
{

    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected $extensions = [ 'Unorderable' ];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        foreach ( $this->getOrderByRules($builder) as $column => $order ) {
            if ( !is_int($column) ) {
                $builder->orderBy($column, $order);
            } else {
                $builder->orderBy($order, "DESC");
            }
        }
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return void
     */
    public function extend(Builder $builder)
    {
        foreach ( $this->extensions as $extension ) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * Get the "order by" rules for the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return string
     */
    protected function getOrderByRules(Builder $builder)
    {
        return $builder->getModel()->orderable();
    }

    /**
     * Add the restore extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return void
     */
    protected function addUnorderable(Builder $builder)
    {
        $builder->macro('unorderable', function(Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}
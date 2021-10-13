<?php

namespace App\Traits;

use App\Database\CacheQueryBuilder;

trait CacheQueryBuilderTrait
{
    /**
     * Get a new query builder instance for the connection.
     *
     * @return CacheQueryBuilder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        return new CacheQueryBuilder($conn, $grammar, $conn->getPostProcessor());
    }
}

<?php

namespace App\Contracts;

/**
 * Interface WebseriesContract
 * @package App\Contracts
 */
interface WebseriesContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listWebseries(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findWebseriesById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createWebseries(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWebseries(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteWebseries($id);
}
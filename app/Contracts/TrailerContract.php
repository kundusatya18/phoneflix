<?php

namespace App\Contracts;

/**
 * Interface TrailerContract
 * @package App\Contracts
 */
interface TrailerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTrailers(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTrailerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTrailer(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTrailer(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTrailer($id);
}
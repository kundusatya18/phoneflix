<?php

namespace App\Contracts;

/**
 * Interface GenreContract
 * @package App\Contracts
 */
interface GenreContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listGenres(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findGenreById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createGenre(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateGenre(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteGenre($id);
}
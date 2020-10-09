<?php

namespace App\Contracts;

/**
 * Interface EpisodeContract
 * @package App\Contracts
 */
interface EpisodeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listEpisodes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findEpisodeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createEpisode(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEpisode(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteEpisode($id);
}
<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @param array $relations
     * @return mixed
     */
    public function getAll(array $relations = []);

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Get by conditions
     * @param array $conditions
     * @param array $relations
     * @return mixed
     */
    public function findByConditions(array $conditions = [], array $relations = []);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param array $condition
     * @param array $attributes
     * @return mixed
     */
    public function update(array $condition, array $attributes);

    /**
     * Update
     * @param array $condition
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate(array $condition, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}

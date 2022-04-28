<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    abstract public function model();

    /**
     * Get all
     * @param array $relations
     * @return mixed
     */
    public function getAll(array $relations = [])
    {
        return $this->model()->with($relations)->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    /**
     * Get by conditions
     * @param array $conditions
     * @param array $relations
     * @return mixed
     */
    public function findByConditions(array $conditions = [], array $relations = [])
    {
        return $this->model()->where($conditions)->with($relations);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model()->create($attributes);
    }

    /**
     * Update
     * @param array $condition
     * @param array $attributes
     * @return mixed
     */
    public function update(array $condition, array $attributes)
    {
        return $this->model()->where($condition)->update($attributes);
    }

    /**
     * Update
     * @param array $condition
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate(array $condition, array $attributes)
    {
        return $this->model()->updateOrCreate($condition, $attributes);
    }

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->findOrFail($id)->delete();
    }
}

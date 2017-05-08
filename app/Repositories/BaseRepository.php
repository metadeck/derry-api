<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {


    /**
     * The eloquent model
     * @var Model
     */
    protected $model;

    /**
     * The relations to eager load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * Sets relations for eager loading.
     *
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {

        if (is_string($relations)) {
            $this->with = explode(',', $relations);

            return $this;
        }

        $this->with = is_array($relations) ? $relations : [];

        return $this;
    }

    /**
     * Creates a new QueryBuilder instance including eager loads
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->newQuery()->with($this->with);
    }

    /**
     * Default functionality
     */
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->query()->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->query()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->query()->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->query()->where($attribute, '=', $value)->first($columns);
    }
}
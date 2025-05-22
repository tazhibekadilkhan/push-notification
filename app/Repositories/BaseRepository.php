<?php


namespace App\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public $sortBy = 'id';
    public $sortOrder = 'DESC';

    public $paginate = 20;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Возвращает модель
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * Возвращает подключение к БД
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->model->getConnection();
    }

    /**
     * Get all elements on Model
     * @return mixed
     */
    public function all()
    {
        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->get();
    }

    public function allWithTrashed()
    {
        return $this->model
            ->withTrashed()
            ->orderBy($this->sortBy, $this->sortOrder)
            ->get();
    }

    /**
     * Get paginated elements on Model
     * @param int $paginate
     * @param array $relations
     * @return mixed
     */
    public function paginated(array $relations = [])
    {
        return $this->model
            ->with($relations)
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->paginate);
    }

    /**
     * Insert any element to Database
     * @param $input
     * @return mixed
     */
    public function create($data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * Find one element by id on Model
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function findByIdWithTrashed($id)
    {
        return $this->getModel()->withTrashed()->findOrFail($id);
    }

    /**
     * Delete one element by id on Model
     * @param $id
     * @return mixed
     */
    public function destroy($item)
    {
        return $item->delete();
    }

    public function restore($id)
    {
        return $this->getModel()->withTrashed()->findOrFail($id)->restore();
    }

    /**
     * Update one element by id on Model
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($item, array $data)
    {
        $item->update($data);
        return $item;
    }
}

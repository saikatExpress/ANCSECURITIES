<?php

// app/Repositories/FundRepository.php

namespace App\Repositories;

use App\Models\Fund;
use Illuminate\Support\Facades\Log;
use App\Interfaces\FundRepositoryInterface;

class FundRepository implements FundRepositoryInterface
{
    protected $model;

    public function __construct(Fund $fund)
    {
        $this->model = $fund;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $fund = $this->model->find($id);
        if ($fund) {
            $fund->update($data);
            return $fund;
        }
        return null;
    }

    public function delete($id)
    {
        $fund = $this->model->find($id);
        if ($fund) {
            $fund->delete();
            return true;
        }
        return false;
    }

    public function restore($id)
    {
        $fund = $this->model->onlyTrashed()->find($id);
        if ($fund) {
            $fund->restore();
            return $fund;
        }
        return null;
    }
}

<?php

namespace App\Controllers;

use App\Models\LatihanModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class LatihanController extends ResourceController
{
    protected $modelName = 'App\Models\LatihanModel';
    protected $format = 'json';

    public function index()
    {
        $model = new LatihanModel();
        $data = $model->findAll();

        return $this->respond($data);
    }

    public function create()
    {
        $model = new LatihanModel();
        $data = $this->request->getJSON(true);

        if ($model->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Data created']);
        } else {
            return $this->respond(['status' => 'error', 'message' => $model->errors()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show($id = null)
    {
        $model = new LatihanModel();
        $data = $model->find($id);

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update($id = null)
    {
        $model = new LatihanModel();
        $data = $this->request->getJSON(true);

        if ($model->update($id, $data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data updated']);
        } else {
            return $this->respond(['status' => 'error', 'message' => $model->errors()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete($id = null)
    {
        $model = new LatihanModel();

        if ($model->delete($id)) {
            return $this->respond(['status' => 'success', 'message' => 'Data deleted']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
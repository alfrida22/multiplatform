<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DaftarModel;

class Daftar extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new DaftarModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new DaftarModel();
        $data = $model->find(['id' => $id]);
        if (!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data[0]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'username' =>'required',
            'email' =>'required',
            'password' =>'required'
        ];

        $data = [
            'username'=> $this->request->getVar('username'),
            'email'=> $this->request->getVar('email'),
            'password'=> $this->request->getVar('password'),
        ];

        if($this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new DaftarModel();
        $model->save($data);
        $response = [
            // 'status' => 'success',
            // 'messages' => 'Data berhasil ditambahkan',
            // 'data' => $data,
            'status' => 201,
            'error'  => null,
            'message' => [
                'success' => 'Data Inserted'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */  
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'username' =>'required',
            'email' =>'required',
            'password' =>'required'
        ];

        $data = [
            'username'=> $this->request->getVar('username'),
            'email'=> $this->request->getVar('email'),
            'password'=> $this->request->getVar('password'),
        ];

        if($this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new DaftarModel();
        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error'  => null,
            'message' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new DaftarModel();
        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');
        $model->update($id);
        $response = [
            'status' => 200,
            'error'  => null,
            'message' => [
                'success' => 'Data Deleted'
            ]
        ];
        return $this->respond($response);
    }
}
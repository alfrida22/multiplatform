<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ArticleController extends ResourceController
{
    protected $modelName = 'App\Models\ArticleModel';
    protected $format = 'json';

    // Index - GET /article
    public function index(): ResponseInterface
    {
        $articles = $this->model->findAll();
        return $this->respond($articles);
    }

    // Show - GET /article/{id}
    public function show($id = null): ResponseInterface
    {
        $article = $this->model->find($id);
        return $this->respond($article);
    }

    // Create - POST /article/store
    // Create - POST /article/store
public function store(): ResponseInterface
{
    try {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_publikasi' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $article = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tanggal_publikasi' => $this->request->getPost('tanggal_publikasi'),
            'gambar' => $this->request->getFile('gambar') ? $this->request->getFile('gambar')->getName() : null,
        ];

        $articleModel = new ArticleModel();
        $articleModel->save($article);

        // Pindahkan gambar ke folder uploads
        // Pindahkan gambar ke folder uploads
if ($article['gambar']) {
    // Ganti spasi dengan garis bawah (_)
    $article['gambar'] = str_replace(' ', '_', $article['gambar']);

    // Ganti path sesuai dengan struktur folder Anda
    $uploadPath = WRITEPATH . 'uploads/';
    $this->request->getFile('gambar')->move($uploadPath, $article['gambar']);
}


        return $this->respondCreated(['status' => 'success', 'message' => 'Article created successfully']);
    } catch (\Exception $e) {
        return $this->failServerError($e->getMessage());
    }
}


    // Update - PUT /article/update/{id}
    public function update($id = null): ResponseInterface
    {
        $article = $this->model->find($id);
        if (!$article) {
            return $this->failNotFound('Article not found');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_publikasi' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $articleData = [
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
            'tanggal_publikasi' => $this->request->getVar('tanggal_publikasi'),
        ];

        $this->model->update($id, $articleData);

        return $this->respond(['status' => 'success', 'message' => 'Article updated successfully']);
    }

    // Delete - DELETE /article/delete/{id}
    public function delete($id = null): ResponseInterface
    {
        $article = $this->model->find($id);
        if (!$article) {
            return $this->failNotFound('Article not found');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['status' => 'success', 'message' => 'Article deleted successfully']);
    }
}
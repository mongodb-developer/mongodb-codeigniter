<?php

namespace App\Controllers;

helper('inflector');

use App\Models\BooksModel;

class Books extends BaseController
{
    public function index()
    {
        $model = model(BooksModel::class);

        $data = [
            'books' => $model->getBooks(),
        ];

        echo view('templates/header', $data);
        echo view('books/list', $data);
        echo view('templates/footer', $data);
    }

    public function details($segment = null)
    {
        $model = model(BooksModel::class);

        $data['book'] = $model->getBook($segment);

        if (empty($data['book'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find book with ID: ' . $segment);
        }
    
        $data['title'] = $data['book']['title'];
        $data['book']['progress'] = round($data['book']['pagesRead'] / $data['book']['pages'] * 100, 2);
    
        echo view('templates/header', $data);
        echo view('books/details', $data);
        echo view('templates/footer', $data);
    }

    public function create()
    {
        $model = model(BooksModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[1]|max_length[255]',
            'author' => 'required|min_length[1]|max_length[255]',
            'pages' => 'required|is_natural_no_zero',
        ])) {
            $model->insertBook(
                $this->request->getPost('title'),
                $this->request->getPost('author'),
                $this->request->getPost('pages'),
            );

            return redirect()->to('books');
        } else {
            echo view('templates/header');
            echo view('books/create', ['title' => 'Add a new book']);
            echo view('templates/footer');
        }
    }

    public function edit($segment = null)
    {
        $model = model(BooksModel::class);

        $data['book'] = $model->getBook($segment);

        if (empty($data['book'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find book with ID: ' . $segment);
        }

        $data['title'] = $data['book']['title'];

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[1]|max_length[255]',
            'author' => 'required|min_length[1]|max_length[255]',
            'pagesRead' => 'required|is_natural',
        ])) {
            $model->updateBook(
                $data['book']['_id'],
                $this->request->getPost('title'),
                $this->request->getPost('author'),
                $this->request->getPost('pagesRead'),
            );

            return redirect()->to('books');
        } else {
            echo view('templates/header', $data);
            echo view('books/edit', $data);
            echo view('templates/footer', $data);
        }
    }

    public function delete($segment = null) {
        if (!empty($segment) && $this->request->getMethod() == 'get') {
            $model = model(BooksModel::class);
            $model->deleteBook($segment);
        }

        return redirect()->to('books');
    }
}

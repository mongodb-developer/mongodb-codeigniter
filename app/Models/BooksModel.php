<?php

namespace App\Models;

use App\Libraries\DatabaseConnector;

class BooksModel {
    private $collection;

	function __construct() {
		$connection = new DatabaseConnector();
		$database = $connection->getDatabase();
        $this->collection = $database->books;
	}

	function getBooks($limit = 10) {
		try {
            $cursor = $this->collection->find([], ['limit' => $limit]);
            $books = $cursor->toArray();

            return $books;
		} catch(\MongoDB\Exception\RuntimeException $ex) {
			show_error('Error while fetching books: ' . $ex->getMessage(), 500);
		}
	}

	function getBook($id) {
		try {
            $book = $this->collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

            return $book;
		} catch(\MongoDB\Exception\RuntimeException $ex) {
			show_error('Error while fetching book with ID: ' . $id . $ex->getMessage(), 500);
		}
	}

	function insertBook($title, $author, $pages) {
		try {
            $insertOneResult = $this->collection->insertOne([
                'title' => $title,
                'author' => $author,
				'pages' => $pages,
                'pagesRead' => 0,
            ]);

			if($insertOneResult->getInsertedCount() == 1) {
				return true;
			}

			return false;
		} catch(\MongoDB\Exception\RuntimeException $ex) {
			show_error('Error while creating a book: ' . $ex->getMessage(), 500);
		}
	}

	function updateBook($id, $title, $author, $pagesRead) {
		try {
            $result = $this->collection->updateOne(
                ['_id' => new \MongoDB\BSON\ObjectId($id)],
                ['$set' => [
                    'title' => $title,
                    'author' => $author,
                    'pagesRead' => $pagesRead,
                ]]
            );

			if($result->getModifiedCount()) {
				return true;
			}

			return false;
		} catch(\MongoDB\Exception\RuntimeException $ex) {
			show_error('Error while updating a book with ID: ' . $id . $ex->getMessage(), 500);
		}
	}

	function deleteBook($id) {
		try {
            $result = $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

			if($result->getDeletedCount() == 1) {
				return true;
			}

			return false;
		} catch(\MongoDB\Exception\RuntimeException $ex) {
			show_error('Error while deleting a book with ID: ' . $id . $ex->getMessage(), 500);
		}
	}
}

<?php

class Posts extends Controller {
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function index() {
        $posts = $this->postModel->findAllPosts();

        $data = [
            'posts' => $posts,
        ];
        
        $this->view('posts/index', $data);
    }

    public function create() {
        if (!isLoggedIn()) {
            header('Location: ' . URL_ROOT . '/posts');
        }

        $data = [
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->addPost($data)) {
                    header('Location: ' . URL_ROOT . '/posts');
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                $this->view('posts/create', $data);
            }
        }

        $this->view('posts/create', $data);
    }

    public function update($id) {

        $post = $this->postModel->findPostById($id);
        

        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/posts");
        } elseif ($post->user_id !== $_SESSION['user_id']) {
            header("Location: " . URL_ROOT . "/posts");
        }
        
        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if ($data['title'] == $this->postModel->findPostById($id)->title) {
                $data['titleError'] = 'Atleast change the title';
            }

            if ($data['body'] == $this->postModel->findPostById($id)->body) {
                $data['bodyError'] = 'Atleast change the body';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    header('Location: ' . URL_ROOT . '/posts');
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                $this->view('posts/update', $data);
            }
        }

        $this->view('posts/update', $data);
    }

    public function delete($id) {
        $post = $this->postModel->findPostById($id);
        

        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/posts");
        } elseif ($post->user_id !== $_SESSION['user_id']) {
            header("Location: " . URL_ROOT . "/posts");
        }
        
        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if ($this->postModel->deletePost($id)) {
                header("Location: " . URL_ROOT . "/posts");
            } else {
                die('Something went wrong!');
            }
        
        }

    }
}
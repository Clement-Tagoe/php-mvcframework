<?php

class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index () {

        $users = $this->userModel->getUsers();

        $data = [
            'title' => 'Home Page',
            'users' => $users
        ];

        $this->view('pages/index', $data);
    }

    public function about () {
        $this->view('pages/about');
    }

    public function blog() {
        $posts = $this->postModel->findAllPosts();

        $data = [
            'posts' => $posts,
        ];
        
        $this->view('posts/index', $data);
    }
    
}
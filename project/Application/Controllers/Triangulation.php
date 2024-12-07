<?php

use MVC\Controller;
use Services\TriangulateService;

class ControllersTriangulation extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('Triangulation');
        $this->service = new TriangulateService($this->model);
    }

    public function index()
    {
        // Send Response
        $this->response->sendStatus(200);
        $this->view->render('dist/index.html');
    }

    public function calculate()
    {
        try {
            // header
            $data = json_decode(file_get_contents('php://input'), true);
            // check data
            if (!isset($data['points']) || !isset($data['distances1']) || !isset($data['distances2']) || !isset($data['distances3'])) {
                $this->response->sendStatus(400);
                $this->response->setContent(['message' => 'Invalid data']);
                return;
            }
            /***
             * {
             * ['lat': 1, 'lon': 2],
             * ['lat': 3, 'lon': 4]
             * ['lat': 5, 'lon': 6]
             * }
             */
            $points = $data['points'];
            $distances = [
                $data['distances1'],
                $data['distances2'],
                $data['distances3']
            ];
            $result = $this->service->calculate($points, $distances);
            // set Header json

            $this->response->setContent($result);
        } catch (\Exception $e) {
            echo 'test';
//            $this->view->render('triangulate/error');
            echo $e->getMessage();
            return;
        }
    }

    public function post()
    {

        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('home');

            // Read All Task
            $users = $model->getAllUser();

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }

    public function uploadImage()
    {
        if (isset($this->request->files['image'])) {
            $image = $this->request->files['image'];
            $errors = array();

            // File info
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];

            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            // White list extensions
            $extensions = array("jpeg", "jpg", "png");

            // Check it's valid file for upload
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check file size
            if ($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, UPLOAD . "Images/" . $file_name);
                echo "Success";
            } else {
                print_r($errors);
            }
        }
    }
}

<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel');
        $this->call->library('pagination');
        $this->call->library('form_validation');
        $this->call->library('session');

         if (empty($_SESSION['user_id'])) {
        redirect(site_url('login'));
        exit;
    }
    }

    public function index()
{
    // 🔒 Require login
    if (empty($_SESSION['user_id'])) {
        redirect(site_url('login'));
        exit;
    }

    $page = $this->io->get('page') ?? 1;
    $q    = trim($this->io->get('q') ?? '');
    $records_per_page = 5; 

    $all = $this->StudentsModel->page($q, $records_per_page, $page);
    $total_rows = $all['total_rows'];

    $this->pagination->set_options([
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ]);
    $this->pagination->set_theme('tailwind');
    $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('/').'?q='.$q);

    // 🟢 Data to pass to the view
    $data = [
        'users'      => $all['records'],
        'page'       => $this->pagination->paginate(),
        'user_name'  => $_SESSION['user_name'] ?? 'Guest'
    ];

    // 🟢 Now load the view with all data
    $this->call->view('getall', $data);
}

    function create(){
        if($this->io->method() == 'post'){
            // ✅ Validation rules
            $this->form_validation->name('firstname')->required();
            $this->form_validation->name('lastname')->required();
            $this->form_validation->name('email')->required()->valid_email();

            if($this->form_validation->run()){
                $data = [
                    'first_name' => $this->io->post('firstname'),
                    'last_name'  => $this->io->post('lastname'),
                    'email'      => $this->io->post('email')
                ];

                if($this->StudentsModel->insert($data)){
                    redirect(site_url(''));
                }else{
                    echo "Error in creating user.";
                }
            } else {
                $data['errors'] = $this->form_validation->get_errors();
                $this->call->view('create', $data);
            }
        } else {
            $this->call->view('create');
        }
    }
}

<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Validation\EventValidator;
use App\Core\DependencyInjector;
use App\Core\Request;

class EventController extends Controller
{
    private $service;

    public function __construct(DependencyInjector $di, Request $request)
    {
        parent::__construct($di, $request);
        $this->service = $di->get('ServiceFactory')->create('EventService', 'EventMapper');
    }

    public function index()
    {
        $events = $this->service->getAllEvents();

        if ($events) {
            $data = [];
            foreach ($events as $event) {
                array_push($data, (array) $event);
            }

            if ($data) {
                return $this->view->render('events/index', $data);  
            }
        }

        return $this->view->render('error');
    }

    public function show(int $id)
    {
        $result = $this->service->getEventById($id);

        if ($result) {
            $data = (array) $result;
            return $this->view->render('events/show', $data);
        }

        return $this->view->render('error');
    }

    public function create()
    {
        return $this->view->render('events/create');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $validator = new EventValidator($data);
        $validator->validate();

        if (!$validator->hasErrors()) {
            $message = $this->service->saveEvent($data);

            if (isset($message['error'])) {
                return $this->view->render('events/create', $data, $message);
            } else {
                $event = $this->service->getEventByName($data['name']);
                return $this->view->redirectWithMessage("/event/" . $event->getId(), $message['message']);
            }
        }

        return $this->view->render('events/create', $data, $validator->getErrors());
    }
}
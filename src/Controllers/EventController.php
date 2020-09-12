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
            return $this->view->render('events/index', $events);  
        }

        return $this->view->render('error');
    }


    public function show(int $id)
    {
        $event = $this->service->getEventById($id);

        if ($event) {
            return $this->view->render('events/show', $event);
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

        if (!$validator->hasErrors()) {
            $this->service->saveEvent($data);

            if (isset($this->service->message['error'])) {
                return $this->view->render('events/create', $data, $this->service->message);
            } else {
                $event = $this->service->getEventByName($data['name']);
                return $this->view->redirect("/event/" . $event->getId(), $this->service->message);
            }
        }

        return $this->view->render('events/create', $data, $validator->getErrors());
    }


    public function edit(int $id)
    {
        $event = $this->service->getEventById($id);

        if ($event) {
            $event->date = $this->service->convertDateToFormFormat($event->date);
            return $this->view->render('events/edit', (array)$event);
        }

        return $this->view->render('error');
    }


    public function update(int $id)
    {
        $data = $this->request->getPost();
        $validator = new EventValidator($data);

        if (!$validator->hasErrors()) {
            $this->service->updateEvent($data);

            if (isset($this->service->message['error'])) {
                return $this->view->render('events/edit', $data, $this->service->message);
            } else {
                return $this->view->redirect("/event/" . $id, $this->service->message);
            }
        }

        return $this->view->render('events/edit', $data, $validator->getErrors());
    }


    public function destroy(int $id)
    {
        $this->service->deleteEvent($id);

        if (isset($this->service->message['error'])) {
            return $this->view->redirect("/event/" . $id, $this->service->message);
        } else {
            return $this->view->redirect('/events', $this->service->message);
        }
    }
}
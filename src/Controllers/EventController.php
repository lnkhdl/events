<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Routing\{
    Request\Request,
    Response\ResponseInterface
};
use App\Core\DependencyInjector;
use App\Validation\EventValidator;

class EventController extends Controller
{
    private $service;

    public function __construct(Request $request, ResponseInterface $response, DependencyInjector $injector)
    {
        parent::__construct($request, $response, $injector);
        $this->service = $injector->get('ServiceFactory')->create('EventService', 'EventMapper');
    }


    public function index()
    {
        $events = $this->service->getAllEvents();

        if ($events) {
            return $this->response->render('events/index', $events);  
        }
    }


    public function show(int $id)
    {
        $event = $this->service->getEventById($id);

        if ($event) {
            return $this->response->render('events/show', $event);
        } else {
            throw new \Exception('Page not found', 404);
        }        
    }


    public function create()
    {
        return $this->response->render('events/create');
    }


    public function add()
    {
        $data = $this->request->getPost();
        $validator = new EventValidator($data);

        if (!$validator->hasErrors()) {
            $this->service->saveEvent($data);

            if (isset($this->service->message['error'])) {
                return $this->response->render('events/create', $data, $this->service->message);
            } else {
                $event = $this->service->getEventByName($data['name']);
                return $this->response->redirect("/event/" . $event->getId(), $this->service->message);
            }
        }

        return $this->response->render('events/create', $data, $validator->getErrors());
    }


    public function edit(int $id)
    {
        $event = $this->service->getEventById($id);

        if ($event) {
            $event->setDate($this->service->convertDateToFormFormat($event->getDate()));
            $data = $event->entityToArray($event);
            return $this->response->render('events/edit', $data);
        }
    }


    public function update(int $id)
    {
        $data = $this->request->getPost();
        $validator = new EventValidator($data);

        if (!$validator->hasErrors()) {
            $this->service->updateEvent($data);

            if (isset($this->service->message['error'])) {
                return $this->response->render('events/edit', $data, $this->service->message);
            } else {
                return $this->response->redirect("/event/" . $id, $this->service->message);
            }
        }

        return $this->response->render('events/edit', $data, $validator->getErrors());
    }


    public function destroy(int $id)
    {
        $this->service->deleteEvent($id);

        if (isset($this->service->message['error'])) {
            return $this->response->redirect("/event/" . $id, $this->service->message);
        } else {
            return $this->response->redirect('/events', $this->service->message);
        }
    }
}
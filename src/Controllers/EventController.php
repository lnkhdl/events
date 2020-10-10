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
    private $eventService;
    private $memberService;

    public function __construct(Request $request, ResponseInterface $response, DependencyInjector $injector)
    {
        parent::__construct($request, $response, $injector);
        $this->eventService = $injector->get('ServiceFactory')->create('EventService', 'EventMapper');
        $this->memberService = $injector->get('ServiceFactory')->create('MemberService', 'MemberMapper');
    }


    public function index()
    {
        $events = $this->eventService->getAllEvents();
        // If no events found, view template will handle it
        return $this->response->render('events/index', $events);  
    }


    public function show(int $id)
    {
        $event = $this->eventService->getEventById($id);
        
        if ($event) {
            $members = $this->memberService->getMembersByEventId($id);
            $data = array();
            $data[0] = $event;
            $data = array_merge($data, $members);
            return $this->response->render('events/show', $data);
        } else {
            throw new \Exception('Event not found - id: ' . $id . '.', 404);
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
            $this->eventService->saveEvent($data);

            if (isset($this->eventService->message['error'])) {
                return $this->response->render('events/create', $data, $this->eventService->message);
            } else {
                $event = $this->eventService->getEventByName($data['name']);
                return $this->response->redirect("/event/" . $event->getId(), $this->eventService->message);
            }
        }

        return $this->response->render('events/create', $data, $validator->getErrors());
    }


    public function edit(int $id)
    {
        $event = $this->eventService->getEventById($id);

        if ($event) {
            $event->setDate($this->eventService->convertDateToFormFormat($event->getDate()));
            $data = $event->entityToArray();
            return $this->response->render('events/edit', $data);
        } else {
            throw new \Exception('Event not found - id: ' . $id . '.', 404);
        }
    }


    public function update(int $id)
    {
        $data = $this->request->getPost();
        $validator = new EventValidator($data);

        if (!$validator->hasErrors()) {
            $this->eventService->updateEvent($data);

            if (isset($this->eventService->message['error'])) {
                return $this->response->render('events/edit', $data, $this->eventService->message);
            } else {
                return $this->response->redirect("/event/" . $id, $this->eventService->message);
            }
        }

        return $this->response->render('events/edit', $data, $validator->getErrors());
    }


    public function destroy(int $id)
    {
        $this->eventService->deleteEvent($id);

        if (isset($this->eventService->message['error'])) {
            return $this->response->redirect("/event/" . $id, $this->eventService->message);
        } else {
            return $this->response->redirect('/events', $this->eventService->message);
        }
    }
}
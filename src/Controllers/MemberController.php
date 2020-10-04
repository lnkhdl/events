<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Routing\{
    Request\Request,
    Response\ResponseInterface
};
use App\Core\DependencyInjector;
use App\Validation\MemberValidator;

class MemberController extends Controller
{
    private $eventService;
    private $memberService;

    public function __construct(Request $request, ResponseInterface $response, DependencyInjector $injector)
    {
        parent::__construct($request, $response, $injector);
        $this->eventService = $injector->get('ServiceFactory')->create('EventService', 'EventMapper');
        $this->memberService = $injector->get('ServiceFactory')->create('MemberService', 'MemberMapper');
    }

    public function create(int $event_id)
    {
        $data['event_id'] = $event_id;
        $data['event_name'] = $this->eventService->getEventNameById($event_id);
        return $this->response->render('members/create', $data);
    }

    public function add()
    {
        $data = $this->request->getPost();
        $validator = new MemberValidator($data);

        if (!$validator->hasErrors()) {
            $this->memberService->saveMember($data);

            if (isset($this->memberService->message['error'])) {
                return $this->response->render('members/create', $data, $this->memberService->message);
            } else {
                $event = $this->eventService->getEventById((int)$data['event_id']);
                return $this->response->redirect("/event/" . $event->getId(), $this->memberService->message);
            }
        }

        return $this->response->render('members/create', $data, $validator->getErrors());
    }

    public function edit(int $event_id, int $id)
    {
        $member = $this->memberService->getMemberById($id);

        if ($member) {
            $data = $member->entityToArray();
            $data['event_id'] = $event_id;
            $data['event_name'] = $this->eventService->getEventNameById($event_id);
            return $this->response->render('members/edit', $data);
        }
    }

    public function update(int $event_id, int $id)
    {
        $data = $this->request->getPost();
        $validator = new MemberValidator($data);

        if (!$validator->hasErrors()) {
            $this->memberService->updateMember($data);

            if (isset($this->memberService->message['error'])) {
                return $this->response->render('members/edit', $data, $this->memberService->message);
            } else {
                return $this->response->redirect("/event/" . $event_id, $this->memberService->message);
            }
        }

        return $this->response->render('events/edit', $data, $validator->getErrors());
    }

    public function destroy(int $event_id, int $id)
    {
        $this->memberService->deleteMember($id);

        if (isset($this->memberService->message['error'])) {
            return $this->response->redirect("/event/" . $event_id, $this->memberService->message);
        } else {
            return $this->response->redirect("/event/" . $event_id, $this->memberService->message);
        }
    }
}

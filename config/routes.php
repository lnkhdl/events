<?php

return [
    'get|/|EventController|index',
    'get|/index|EventController|index',
    'get|/contact|PageController|contact',
    'get|/events|EventController|listAll',
    'get|/event/{int}|EventController|show',
    'get|/event/create|EventController|create',
    'post|/event/add|EventController|add',
    'get|/event/{int}/edit|EventController|edit',
    'put|/event/{int}|EventController|update',
    'delete|/event/{int}|EventController|destroy',

    'get|/event/{int}/member/create|MemberController|create',
    'post|/event/{int}/member/add|MemberController|add',
    'get|/event/{int}/member/{int}/edit|MemberController|edit',
    'put|/event/{int}/member/{int}|MemberController|update',
    'delete|/event/{int}/member/{int}|MemberController|destroy',

    'get|/test/{int}/{string}|PageController|test',

    'get|/api/latest-events|EventController|index',
    'get|/api/events|EventController|listAll',
    'get|/api/event/{int}|EventController|show',
    'post|/api/event/add|EventController|add',
    'put|/api/event/{int}|EventController|update',
    'delete|/api/event/{int}|EventController|destroy',
    'post|/api/event/{int}/member/add|MemberController|add',
    'put|/api/event/{int}/member/{int}|MemberController|update',
    'delete|/api/event/{int}/member/{int}|MemberController|destroy',
];
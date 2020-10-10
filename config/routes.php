<?php

return [
    'get|/|PageController|index',
    'get|/index|PageController|index',
    'get|/about|PageController|about',
    'get|/contact|PageController|contact',

    'get|/events|EventController|index',
    'get|/event/{int}|EventController|show',
    'get|/event/create|EventController|create',
    'get|/event/{int}/edit|EventController|edit',
    'post|/event/add|EventController|add',
    'put|/event/{int}|EventController|update',
    'delete|/event/{int}|EventController|destroy',

    'get|/event/{int}/member/create|MemberController|create',
    'get|/event/{int}/member/{int}/edit|MemberController|edit',
    'post|/event/{int}/member/add|MemberController|add',
    'put|/event/{int}/member/{int}|MemberController|update',
    'delete|/event/{int}/member/{int}|MemberController|destroy',

    'get|/test/{int}/{string}|PageController|test'
];
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
    'get|/test/{int}/{string}|PageController|test'
];
<?php

class ContactController extends Controller
{
    public function index(): void
    {
        $this->view('contact/index', [
            'baruLogin' => false,
        ], 'style-contact.css');
    }
}

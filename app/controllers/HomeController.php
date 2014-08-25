<?php

class HomeController extends BaseController {

	public function showHomePage()
	{
		return View::make('home');
	}
}
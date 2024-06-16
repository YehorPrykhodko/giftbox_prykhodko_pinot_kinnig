<?php
namespace gift\appli\app\exceptions;
use Slim\Exception\HttpSpecializedException;

class TeaPotException extends HttpSpecializedException{
	protected $code = 418;
	protected  $message = 'Im a teapot';
	protected string $title = "418 I'm a teapot";
	protected string $description = "No cofee";
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
	// public function index(Request $request)
	// {
	// 	$secao 		= 'cadastro';
	// 	$titulo 	= 'Informações';
	// 	return view('site.usuarios', compact('secao', 'titulo'));
	// }
	
	public function index(Request $request)
	{
		return view('site.home');
	}

	public function dados_bancarios(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.dados_bancarios';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'Área do usuário';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function editar_dados(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.editar_dados';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'Área do usuário';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function nova_senha(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.nova_senha';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'Senha';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function transferencia(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.transferencia';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'RESGATAR VALORES';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function meus_aniversarios(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.meus_aniversarios';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'ÁREA DO USUÁRIO';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function meus_aniversarios_excluir(Request $request)
	{
		$method = $request->method();
		$view 	= 'site.inc.usuarios.meus_aniversarios_excluir';
		if ($request->ajax()) {
			return view($view);
		} else {
			$titulo = 'ÁREA DO USUÁRIO';
			return view('site.usuarios', compact('view', 'titulo'));
		}
	}

	public function login(Request $request)
	{

	}

	public function usuarios(Request $request)
	{
		$secao 		= 'cadastro';
		$titulo 	= 'RESGATAR vALORES';
		return view('site.usuarios', compact('secao', 'titulo'));
	}
}

<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Produto;
use Illuminate\Http\Request;
class ProdutosController extends Controller
{
	public function index()
	{
		$produtos = Produto::all();
		return view('produtos.index',['produtos'=>$produtos]);
	}
	public function create()
	{
		return view('produtos.create');
	}	
	public function store(Request $request)
	{
		$input = $request->all();
		Produto::create($input);
		return redirect('produtos');
	}
}
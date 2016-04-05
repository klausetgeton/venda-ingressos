<?php 

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Produto;
use App\Http\Requests\ProdutoRequest;

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

	public function store(ProdutoRequest $request)
	{
		$input = $request->all();
		Produto::create($input);
		return redirect()->route('produtos');
	}

	public function destroy($id)
	{
		Produto::find($id)->delete();
		return redirect('produtos');
	}

	public function edit($id)
	{
		$produto = Produto::find($id);
		return view('produtos.edit', compact('produto'));
	}

	public function update(ProdutoRequest $request, $id)
	{
		$produto = Produto::find($id)->update($request->all());
		
		return redirect()->route('produtos');
	}
}
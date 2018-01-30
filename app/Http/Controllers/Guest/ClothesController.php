<?php
namespace App\Http\Controllers\Guest;

use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use App\Models\Festas;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ClothesController extends Controller {
	private $party;
	private $clothes;
	private $clothesAvalible;

	public function __construct(Request $request) {
		$this->middleware(function ($request, $next) {
			$this->party = Festas::where('slug', $request->route('slug'))->firstOrFail();

			if ($this->party->ativo == 0 && session('client_id') !== $this->party->clientes_id) {
				abort(404, 'Página não encontrada.');
			}

			$this->clothes = $this->party
							   ->produto()
							   ->where('categoria', 'roupa');

			$clothesTotal = $this->clothes->count();
			$this->clothesAvalible = $this->clothes->whereNull('nome');
			
			$percent = $this->clothesAvalible->count() > 0 ? round(($this->clothesAvalible->count() * 100) / $clothesTotal, 0, PHP_ROUND_HALF_EVEN) : 0;
			view()->share('percent', $percent);

			return $next($request);
		});
	}

	public function index(Request $request, $festa_id = null)
	{
		$party = $this->party;
		$products = $this->clothesAvalible;

		if ($request->busca) {
			$products = $products->where('titulo', 'LIKE', '%' . $request->busca . '%');
		}

		if ($request->ordenacao) {
			switch ($request->ordenacao) {
				case 'AZ':
					$products = $products->orderBy('titulo', 'ASC');
					break;
				case 'ZA':
					$products = $products->orderBy('titulo', 'DESC');
					break;
				case 'maiorPreco':
					$products = $products->orderBy('preco_venda', 'DESC');
					break;
				case 'menorPreco':
					$products = $products->orderBy('preco_venda', 'ASC');
					break;
			}
		}

		$products = $products->get();

		return view('convidado.roupas.index', compact('request', 'party', 'products'));
	}

	public function mensagem(Request $request, $party_id)
	{
		$party = $this->party;
		return view('convidado.roupas.mensagem', compact('request', 'party'));
	}

	public function detalhe(Request $request, $party_id, $product_id)
	{
		$party = $this->party;
		$product = Produtos::find($product_id);

		if (empty($product)) {
			abort(404, 'Página não encontrada.');
		}

		return view('convidado.roupas.detalhe', compact('request', 'party', 'product'));
	}


	public function compraOnline(Request $request, $festa_id, $product_id)
	{
		$party = $this->party;
		$product = Produtos::find($product_id);

		if (empty($product)) {
			abort(404, 'Página não encontrada.');
		}

		return view('convidado.roupas.compra-online', compact('request', 'party', 'product'));
	}

	public function compraOnlineSubmeter (Request $request, $festa_id, $product_id) {
		$product = Produtos::find($product_id);

		$data = [
			'items' => [
				[
					'id' => $product->id,
					'description' => $product->titulo,
					'quantity' => '1',
					'amount' => $product->preco_venda
				]
			],
			'sender' => [
				'name' => $request->nome,
				'email' => $request->email,
				'documents' => [
					[
						'number' => preg_replace('/[^0-9]/', '', $request->cpf),
						'type' => 'CPF'
					]
				],
				'phone' => preg_replace('/[^0-9]/', '', $request->tel),
				'bornDate' => $this->formatDate($request->nascimento),
			]
		];

		$checkout = PagSeguro::checkout()->createFromArray($data);
		$credentials = PagSeguro::credentials()->get();
		$information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
		if ($information) {
			return redirect("https://pagseguro.uol.com.br/v2/checkout/payment.html?code=" . $information->getCode());
		}
	}

	private function formatDate ($date) {
		$date = explode('/', $date);
		return $date[2] . '-' . $date[1] . '-' . $date[0];
	}
}
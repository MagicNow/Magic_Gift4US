@extends('convidado/master')

@section('content')

	<div class="preview dashboard col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="preview-header">
			<div class="preview-header-decor"><img src="{{ asset('assets/site/images/img-convidado-1.png') }}" alt="Festa" class="preview-banner-item-image"></div>
			<div class="preview-header-name">Heitor</div>
			<div class="preview-header-info">30.10 | 16:30<br>5 ANOS</div>
		</div>
		<div class="sub-menu text-center">
			<a class="confirm-btn active" href="#"><img src="{{ asset('assets/site/images/img-check-out.png') }}" alt="" /></a>
			<a class="gifts-btn" href="#"><img src="{{ asset('assets/site/images/img-presente-in.png') }}" alt="" /></a>
			<a class="message-btn" href="#"><img src="{{ asset('assets/site/images/img-mensagem-out.png') }}" alt="" /></a>
			<a class="map-btn" href="#"><img src="{{ asset('assets/site/images/img-maps-out.png') }}" alt="" /></a>
		</div>
	</div>
	
	<div class="dashboard col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="container brinquedosLista">
			
			<img src="{{ asset('assets/site/images/presentinho_aniversario_presente_roupas_ent06.png') }}" class="presentinho col-xs-5 col-sm-5 col-md-5" alt="">
			
			<div class="gifts-container row col-md-offset-2">
				<div class="gifts-box-number col-md-3">
					<div class="input-group gifts-filter-search pull-right" method="get">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="search" class="form-control gifts-filter-search-input" name="busca" placeholder="presente que está procurando" value="">
					</div>
					<div class="gifts-filter-select-container pull-right">
						<select class="gifts-filter-select select2-hidden-accessible" name="ordenacao" tabindex="-1" aria-hidden="true">
							<option value=""></option>
							<option value="maiorPreco">Maior preço</option>
							<option value="menorPreco">Menor preço</option>
							<option value="AZ">A-Z</option>
							<option value="ZA">Z-A</option>
							<option value="MaisVendidos">Mais vendidos</option>
							<option value="Lancamentos">Lançamento</option>
						</select>
						<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100px;">
							<span class="selection">
								<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-ordenacao-3c-container">
									<span class="select2-selection__rendered" id="select2-ordenacao-3c-container">
										<span class="select2-selection__placeholder">ordenar por</span>
									</span>
									<span class="select2-selection__arrow" role="presentation">
										<b role="presentation"></b>
									</span>
								</span>
							</span>
							<span class="dropdown-wrapper" aria-hidden="true"></span>
						</span>
					</div>
					<div class="porcentagem">
						<span style="width:25%"></span>
						<strong>25% disponivel</strong>
					</div>
				</div>
				<div class="col-md-9 dados-container">
					<div class="row">
						<div class="gifts-filter col-md-12">
							<ul class="gifts-filter-categories">
								<li class="gifts-filter-categories-item">
									<a href="http://vagrant.gift4us/public/usuario/meus-aniversarios/festa/3/presentes/brinquedos">
										<i class="gifts-filter-categories-icon gifts-filter-categories-toys"></i>
										<span>brinquedos</span>
									</a>
								</li>
								<li class="gifts-filter-categories-item">
									<a href="http://vagrant.gift4us/public/usuario/meus-aniversarios/festa/3/presentes/roupas">
										<i class="gifts-filter-categories-icon gifts-filter-categories-clothes"></i>
										<span>roupas</span>
									</a>
								</li>
								<li class="gifts-filter-categories-item active">
									<a href="#">
										<i class="gifts-filter-categories-icon gifts-filter-categories-quotas"></i>
										<span>cotas</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<ul class="gifts-list" data-festa-id="3">
						<li class="col-md-12 gifts-item gifts-item-detalhe" data-id="1">
							<div class="row">
								<p class="gifts-item-title">Ver Detalhes</p>
								<div class="col-md-4">
									<img src="http://recursos.pandabrinquedos.com.br/Imagem/Produto/235/254547/star-wars-radio-relogio-com-alarme-darth-vader-jazwares-stwr0001-68180.jpg" class="gifts-item-image" width="100%">
								</div>
								<div class="gifts-item-content col-md-8">
									<h5 class="gifts-item-title bgC">STAR WARS-RÁDIO RELÓGIO COM ALARME DARTH VADER JAZWARES STWR0001</h5>
									<p class="gifts-item-price-description">Valor total do presente:</p>
									<p class="gifts-item-price-value bgC">R$ 4.000,00</p>
									<p class="gifts-item-price-description">Número de cotas</p>
									<p class="gifts-item-price-value bgC">8 cotas</p>
									<p class="gifts-item-price-description">Valor da cota para presente</p>
									<p class="gifts-item-price-value bgC">R$ 500,00</p>
									<div class="col-md-6">
										<a href="#" class="my-birthday-create-button-small">Voltar para<br />a lista de COTAS</a>
									</div>
									<div class="col-md-6">
										<a href="#" class="my-birthday-create-button-small">Quero comprar online agora</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')

@endsection
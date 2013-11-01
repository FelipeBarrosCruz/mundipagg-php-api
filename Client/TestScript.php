<?php
include_once "MundiPaggServiceClient.php";

const MerchantKey = "8A2DD57F-1ED9-4153-B4CE-69683EFADAD5";

$orderRequest = CreateOrder(); // Creates an order


$client = new MundiPaggServiceClient();

$client->CreateOrder($orderRequest);

function CreateOrder() {
	$orderRequest = new CreateOrderRequest();

	// Campos principais do objeto CreateOrderRequest
    //$orderRequest->CurrencyIsoEnum = CurrencyIsoEnum::BRL;
	$orderRequest->CurrencyIsoEnum = "BRL";
	$orderRequest->AmountInCents = 2000; // 4000; 
	$orderRequest->Retries = 0;
	$orderRequest->OrderReference = "SDK-PHP - Teste de integracao - Matheus AR";

	// Chave de loja de exemplo, informe aqui sua chave de loja 
	$orderRequest->MerchantKey = MerchantKey;

	//// CART�O 1
	// Cria��o de uma transa��o de cart�o de cr�dito 
	$ccTransaction1 = new CreditCardTransaction();
	$ccTransaction1->AmountInCents = 1000;
	$ccTransaction1->CreditCardNumber = "1234567890123456";
	// N�mero do cart�o de cr�dito
	$ccTransaction1->HolderName = "Maria do Carmo";
	$ccTransaction1->SecurityCode = "123";
	$ccTransaction1->ExpMonth = 10;
	$ccTransaction1->ExpYear = 17;
	$ccTransaction1->CreditCardBrandEnum = CreditCardBrandEnum::Visa;
	$ccTransaction1->PaymentMethodCode = 1;
	// Define o tipo da autoriza��o
	$ccTransaction1->CreditCardOperationEnum = CreditCardOperationEnum::AuthAndCapture; // Confirma��o instant�nea

	// Adiciona as transa��es no OrderRequest
	$orderRequest->CreditCardTransactionCollection = array ( $ccTransaction1 );
	
	return $orderRequest;
}


?>
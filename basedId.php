<?php
	/**
	 * @author Eduardo Ribeiro <eduardo@psicomanger.com.br>
	 * @name sendMessage
	 * @var APP_ID - E o ID da Aplicação
	 * @var USER_ID - É o ID dos usuários que receberão as notificações
	 * @var title - É o título da notificação, você pode definir um para cada língua
	 * @var content_msg - É o conteúdo na notificação, como dito, você também pode definir um para cada língua
	 * @param none
	 * @return response - Retorno do servidor do OneSignal, mostrando se a requisição terminou com sucesso ou fracasso
	 */
	function sendMessage(){
		$APP_ID = "ONESIGNAL APP ID";
		$USER_ID = "PLAYER_ID do Usuário";
		
		$title = "Título da Mensagem";
		$content_msg = "Conteúdo da Mensagem";

		/**
		 * Headings e Contents Precisa ter conteudo em ingles 
		 */

		$heading = array(
			"en" => $title,
			"pt" => $title
		);
		$content = array(
			"en" => $content_msg,
			"pt" => $content_msg
		);
		
		$fields = array(
			'app_id' => $APP_ID,
			'include_player_ids' => array(
        $USER_ID
      ),
			'data' => array("foo" => "bar"),
			'headings' => $heading,
			'contents' => $content
		);
		
		$fields = json_encode($fields);
    	print("\nJSON sent:\n");
    	print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
	print("\n");
?>
<?php

	require_once(__DIR__ . '/../config/config.php');

	class JWT {
		
		public static function generate(array $header, array $payload, int $validity): string {

			if($validity > 0){
				$now = new DateTime();
				$expiration = $now->getTimestamp() + $validity;
				$payload['iat'] = $now->getTimestamp();
				$payload['exp'] = $expiration;
			}

			// Encodage du header et du payload
			$header64base = base64_encode(json_encode($header));
			$payload64base = base64_encode(json_encode($payload));
		
			// On nettoie les valeurs encodées (on supprime les +, /, =)
			$header64base = str_replace(['+', '/', '='], ['-', '_', ''], $header64base);
			$payload64base = str_replace(['+', '/', '='], ['-', '_', ''], $payload64base);
		
			// Création de la signature
			$secret = base64_encode(SECRET);
			$signature = hash_hmac('sha256', $header64base . '.' . $payload64base, SECRET, true);
			$signature64base = base64_encode($signature);
			$signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature64base));
		
			// Création du token
			$jwt = $header64base . '.' . $payload64base . '.' . $signature;

			return $jwt;
		}

		public static function check(string $jwt): bool {
			$header = self::getHeader($jwt);
			$payload = self::getPayload($jwt);

			$verifToken = self::generate($header, $payload, 0);

			return $verifToken == $jwt;
		}

		// Cette méthode permet de récupérer le header du token
		public static function getHeader(string $jwt): array {
			$jwt = explode('.', $jwt);
			// Décodage du header
			$header = json_decode(base64_decode($jwt[0]), true);
			return $header;
		}

		// Cette méthode permet de récupérer le payload du token
		public static function getPayload(string $jwt): array {
			$jwt = explode('.', $jwt);
			// Décodage du payload
			$payload = json_decode(base64_decode($jwt[1]), true);
			return $payload;
		}

		// Cette méthode permet de vérifier si le token est encore valide
		public static function isValid(string $jwt): bool {
			$payload = self::getPayload($jwt);
			$now = new DateTime();
			$now = $now->getTimestamp();
			return $now < $payload['exp'];
		}
	}





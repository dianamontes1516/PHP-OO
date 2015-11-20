<?php
/* Modificación 18.07.2015
 * se valida cadenas mediante expresiones regulares.
 * En algunos casos si la cadena es vacia se evalua a falso
 * Lo cual no es muy conveniente, ya que solo se desea que
 * falle la validación cuando la cadena diferente a la vacia
 * no cumple con la expresión regulara.
 * Si en la validación se desea que falle cuando tiene valor nulo
 * la validación debe incluir required.
 * La modificación consiste en que solo se evaluen a falso
 * las cadenas diferentes de la vacia cuando no cumplen
 * con la respectiva ER.
 */

/**
* Biblioteca de funciones para seguridad y validaciones
*/
class Validator {

	/**
	 * Expresión regular para una CURP
	 *
	 * TODO: Encontrar la manera de introducir esta constante en una línea más
	 * corta (80 columnas)
	 *
	 */
	const CURP_REGEX = "/[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}/";

	/*
	 *Expresión regular para validar un rfc
	 */
	const RFC_REGEX = "/^[a-zA-Z]{4,4}[0-9]{6}[a-z]|[A-Z]|[0-9]{3}$/";

	/**
	 * Expresión regular para un email
	 */
	const MAIL_REGEX = "/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+/";

	/**
	 * Expresión regular para un código postal
	 */
	const CP_REGEX = "/^[0-9]{5}$/";

	/**
	 * Expresión regular para una cadena
     * que contenga calle y número
     * Puede contener letas, números, '.', '-' y espacios
	 */
	const CALLE_NUMERO_REGEX = "/^[0-9A-Za-z ,.\-\/ñáéíóúÑÁÉÍÓÚ]+$/";

	/**
	 * Expresión regular para una cadena sin números y caracteres especiales
	 */
	//const NOMBRE_REGEX = "/[a-zA-Z]+/";
	//const NOMBRE_REGEX = "/[A-Z]'?[- a-zA-Z]( [a-zA-Z])*/"; //se cambio la expresion regular para que acepte acentos y ñ Ñ
	const NOMBRE_REGEX = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{0,60})$/";

    /**
     * Expresión regular para teléfonos no muy Mexicanos
     */
	const TELEPHONE_REGEX = "/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/";

    /**
     * Expresión regular para teléfonos y celulares Mexicanos
     */
	const TELEFONO_REGEX = "/^[1-9]{1}[0-9]{7,9}$/";

	/**
	 * Expresión regular para operadores de comparación
	 */
	const OPERADOR_REGEX = "/^[<>=]$/";

	/**
	 * Expresión regular para campos alfanuméricos
	 */
	const ALPHANUMERIC_REGEX = "/^[a-zA-Z0-9  ñáéíóúÑÁÉÍÓÚ]+$/";


	/**
	 * Expresión regular para campos alfabéticos
	 */
	const ALPHA_REGEX = "/^([a-zA-Z ñáéíóúÑÁÉÍÓÚ])+$/";

	/**
	 * Método para verificar un CURP mediante una expresión regular
	 * @param curp - string - CURP a validar
	 */
	public function curp($curp) {
		return preg_match(self::CURP_REGEX, $curp)
			?: 'Ingresa una CURP válida en el campo ?';
	}

	/**
	 * Método para verificar un RFC mediante una expresión regular
	 * @param rfc - string - RFC a validar
	 */
	public function rfc($rfc) {
		return preg_match(self::RFC_REGEX, $rfc)
			?: 'Ingresa un RFC válido en el campo ?';
	}

	/**
	 * Método para verificar un código postal mediante una expresión regular
	 * @param cp - string - cp a validar
	 */
	public function codigoPostal($cp) {
		return preg_match(self::CP_REGEX, $cp) || !$cp
			?: 'Ingresa un código postal válido en el campo ?';
	}

	/**
	 * Método para verificar un email mediante una expresión regular
	 * @param email - string - email a validar
	 */
	public function mail($mail) {
		return preg_match(self::MAIL_REGEX, $mail) || !$mail
			?: 'Ingresa un correo válido en el campo ?';
	}

	/**
	 * Método para verificar un nombre/apellidos mediante una expresión regular
	 * Consiste en verificar que no contiene números o caracteres especiales
	 * @param nombre - string - cadena a validar
	 */
	public function nombre($nombre) {
		return preg_match(self::NOMBRE_REGEX, $nombre) || !$nombre
			?: 'Ingresa un nombre/apellido válido en el campo ?';
	}

	/**
	 * Método para verificar el nombre de una calle y el numero de casa
	 * Consiste en verificar que no contiene números o caracteres especiales
	 * @param calleNumero - string - cadena a validar
	 */
	public function calleNumero($calleNumero) {
		return preg_match(self::CALLE_NUMERO_REGEX, $calleNumero) || !$calleNumero
			?: 'Campo inválido. Solo letras, números, ., - / ?';
	}

	/**
	 * Método para verificar un teléfono mediante una expresión regular
	 * @param telefono - string - telefono a validar
	 */
	public function telefono($telefono) {
		return preg_match(self::TELEPHONE_REGEX, $telefono)
			?: 'Ingresa un teléfono válido en el campo ?';
	}

	/**
	 * Método para verificar un teléfono mediante una expresión regular
     * TELEFONO_REGEX
	 * @param telefono - string - telefono a validar
	 */
	public function telefonoM($telefono) {
		return preg_match(self::TELEFONO_REGEX, $telefono) || !$telefono
			?: 'Ingresa un teléfono válido en el campo ?';
	}

	/**
	 * Método para verificar un operador de comparación
         * mediante una expresión regular
         * OPERADOR_REGEX
	 * @param telefono - string - telefono a validar
	 */
	public function operador($op) {
		return preg_match(self::OPERADOR_REGEX, $op)
			?: 'Ingresa un operador (<,>,=) válido en el campo ?';
	}

	/**
	 * Método de validación de fechas recibidas por input
	 * @param fecha - string - cadena a validar
	 */
	public function fecha($fecha) {
        date_default_timezone_set('UTC');
	    $dateTime = DateTime::createFromFormat('d-m-Y', $fecha);
	    return (($dateTime && $dateTime->format('d-m-Y') == $fecha)
                                                        || !$fecha)
	    	?: 'Ingresa una fecha válida en el campo ?';
	}

	/**
	 * Método de validación de fechas recibidas por input
	 * @param fecha - string - cadena a validar
	 */
	public function fechaDiag($fecha) {
	    $dateTime = DateTime::createFromFormat('d/m/Y', $fecha);
	    return ($dateTime && $dateTime->format('d/m/Y') == $fecha)
	    	?: 'Ingresa una fecha válida en el campo  ?';
	}

	/**
	 * Método de validación de fechas recibidas por input
	 * @param fecha - string - cadena a validar
	 */
	public function fechaGringa($fecha) {
        date_default_timezone_set('UTC');
	    $dateTime = DateTime::createFromFormat('Y-m-d', $fecha);
	    return (($dateTime && $dateTime->format('Y-m-d') == $fecha) || !$fecha)
	    	?: 'Ingresa una fecha válida en el campo ?';
	}

	/**
	 * Método de validación de números
	 * @param numero - string - cadena a validar
	 */
	public function numero($numero) {
		return is_numeric($numero) || !$numero
			?: 'Ingresa un número válido en el campo ?';
	}

	/**
	 * Método para validación de campos alfanuméricos
	 * @param value - string - cadena a validar
	 */
	public function alphanumeric($value) {
		return preg_match(self::ALPHANUMERIC_REGEX, $value) || !$value
			?: 'Ingresa sólo caracteres alfanuméricos en el campo ?';
	}

	/**
	 * Método para validación de campos alfanuméricos
	 * @param value - string - cadena a validar
	 */
	public function alphabetic($value) {
		if(strlen($value)==0){
			return True;
		}
		return preg_match(self::ALPHA_REGEX, $value)
			?: 'Ingresa sólo letras en el campo ?';
	}

	/**
	 * Método de validación de cadena no vacía
	 * @param element - string - cadena a validar
	 */
	public function required($element) {
		return strlen($element) > 0
			?: 'El campo ? es un campo obligatorio';
	}

	/**
	 * Método de validación de digitos en el código programático
	 * @param value - string - cadena a evaluar
	 * @param digitos - int - longitud requerida de la cadena
	 */
	public function cp($value, $digitos) {
	   return (is_numeric($value) && strlen($value) == $digitos)
	   		?: 'El código programático no es válido';
	}

	/**
	 * Método que transforma una cadena en camelCase a texto (e.g. camel case)
	 * @param input - string - cadena a convertir de camelCase
	 */
	public function camelCaseToText($input) {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode(' ', $ret);
	}

	/**
	 * Método que transforma una cadena en camelCase a texto (e.g. camel case)
	 * @param input - string - cadena a convertir de camelCase
	 */
	public function cadena($input) {
          return preg_match('/([A-Za-z][A-Za-z]*/', $input)?: "Ingrese solo letras";
	}

	/**
	 * Método que realiza una validación de campos en base de una arreglo de
	 * 	reglas. En el cuál cualquier elemento en 'rules' declara un elemento
	 * 	de caracter obligatorio y debe existir en 'values', posteriormente
	 * 	se realiza una validación en base a la regla que se ha propuesto
	 * 	para esa llave en el arreglo de 'rules'
	 *
	 * @param values - array - elementos a validar con el parámetro rules
	 * @param rules - array - reglas de validación en un arreglo
	 * @return false en caso de no haber errores, array de errores en otro caso
	 * validate(['nombre'=>$daniel],['nombre'=>['cadena','rfc...'])
	 */
	public static function validate($values, $rules) {
		$errors = array();
		foreach (array_keys($values) as $key) {
			if (array_key_exists($key, $rules)) {
				$sub_rules = $rules[$key];
				if (!is_array($sub_rules)) {
					$sub_rules = [$sub_rules];
				}
				foreach ($sub_rules as $sub_rule) {

					$params = [$values[$key]];
					if (strpos($sub_rule, ':')) {
						$exp = explode(':', $sub_rule);
						$sub_rule = array_shift($exp);
						array_push($params, array_shift($exp));
					}

					$validation = call_user_func_array(
						[self, $sub_rule], $params
					);

					if (is_string($validation)) {
						if (strpos($validation, '?')) {
							$input = ucwords(self::camelCaseToText($key));
							$validation = str_replace('?', $input, $validation);
						}
						$errors[] = $validation;
					}
				}
			}
		}
		return empty($errors) ? false : $errors;
	}
}
?>
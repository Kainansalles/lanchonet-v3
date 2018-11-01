<?php
/**
 * Class Helper - Helper
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Helpers;

use Valitron\Validator;

class Helper {
    /**
     * Método responsavel por realizar validação das requisições
     *@param Post Request
     *@return JSON
     */
    public static function ValidaRequest($data, $requiredfields = array(), $rules = array()){
        $v = new Validator($data);
        if(!empty($requiredfields)){
            foreach ($requiredfields as $key) {
                $v->rule('required', $key);
            }
        }
        if(!empty($rules)){
            $v->rules($rules);
        }
        if($v->validate()) {
            return true;
        } else {
            echo json_encode($v->errors());
        }
    }
    /**
     * Retorna as mensagens em português
     *@return array
     */
    public static function messages(){
        return [
            'accepted'             => ':attribute deve ser aceito.',
            'active_url'           => ':attribute não é uma URL válida.',
            'after'                => ':attribute deve ser uma data depois de :date.',
            'alpha'                => ':attribute deve conter somente letras.',
            'alpha_dash'           => ':attribute deve conter letras, números e traços.',
            'alpha_num'            => ':attribute deve conter somente letras e números.',
            'array'                => ':attribute deve ser um array.',
            'before'               => ':attribute deve ser uma data antes de :date.',
            'between'              => [
                'numeric' => ':attribute deve estar entre :min e :max.',
                'file'    => ':attribute deve estar entre :min e :max kilobytes.',
                'string'  => ':attribute deve estar entre :min e :max caracteres.',
                'array'   => ':attribute deve ter entre :min e :max itens.',
            ],
            'boolean'              => ':attribute deve ser verdadeiro ou falso.',
            'confirmed'            => 'A confirmação de :attribute não confere.',
            'date'                 => ':attribute não é uma data válida.',
            'date_format'          => ':attribute não confere com o formato :format.',
            'different'            => ':attribute e :other devem ser diferentes.',
            'digits'               => ':attribute deve ter :digits dígitos.',
            'digits_between'       => ':attribute deve ter entre :min e :max dígitos.',
            'email'                => ':attribute deve ser um endereço de e-mail válido.',
            'exists'               => 'O :attribute selecionado é inválido.',
            'filled'               => ':attribute é um campo obrigatório.',
            'image'                => ':attribute deve ser uma imagem.',
            'in'                   => ':attribute é inválido.',
            'integer'              => ':attribute deve ser um inteiro.',
            'ip'                   => ':attribute deve ser um endereço IP válido.',
            'json'                 => ':attribute deve ser um JSON válido.',
            'max'                  => [
                'numeric' => ':attribute não deve ser maior que :max.',
                'file'    => ':attribute não deve ter mais que :max kilobytes.',
                'string'  => ':attribute não deve ter mais que :max caracteres.',
                'array'   => ':attribute não pode ter mais que :max itens.',
            ],
            'mimes'                => ':attribute deve ser um arquivo do tipo: :values.',
            'min'                  => [
                'numeric' => ':attribute deve ser no mínimo :min.',
                'file'    => ':attribute deve ter no mínimo :min kilobytes.',
                'string'  => ':attribute deve ter no mínimo :min caracteres.',
                'array'   => ':attribute deve ter no mínimo :min itens.',
            ],
            'not_in'               => 'O :attribute selecionado é inválido.',
            'numeric'              => ':attribute deve ser um número.',
            'regex'                => 'O formato de :attribute é inválido.',
            'required'             => 'O campo :attribute é obrigatório.',
            'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
            'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
            'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
            'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
            'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
            'same'                 => ':attribute e :other devem ser iguais.',
            'size'                 => [
                'numeric' => ':attribute deve ser :size.',
                'file'    => ':attribute deve ter :size kilobytes.',
                'string'  => ':attribute deve ter :size caracteres.',
                'array'   => ':attribute deve conter :size itens.',
            ],
            'string'               => ':attribute deve ser uma string',
            'timezone'             => ':attribute deve ser uma timezone válida.',
            'unique'               => ':attribute já está em uso.',
            'url'                  => 'O formato de :attribute é inválido.',
        ];
    }
    /**
     * Retonar somente o nome da imagem
     *@param String
     *@return String
     */
    public static function getNameImages($string){
        if (strpos($string, 'com/lanchonet') !== false) {
            return substr ( $string ,strpos($string, 'com/lanchonet') + 4, strlen($string));
        }
        return substr ( $string ,strpos($string, 'com/') + 4, strlen($string));
    }
}
<?php

namespace Vannyvann\Formgroup;

class FormgroupParams
{
    protected $params = [];
    protected $casts = [];
    protected $group = null;
    protected $config = [];
    protected $errors = null;
    public $error = null;

    public function __construct($params, $errors, $options, $config)
    {
        $this->params = $params;
        $this->options = $options;
        $this->errors = $errors;
        $this->config = $config;
        $this->classes = [];

        $this->replaceCasts();
        $this->replaceDefaults();
        $this->replaceError();

        return $this;
    }

    public function basicOptions($options = [])
    {
        $this->classes[] = array_get($options, 'class');
        $this->classes[] = array_get($this->get('class'), 'class');
        $params = array_merge($this->params, $options);
        $params['class'] = implode(' ',$this->classes);

        $params = $this->replaceHidden($params);

        $output = [];
        foreach($params as $key => $param){
            $output[] = $this->tagParam($key, $param);
        }

        return implode(' ', $output);
    }

    private function replaceCasts()
    {
        $casts = array_get($this->options, 'casts', []);
        foreach($casts as $index => $cast){
            if(array_get($this->params, $index)){

                // Check if param already set to avoid overwriting and save value
                if(!array_key_exists($cast, $this->params)){
                    $this->params[$cast] = $this->params[$index];
                }

                // Remove numeral index
                unset($this->params[$index]);
            }
        }
    }

    private function replaceHidden($params)
    {
        $hiddens = array_get($this->options, 'hidden', []);
        $hiddens = array_merge($hiddens, $this->config('hidden'));
        foreach ($hiddens as $hidden) {
            unset($params[$hidden]);
        }
        return $params;
    }

    private function replaceError()
    {
        if($this->errors && $this->errors->has($this->get('name'))){
            $this->error = $this->errors->first($this->get('name'));
            $this->classes[] = $this->config('error');
        }
    }

    private function replaceDefaults()
    {

        // Set Default Id field
        if(!$this->get('id') && $this->config('id')){
            $this->params['id'] = $this->replaceMask($this->config('id'));
        }else{
            $this->params['id'] = uniqid();
        }

        // Set default Label & Make it nice looking
        $label = $this->get('label');
        if(!$label && $this->config('label.auto')){

            $label = $this->replaceMask($this->config['label']['auto']);

            // Replace options
            foreach ($this->config('label.replace') as $key => $value) {
                $label = is_int($key) ?
                               str_replace($value, '', $label) :
                               str_replace($key, $value, $label);
            }

            // Apply Capitalize option (function) if set
            if($capitalize = $this->config('label.capitalize')){
                $label = $capitalize($label);
            }
            $this->params['label'] = $label;
        }
    }

    private function replaceMask($mask)
    {
        foreach ($this->params as $name => $value) {
            if(!is_string($value)) continue;
            $mask = str_replace ('@' . $name, $value, $mask);
        }
        return $mask;
    }

    private function tagParam($key, $param)
    {
        if($param === false){
            return null;
        }

        // if params set as [... 'param']
        if(is_integer($key)){
            return $param;
        }

        // if param set as [... 'param' => true]
        if($param === true){
            return $key;
        }

        // if param set as [... 'key' => 'param']
        return $key . "=\"" . $param ."\"";
    }

    public function get($name, $default = null)
    {
        return array_get($this->params, $name, $default);
    }

    public function set($name, $value)
    {
        $this->params[$name] = $value;
    }

    private function config($name, $default = null)
    {
        return array_get($this->config, $name, $default);
    }


}

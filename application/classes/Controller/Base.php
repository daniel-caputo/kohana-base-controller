<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Base extends Kohana_Controller {
    
    protected $data = array();
    
    protected $view = TRUE;
    
    protected $aside = array();
    
    protected $view_error = FALSE;

    function after()
    {
       
        foreach($this->data as $key => $value)
        {
            View::set_global($key, $value);
        }
        
        if($this->view !== FALSE)
        {
            $dir        = $this->request->directory();
            $controller = implode('/', explode('_', $this->request->controller()));
            $action     =  $this->request->action();

            $path = strtolower($dir.'/'.$controller.'/'.$action);

           if (!empty($this->asides))
           {
           
            
                foreach ($this->asides as $name => $file)
                {
                    $name = 'yield_'.$name;
                    $file = View::factory($file)->render();
                    View::bind_global($name, $file);
                }
           }
            
           $yield = null;

            if( Kohana::find_file("views", $path) )
            {
                $yield = View::factory($path)->render();
            }
            else
            {
                if($this->view_error === TRUE)
                {
                   die("View file {$path} doesn't exist.");
                }                
            }
            
            if( Kohana::find_file("views", "layouts/".$controller) )
            {
                $yield = View::factory("layouts/".$controller)->bind('yield', $yield)->render();
            }
            
            if ( Kohana::find_file("views", "layouts/".$dir) )
            {
                $yield = View::factory("layouts/".$dir)->bind('yield', $yield)->render();
            }

            if( Kohana::find_file("views", "index") )
            {
                $yield = View::factory("index")->bind('yield', $yield)->render();
            }
            
            
            $this->response->body($yield);    
        }
        
    }
}
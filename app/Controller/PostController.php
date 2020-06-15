<?php

    Class PostController{
        public function index($params){
            
            try {
                $Post = Postagem::selecionarPorId($params);

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);

                $template = $twig->load('single.html');

                $parametros = array();
                $parametros['Titulo'] = $Post->des_titulo;
                $parametros['Conteudo'] = $Post->des_conteudo;
                $parametros['Comentarios'] = $Post->comentarios;

                $conteudo = $template->render($parametros);
  
                echo $conteudo;
                
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            

        }
    }
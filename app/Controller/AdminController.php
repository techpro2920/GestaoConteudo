<?php

    Class AdminController{
        public function index(){
            
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('admin.html');

            $objPostagem = Postagem::selecionaTodos();

            $parametros = array();
            $parametros['postagens'] = $objPostagem;


            $conteudo = $template->render($parametros);

            echo $conteudo;

        }
        public function create(){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('create.html');

            $parametros = array();


            $conteudo = $template->render($parametros);

            echo $conteudo;
        }
        public function insert(){
            try {

                Postagem::insert($_POST);
                
                echo '<script>alert("Publicação inserida com sucesso!!!")</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';

            } catch (Exception $e) {

                echo '<script>alert("'.$e->getMessage().'");</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=create"</script>';
                
            }
            
        }

        public function change($paramId){

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('update.html');

            $post = Postagem::selecionarPorId($paramId);

            $parametros = array();
            $parametros['id'] =  $post->cod_postagem;
            $parametros['titulo'] = $post->des_titulo;
            $parametros['conteudo'] = $post->des_conteudo;

            $conteudo = $template->render($parametros);

            echo $conteudo;

        }

        public function update(){
            try {
                
                Postagem::update($_POST);

                echo '<script>alert("Publicação alterada com sucesso!!!")</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';

            } catch (Exception $e) {                
                
                echo '<script>alert("'.$e->getMessage().'");</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=change&id='.$_POST['cod_postagem'].'"</script>';

            }

            
        }

        public function delete($paramId){
            try {

                Postagem::delete($paramId);
                
                echo '<script>alert("Publicação excluida com sucesso!!!")</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';

            } catch (Exception $e) {                
                
                echo '<script>alert("'.$e->getMessage().'");</script>';
                
                echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
            }
            

        }
    }
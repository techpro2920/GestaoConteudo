<?php
    class Postagem{
        public static function selecionaTodos(){

            $con = Connection::getConn();

            $sql = "SELECT * FROM tab_postagem ORDER BY cod_postagem DESC";
            
            $sql = $con->prepare($sql);
            
            $sql->execute();
            
            $resultado = array();

            while($row = $sql->fetchObject('Postagem')){
                $resultado[] = $row;
            }

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco de dados");                
            }

            return $resultado;
        }

        public static function selecionarPorId($id){
            $con = Connection::getConn();

            $sql = "SELECT * FROM tab_postagem where cod_postagem = :id";

            $sql = $con->prepare($sql);

            $sql->bindValue(':id', $id, PDO::PARAM_INT);

            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco de dados");                
            } else {
                $resultado->comentarios = Comentario::selecionarComentario($resultado->cod_postagem);
                
            }

            return $resultado;

        }
        public static function insert($dadosPost){
            
            if(empty($dadosPost['titulo']) && empty($dadosPost['conteudo'])){
                throw new Exception("Preencha todos os campos");
                return false;
            }

            $con = Connection::getConn();

            $sql = "INSERT INTO tab_postagem (des_titulo, des_conteudo) VALUES(:titulo, :conteudo)";

            $sql = $con->prepare($sql);

            $sql->bindValue(':titulo', $dadosPost['titulo']);
            $sql->bindValue(':conteudo', $dadosPost['conteudo']);

            $res = $sql->execute();
            
            if ($res == 0){
                throw new Exception("Falha ao inserir publicação");
                
                return false;
            }

            return true;
        }

        public static function update($params){

            $con = Connection::getConn();

            $sql = "UPDATE tab_postagem SET des_titulo = :titulo, des_conteudo = :conteudo WHERE cod_postagem = :id";

            $sql = $con->prepare($sql);

            $sql->bindValue(':titulo', $params['titulo']);
            $sql->bindValue(':conteudo', $params['conteudo']);
            $sql->bindValue(':id', $params['cod_postagem']);

            $resultado = $sql->execute();

            if($resultado == false){
                throw new Exception("Falha ao alterar publicação");
                
                return false;
            }

            return true;
            
        }

        public static function delete($id){

            $con = Connection::getConn();

            $sql = "DELETE FROM tab_postagem WHERE cod_postagem = :id";

            $sql = $con->prepare($sql);

            $sql->bindValue(':id', $id);

            $resultado = $sql->execute();

            if($resultado == false){
                throw new Exception("Falha ao exluir publicação");
                
                return false;
            }

            return true;
            
        }
    }
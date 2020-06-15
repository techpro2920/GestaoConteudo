<?php

    class Comentario
    {
        public static function selecionarComentario($id){
            
            $conn = Connection::getConn();

            $sql = "SELECT * FROM tab_comentario WHERE cod_postagem = :id";

            $sql = $conn->prepare($sql);

            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Comentario')) {
                $resultado[] = $row;
            }

            return $resultado;

        }
    }
    
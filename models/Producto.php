<?php 

    class Producto extends Conectar {

        /* CREATE PRODUCT */
        public function insert_producto($cat_id, $prod_nom, $prod_desc) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_producto (prod_id, cat_id, prod_nom, prod_desc, fecha_crea, fecha_modi, fecha_elim, est) 
                    VALUES (NULL, ?, ?, ?, now(), NULL, NULL, 1)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        /* READ PRODUCT */
        public function get_producto() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT 
            tm_producto.prod_id,
            tm_producto.cat_id,
            tm_producto.prod_nom,
            tm_producto.prod_desc,
            tm_categoria.cat_nom 
            FROM tm_producto INNER JOIN tm_categoria ON tm_producto.cat_id=tm_categoria.cat_id 
            WHERE tm_producto.est=1";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll();
            return $resultado;
        }

        public function get_producto_x_id($prod_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_producto WHERE prod_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        /* UPDATE PRODUCT */
        public function update_producto($prod_id, $cat_id, $prod_nom, $prod_desc) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_producto 
                SET 
                    cat_id=?,
                    prod_nom=?,
                    prod_desc=?,
                    fecha_modi=now()
                WHERE
                    prod_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4, $prod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        /* DELETE PRODUCT */
        public function delete_producto($prod_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_producto 
                SET 
                    est=0,
                    fecha_elim=now()
                WHERE
                    prod_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }  
        
    } /* End class Producto */

?>
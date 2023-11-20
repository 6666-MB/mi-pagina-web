<?php/*@autor Marcelo Bogado*/

define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'productos');

// DEFINE 'PRODUCTOS' CLASS
class Productos {

    protected $id;
    public $nombre;
    public $imagen;
    public $descripcion;
    public $categoria;
    private $exists = false;
    // DEFINE CONSTRUCTOR FOR OBJECT CREATOR
    function __construct($id = null) {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db->select("productos", "id=?", array($id));

        if (isset($response[0]['id'])) {
            $this->id = $response[0]['id'];
            $this->nombre = $response[0]['nombre_producto'];
            $this->imagen = $response[0]['imagen_producto'];
            $this->descripcion = $response[0]['descripcion_producto'];
            $this->categoria = $response[0]['categoria_producto'];
            $this->exists = true;
        } else return false;
    }
    // DEFINE FUNCTION TO RENDER PRODUCTS ON SCREEN
    public function product_show() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
    // DEFINE FUNCTION TO SAVE DATA TO DB
    public function guardar() {
        if ($this->exists) return $this->product_update();
        else return $this->product_insert();
    }
    // DEFINE FUNCTION TO DELETE DATA FROM DB
    public function eliminar() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db->delete(TABLE, "id = " . $this->id);
    }
    // DEFINE FUNCTION TO CREATE NEW PRODUCTS
    private function product_insert() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", ""); categoria_producto=?
        $response = $db->insert(TABLE, "nombre_producto=?, imagen_producto=?, descripcion_producto=?, categoria_producto=?", "?,?,?,?", array($this->nombre, $this->imagen, $this->descripcion, $this->categoria));

        if ($response) {
            $this->id = $response;
            $this->exists = true;
            return true;
        } else return false;
    }
    // DEFINE FUNCTION TO MODIFY EXISTING PRODUCTS
    private function product_update() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db->update(TABLE, "nombre_producto=?, imagen_producto=?, descripcion_producto=?, categoria_producto=?", "id=?", array($this->nombre, $this->descripcion, $this->categoria, $this->imagen));
    }
    // DEFINE FUNCTION TO SELECT PRODUCTS
    static public function product_select() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $join = 'categorias ON categorias.id = productos.categoria_id';
        $columns = array(
            "productos.id",
            "productos.nombre_producto",
            "productos.imagen_producto",
            "productos.descripcion_producto",
            "categorias.nombre_categoria",
        );
        return $db->select(TABLE, $columns, $join);
    }
}

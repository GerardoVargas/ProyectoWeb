<?php
class Service {
    
    private $servicio;
    private $db;

    public function __construct() {
        $this->servicio = array();
        $this->db = new PDO('mysql:host=localhost;dbname=mvc_ejemplo', "root", "");
    }   

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getServicios() {

        self::setNames();
        $sql = "SELECT id, nombre, precio FROM servicio";
        foreach ($this->db->query($sql) as $res) {
            $this->servicio[] = $res;
        }
        return $this->servicio;
        $this->db = null;
    }

    public function getServicio($id) {

        self::setNames();
        $sql = "SELECT id, nombre, precio FROM servicio WHERE id=".$id;
        foreach ($this->db->query($sql) as $res) {
            $this->servicio[] = $res;
        }
        return $this->servicio;
        $this->db = null;
    }
    public function setServicio($nombre, $precio) {

        self::setNames();
        $sql = "INSERT INTO servicio(nombre, precio) VALUES ('" . $nombre . "', '" . $precio . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function Update($id, $nombre=null, $precio=null){
        self::setNames();
        $data = [
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio
            ];
        $sql = "UPDATE servicio SET nombre=:nombre, precio=:precio WHERE id=:id";   
        $result = $this->db->prepare($sql)->execute($data);

        if ($result) {
            echo "<script>window.location='../controllers/controlador.php'</script>";
            return true;
        } else {
            return false;
        }
    }
     public function Delete($id){
        $data = [
                'id' => $id,
            ];
        self::setNames();
        $sql = "DELETE FROM servicio WHERE id=".$id;   
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>

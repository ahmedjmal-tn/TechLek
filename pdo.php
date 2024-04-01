<?php
class connexion
{
    public function CNXbase()
    {
        $dbc = new PDO('mysql:host=localhost;dbname=e_commerce', 'root', '');
        return $dbc;
    }
}

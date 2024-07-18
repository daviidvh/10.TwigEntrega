<?php
    interface Model{
        public function findAll();

        public function findById($id);

        public function store($datos);

        public function updateById($id);

        public function destroyById($id);
    }
?>
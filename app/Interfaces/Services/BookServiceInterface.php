<?php

namespace App\Interfaces\Services;

interface BookServiceInterface
{
    public function index();
    public function show($slug);
    public function search($request);
    public function store($data);
    public function update($data,$slug);
    public function destroy($slug);
}

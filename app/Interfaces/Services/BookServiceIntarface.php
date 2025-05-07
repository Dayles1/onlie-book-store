<?php

namespace App\Interfaces\Services;

interface BookServiceIntarface
{
    public function index($request);
    public function show($slug);
    public function search($request);
    public function store($data);
    public function update($data);
    public function destroy($book);
}

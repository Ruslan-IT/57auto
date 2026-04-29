<?php

namespace App\Http\Controllers;



class BlogController
{


    public function index()
    {



        return view('blogs.index');

    }

    public function show()
    {



        return view('blogs.show');

    }

}

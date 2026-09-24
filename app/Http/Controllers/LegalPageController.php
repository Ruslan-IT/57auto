<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;

class LegalPageController
{
    public function privacy()
    {
        return $this->showBySlug('privacy-policy');
    }

    public function agreement()
    {
        return $this->showBySlug('user-agreement');
    }

    private function showBySlug(string $slug)
    {
        $page = LegalPage::findBySlug($slug);

        abort_if(!$page, 404);

        return view('legal.show', compact('page'));
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Keyword;

class KeywordManager extends Component
{
    use WithPagination;

    public $newKeyword = '';
    public $searchTerm = '';

    protected $rules = [
        'newKeyword' => 'required|max:255',
    ];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function addKeyword()
    {
        $this->validate();

        $existingKeyword = Keyword::where('keyword', $this->newKeyword)->first();

        if ($existingKeyword) {
            $this->addError('newKeyword', 'A palavra-chave já existe.');
            return;
        }

        Keyword::create(['keyword' => $this->newKeyword]);

        $this->newKeyword = '';
    }

    public function removeKeyword($keywordId)
    {
        $keyword = Keyword::find($keywordId);
        $keyword->delete();
    }

    public function render()
    {
        $keywords = Keyword::where('keyword', 'like', '%' . $this->searchTerm . '%')
                           ->paginate(10);

        return view('livewire.keyword-manager', compact('keywords'));
    }
}


